<?php
namespace App\Http\Controllers;

use TCPDF;
use Carbon\Carbon;
use App\Models\Vente;
use App\Models\Produits;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use NumberToWords\NumberToWords;

class VenteController extends Controller
{
    public function create()
    {
        // Récupérer tous les produits pour afficher dans le formulaire de vente
        $produits = Produits::all();
        return view('pages.ventes.create', compact('produits'));
    } 

    public function index(Request $request)
    {
        // Construction de la requête de base
        $query = Vente::with('produit');
        
        // Traitement des filtres de période prédéfinie
        if ($request->filled('periode') && $request->periode !== 'custom') {
            $today = Carbon::today();
            
            switch ($request->periode) {
                case 'daily':
                    // Journalier (aujourd'hui)
                    $query->whereDate('created_at', $today);
                    break;
                    
                case 'weekly':
                    // Hebdomadaire (début de semaine à aujourd'hui)
                    $startOfWeek = $today->copy()->startOfWeek();
                    $query->whereDate('created_at', '>=', $startOfWeek)
                          ->whereDate('created_at', '<=', $today);
                    break;
                    
                case 'monthly':
                    // Mensuel (début du mois à aujourd'hui)
                    $startOfMonth = $today->copy()->startOfMonth();
                    $query->whereDate('created_at', '>=', $startOfMonth)
                          ->whereDate('created_at', '<=', $today);
                    break;
                    
                case 'quarterly':
                    // Trimestriel (début du trimestre à aujourd'hui)
                    $currentQuarter = ceil($today->month / 3);
                    $startOfQuarter = Carbon::create($today->year, ($currentQuarter - 1) * 3 + 1, 1);
                    $query->whereDate('created_at', '>=', $startOfQuarter)
                          ->whereDate('created_at', '<=', $today);
                    break;
            }
        } 
        // Traitement des dates personnalisées
        else {
            // Si période est "custom" ou n'est pas définie, on utilise les dates personnalisées
            if ($request->filled('date_debut')) {
                $query->whereDate('created_at', '>=', $request->date_debut);
            }
            
            if ($request->filled('date_fin')) {
                $query->whereDate('created_at', '<=', $request->date_fin);
            }
        }
        
        // Pagination (5 ventes par page)
        $ventes = $query->orderBy('created_at', 'desc')->paginate(5);
        
        // On conserve les paramètres de requête lors de la pagination
        $ventes->appends($request->except('page'));
        
        return view('pages.ventes.index', compact('ventes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'produit_id.*' => 'required|exists:produits,id',
            'quantite.*' => 'required|integer|min:1',
            'prix_total.*' => 'required|numeric|min:0',
            'client' => 'required|string|max:255',
        ]);

        $total_prix = 0;
        $vente_ids = [];

        // Vérification du stock avant traitement
        foreach ($request->produit_id as $index => $produit_id) {
            $produit = Produits::findOrFail($produit_id);
            if ($produit->quantite < $request->quantite[$index]) {
                return redirect()->route('ventes.create')->with('error', 'La quantité demandée pour le produit ' . $produit->nom . ' n\'est pas disponible.');
            }
        }

        // 1. D'abord créer la transaction
        $transaction = Transaction::create([
            'client' => $request->client,
            'user_id' => auth()->id(),
            'total_prix' => 0, // On va le calculer après
        ]);

        // 2. Ensuite traitement des ventes avec la transaction_id
        foreach ($request->produit_id as $index => $produit_id) {
            $produit = Produits::findOrFail($produit_id);
            $prix_total = $request->prix_total[$index];
            $total_prix += $prix_total;

            $vente = Vente::create([
                'produit_id' => $produit_id,
                'quantite' => $request->quantite[$index],
                'prix_total' => $prix_total,
                'client' => $request->client,
                'user_id' => auth()->id(),
                'transaction_id' => $transaction->id, // Maintenant défini !
            ]);
            $vente_ids[] = $vente->id;

            // Mettre à jour le stock
            $produit->quantite -= $request->quantite[$index];
            $produit->save();
        }

        // 3. Mettre à jour le total de la transaction
        $transaction->update(['total_prix' => $total_prix]);

        session()->put('vente_ids', $vente_ids);

        return redirect()->route('ventes.show', $transaction->id)->with('success', 'Vente enregistrée avec succès');
    }

    public function statistiques()
    {
        $totalVentes = Vente::sum('prix_total');
        $nombreVentes = Vente::count();

        $produitPlusVendu = DB::table('produits')
            ->join('ventes', 'produits.id', '=', 'ventes.produit_id')
            ->select('produits.id', 'produits.nom', DB::raw('COUNT(ventes.id) as ventes_count'))
            ->groupBy('produits.id', 'produits.nom')
            ->orderByDesc('ventes_count')
            ->first();

        $clientPrincipal = Vente::selectRaw('client, COUNT(*) as total_achats, SUM(prix_total) as total_depense')
            ->groupBy('client')
            ->orderByDesc('total_depense')
            ->first();

        $ventesParDate = Vente::selectRaw('DATE(created_at) as date, SUM(prix_total) as total')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $dates = $ventesParDate->pluck('date');
        $ventes = $ventesParDate->pluck('total');

        $produitsStats = DB::table('produits')
            ->leftJoin('ventes', 'produits.id', '=', 'ventes.produit_id')
            ->select('produits.nom', DB::raw('COUNT(ventes.id) as ventes_count'))
            ->groupBy('produits.nom')
            ->get();

        $produitsLabels = $produitsStats->pluck('nom');
        $produitsQuantites = $produitsStats->pluck('ventes_count');

        return view('pages.ventes.statistiques', compact(
            'totalVentes','ventesParDate', 'nombreVentes',
            'produitPlusVendu', 'clientPrincipal',
            'dates', 'ventes', 'produitsLabels', 'produitsQuantites'
        ));
    }

    public function show($id)
    {
        // Récupérer la transaction avec ses ventes et produits associés
        $transaction = Transaction::with('ventes.produit', 'user')->findOrFail($id);

        return view('pages.ventes.show', compact('transaction'));
    }

    public function recuPDF($id)
    {
        return $this->generateRecuPDF($id);
    }

    public function exportPDF(Request $request)
    {
        $ventes = $this->getFilteredVentes($request)->get();
        
        $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8');
        $pdf->SetCreator('Laravel');
        $pdf->SetAuthor('COMPUTERS VILLAGE');
        $pdf->SetTitle('Liste des ventes');
        $pdf->SetMargins(10, 10, 10);
        $pdf->AddPage();

        // En-tête et contenu
        $html = '
        <style>
            .header {
                text-align: center;
                font-size: 18px;
                font-weight: bold;
                color: #D20000;
                margin-bottom: 15px;
            }
            .details-table {
                width: 100%;
                border-collapse: collapse;
            }
            .details-table th, .details-table td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
            }
            .details-table th {
                background-color: #f2f2f2;
                font-weight: bold;
            }
            .details-table tr:nth-child(even) {
                background-color: #f9f9f9;
            }
            .footer {
                text-align: right;
                margin-top: 20px;
                font-size: 12px;
            }
        </style>

        <div class="header">LISTE DES VENTES</div>';
        
        // Informations sur le filtre
        if ($request->filled('periode') || $request->filled('date_debut') || $request->filled('date_fin')) {
            $html .= '<p><strong>Filtre appliqué :</strong> ';
            
            if ($request->filled('periode') && $request->periode !== 'custom') {
                switch ($request->periode) {
                    case 'daily':
                        $html .= 'Journalier ('. Carbon::today()->format('d/m/Y') .')';
                        break;
                    case 'weekly':
                        $html .= 'Hebdomadaire ('. Carbon::today()->startOfWeek()->format('d/m/Y') .' - '. Carbon::today()->format('d/m/Y') .')';
                        break;
                    case 'monthly':
                        $html .= 'Mensuel ('. Carbon::today()->startOfMonth()->format('d/m/Y') .' - '. Carbon::today()->format('d/m/Y') .')';
                        break;
                    case 'quarterly':
                        $currentQuarter = ceil(Carbon::today()->month / 3);
                        $startOfQuarter = Carbon::create(Carbon::today()->year, ($currentQuarter - 1) * 3 + 1, 1);
                        $html .= 'Trimestriel ('. $startOfQuarter->format('d/m/Y') .' - '. Carbon::today()->format('d/m/Y') .')';
                        break;
                }
            } else {
                if ($request->filled('date_debut') && $request->filled('date_fin')) {
                    $html .= 'Du '. Carbon::parse($request->date_debut)->format('d/m/Y') .' au '. Carbon::parse($request->date_fin)->format('d/m/Y');
                } elseif ($request->filled('date_debut')) {
                    $html .= 'À partir du '. Carbon::parse($request->date_debut)->format('d/m/Y');
                } elseif ($request->filled('date_fin')) {
                    $html .= 'Jusqu\'au '. Carbon::parse($request->date_fin)->format('d/m/Y');
                }
            }
            
            $html .= '</p>';
        }
        
        $html .= '
        <table class="details-table">
            <tr>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Prix Total</th>
                <th>Client</th>
                <th>Date</th>
            </tr>';

        foreach ($ventes as $vente) {
            $html .= '
            <tr>
                <td>' . $vente->produit->nom . '</td>
                <td>' . $vente->quantite . '</td>
                <td>' . number_format($vente->prix_total, 2) . ' FCFA</td>
                <td>' . $vente->client . '</td>
                <td>' . Carbon::parse($vente->created_at)->format('d/m/Y H:i') . '</td>
            </tr>';
        }

        $html .= '
        </table>
        <div class="footer">Document généré le : ' . now()->format('d/m/Y H:i') . '</div>
        ';

        $pdf->writeHTML($html, true, false, true, false, '');
        return $pdf->Output('liste-ventes.pdf', 'D');
    }

    public function generateRecuPDF($transaction_id)
    {
        $transaction = Transaction::with('ventes.produit')->findOrFail($transaction_id);
        $ventes = $transaction->ventes;
        $total = $transaction->total_prix;
        $nom_client = $transaction->client;
        
        $pdf = new TCPDF();
        $pdf->SetCreator('Laravel');
        $pdf->SetAuthor('COMPUTERS VILLAGE');
        $pdf->SetTitle('Reçu de Vente');
        $pdf->SetMargins(10, 10, 10);
        $pdf->AddPage();

        // Conversion du total en lettres avec NumberToWords
        $numberToWords = new NumberToWords();
        $numberTransformer = $numberToWords->getNumberTransformer('fr');
        $totalEnLettres = $numberTransformer->toWords(floor($total));

        $html = '
        <style>
            .header {
                text-align: center;
                font-size: 18px;
                font-weight: bold;
                color: #D20000;
            }
            .sub-header {
                text-align: center;
                font-size: 12px;
                font-weight: bold;
            }
            .details-table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }
            .details-table th, .details-table td {
                border: 1px solid black;
                padding: 5px;
                text-align: center;
            }
            .details-table th {
                background-color: #f2f2f2;
            }
            .total-section {
                text-align: right;
                font-size: 14px;
                margin-top: 10px;
                font-weight: bold;
            }
            .footer {
                text-align: center;
                margin-top: 50px;
                font-size: 12px;
            }
            .signature {
                margin-top: 50px;
                text-align: center;
                font-size: 12px;
            }
        </style>

        <div class="header">COMPUTERS VILLAGE</div>
        <div class="sub-header">Prestation de Services, Vente de Matériels Informatiques & Bureautiques</div>
        <p><strong>Date :</strong> ' . now()->format('d/m/Y H:i') . '</p>
        <p><strong>Client :</strong> ' . $nom_client . '</p>
        <p><strong>Transaction N° :</strong> ' . $transaction->id . '</p>
        <table class="details-table">
            <tr>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Prix Unitaire (FCFA)</th>
                <th>Total (FCFA)</th>
            </tr>';

        foreach ($ventes as $vente) {
            $html .= '
            <tr>
                <td>' . $vente->produit->nom . '</td>
                <td>' . $vente->quantite . '</td>
                <td>' . number_format($vente->produit->prix, 2) . '</td>
                <td>' . number_format($vente->prix_total, 2) . '</td>
            </tr>';
        }

        $html .= '
        </table>
        <p class="total-section">Total à payer : ' . number_format($total, 2) . ' FCFA</p>
        <div class="footer">ARRÊTÉE LA PRÉSENTE FACTURE À LA SOMME DE : <br><strong>' . strtoupper($totalEnLettres) . ' (' . number_format($total, 0) . ') Francs CFA</strong></div>
        <div class="signature">Signature & Cachet</div>
        ';

        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('recu_transaction_' . $transaction->id . '.pdf', 'D');
        exit;
    }

    public function exportExcel(Request $request)
    {
        // Récupérer les ventes filtrées
        $ventes = $this->getFilteredVentes($request)->get();
        
        return redirect()->back()->with('success', 'La fonctionnalité d\'export Excel sera bientôt disponible. Veuillez utiliser l\'export PDF pour le moment.');
    }
    
    private function getFilteredVentes(Request $request)
    {
        $query = Vente::with('produit');
        
        // Traitement des filtres de période prédéfinie
        if ($request->filled('periode') && $request->periode !== 'custom') {
            $today = Carbon::today();
            
            switch ($request->periode) {
                case 'daily':
                    $query->whereDate('created_at', $today);
                    break;
                case 'weekly':
                    $startOfWeek = $today->copy()->startOfWeek();
                    $query->whereDate('created_at', '>=', $startOfWeek)
                          ->whereDate('created_at', '<=', $today);
                    break;
                case 'monthly':
                    $startOfMonth = $today->copy()->startOfMonth();
                    $query->whereDate('created_at', '>=', $startOfMonth)
                          ->whereDate('created_at', '<=', $today);
                    break;
                case 'quarterly':
                    $currentQuarter = ceil($today->month / 3);
                    $startOfQuarter = Carbon::create($today->year, ($currentQuarter - 1) * 3 + 1, 1);
                    $query->whereDate('created_at', '>=', $startOfQuarter)
                          ->whereDate('created_at', '<=', $today);
                    break;
            }
        } else {
            if ($request->filled('date_debut')) {
                $query->whereDate('created_at', '>=', $request->date_debut);
            }
            
            if ($request->filled('date_fin')) {
                $query->whereDate('created_at', '<=', $request->date_fin);
            }
        }
    
        return $query->orderBy('created_at', 'desc');
    }
}