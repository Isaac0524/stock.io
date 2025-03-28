<?php
namespace App\Http\Controllers;

use TCPDF;
use Carbon\Carbon;
use App\Models\Vente;
use App\Models\Produits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


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
            'client' => 'required|string|max:255',
        ]);

        $total_prix = 0;
        $produits_achetés = [];
        $vente_ids = [];

        foreach ($request->produit_id as $index => $produit_id) {
            $produit = Produits::findOrFail($produit_id);

            if ($produit->quantite < $request->quantite[$index]) {
                return redirect()->route('ventes.create')->with('error', 'La quantité demandée pour le produit ' . $produit->nom . ' n\'est pas disponible.');
            }

            $prix_total = $produit->prix * $request->quantite[$index];
            $total_prix += $prix_total;

            $vente = Vente::create([
                'produit_id' => $produit_id,
                'quantite' => $request->quantite[$index],
                'prix_total' => $prix_total,
                'client' => $request->client,
                'user_id' => Auth::id(),  // Associer l'utilisateur authentifié
            ]);
            
            $vente_ids[] = $vente->id;

            $produit->quantite -= $request->quantite[$index];
            $produit->save();

            $produits_achetés[] = [
                'nom' => $produit->nom,
                'quantite' => $request->quantite[$index],
                'prix_total' => $prix_total,
            ];
        }
        
        return $this->generateRecuPDF(implode(',', $vente_ids));
    }

    public function statistiques()
    {
        // Total des ventes
        $totalVentes = Vente::sum('prix_total');
        
        // Nombre total de ventes
        $nombreVentes = Vente::count();
        
        // Produit le plus vendu - avec relation corrigée
        $produitPlusVendu = DB::table('produits')
            ->join('ventes', 'produits.id', '=', 'ventes.produit_id')
            ->select('produits.id', 'produits.nom', DB::raw('COUNT(ventes.id) as ventes_count'))
            ->groupBy('produits.id', 'produits.nom')
            ->orderByDesc('ventes_count')
            ->first();
        
        // Client ayant le plus acheté
        $clientPrincipal = Vente::selectRaw('client, COUNT(*) as total_achats, SUM(prix_total) as total_depense')
            ->groupBy('client')
            ->orderByDesc('total_depense')
            ->first();
        
        // Ventes par période
        $ventesParDate = Vente::selectRaw('DATE(created_at) as date, SUM(prix_total) as total')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();
        
        $dates = $ventesParDate->pluck('date');
        $ventes = $ventesParDate->pluck('total');
        
        // Répartition des ventes par produit - avec relation corrigée
        $produitsStats = DB::table('produits')
            ->leftJoin('ventes', 'produits.id', '=', 'ventes.produit_id')
            ->select('produits.nom', DB::raw('COUNT(ventes.id) as ventes_count'))
            ->groupBy('produits.nom')
            ->get();
        
        $produitsLabels = $produitsStats->pluck('nom');
        $produitsQuantites = $produitsStats->pluck('ventes_count');
        
        return view('pages.ventes.statistiques', compact(
            'totalVentes','ventesParDate', 'nombreVentes', 'produitPlusVendu', 'clientPrincipal',
            'dates', 'ventes', 'produitsLabels', 'produitsQuantites'
        ));
    }
    
    public function generateRecuPDF($ids)
    {
        $ventes = Vente::with('produit')->whereIn('id', explode(',', $ids))->get();
        $total = $ventes->sum('prix_total');
        $nom_client = $ventes->first()->client ?? 'Client inconnu';
        
        $pdf = new TCPDF();
        $pdf->SetCreator('Laravel');
        $pdf->SetAuthor('Nom de l\'entreprise');
        $pdf->SetTitle('Reçu de Vente');
        $pdf->SetMargins(10, 10, 10);
        $pdf->AddPage();

        // Fonction pour convertir un nombre en mots (simplifiée)
        function convertirNombreEnLettres($nombre)
        {
            if (!is_numeric($nombre)) {
                return "Valeur invalide";
            }
        
            if ($nombre < 0) {
                return "moins " . convertirNombreEnLettres(abs($nombre));
            }
        
            $unités = ['', 'un', 'deux', 'trois', 'quatre', 'cinq', 'six', 'sept', 'huit', 'neuf'];
            $dizaines = ['', 'dix', 'vingt', 'trente', 'quarante', 'cinquante', 'soixante', 'soixante-dix', 'quatre-vingt', 'quatre-vingt-dix'];
            $exceptions = [
                11 => 'onze', 12 => 'douze', 13 => 'treize', 14 => 'quatorze', 15 => 'quinze', 16 => 'seize',
                17 => 'dix-sept', 18 => 'dix-huit', 19 => 'dix-neuf',
                71 => 'soixante et onze', 72 => 'soixante-douze', 73 => 'soixante-treize', 74 => 'soixante-quatorze',
                75 => 'soixante-quinze', 76 => 'soixante-seize', 77 => 'soixante-dix-sept', 78 => 'soixante-dix-huit',
                79 => 'soixante-dix-neuf',
                81 => 'quatre-vingt-un', 82 => 'quatre-vingt-deux', 83 => 'quatre-vingt-trois',
                84 => 'quatre-vingt-quatre', 85 => 'quatre-vingt-cinq', 86 => 'quatre-vingt-six', 87 => 'quatre-vingt-sept',
                88 => 'quatre-vingt-huit', 89 => 'quatre-vingt-neuf',
                91 => 'quatre-vingt-onze', 92 => 'quatre-vingt-douze', 93 => 'quatre-vingt-treize',
                94 => 'quatre-vingt-quatorze', 95 => 'quatre-vingt-quinze', 96 => 'quatre-vingt-seize', 97 => 'quatre-vingt-dix-sept',
                98 => 'quatre-vingt-dix-huit', 99 => 'quatre-vingt-dix-neuf'
            ];
            
            $grands_nombres = [
                1000000000000 => "trillion",
                1000000000 => "milliard",
                1000000 => "million",
                1000 => "mille",
                100 => "cent"
            ];
        
            if ($nombre == 0) {
                return 'zéro';
            }
        
            $mots = '';
        
            foreach ($grands_nombres as $valeur => $nom) {
                if ($nombre >= $valeur) {
                    $quantité = floor($nombre / $valeur);
                    
                    if ($valeur == 100 && $quantité == 1) {
                        $mots .= "cent"; // "cent" au lieu de "un cent"
                    } else {
                        $mots .= convertirNombreEnLettres($quantité) . " $nom";
                    }
        
                    if ($quantité > 1 && $nom != "mille") {
                        $mots .= "s"; // Pluriel sauf pour "mille"
                    }
                    $mots .= " ";
                    $nombre %= $valeur;
                }
            }
        
            if ($nombre > 10 && $nombre < 20) {
                $mots .= $exceptions[$nombre];
            } else {
                $dizaine = floor($nombre / 10);
                $unité = $nombre % 10;
        
                if ($dizaine > 0) {
                    if (isset($exceptions[$nombre])) {
                        $mots .= $exceptions[$nombre];
                    } else {
                        $mots .= $dizaines[$dizaine];
                        if ($unité > 0) {
                            if ($dizaine == 7 || $dizaine == 9) {
                                $mots .= '-' . $exceptions[10 + $unité];
                            } else {
                                $mots .= '-' . $unités[$unité];
                            }
                        }
                    }
                } elseif ($unité > 0) {
                    $mots .= $unités[$unité];
                }
            }
        
            return trim($mots);
        }
        
        
        // Conversion du total en lettres
        $totalEnLettres = convertirNombreEnLettres(floor($total));

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
        $pdf->Output('recu_vente_' . $ventes->first()->id . '.pdf', 'D');
        exit;
    }

    public function show($id)
    {
        $vente = Vente::with('produit')->findOrFail($id);
        return view('pages.ventes.show', compact('vente'));
    }

    public function recuPDF($id)
    {
        return $this->generateRecuPDF($id);
    }

    public function exportPDF(Request $request)
    {
        // Utiliser la même logique de filtrage que la méthode index
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
                <th>ID</th>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Prix Total</th>
                <th>Client</th>
                <th>Date</th>
            </tr>';

        foreach ($ventes as $vente) {
            $html .= '
            <tr>
                <td>' . $vente->id . '</td>
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

    public function exportExcel(Request $request)
    {
        // Récupérer les ventes filtrées
        $ventes = $this->getFilteredVentes($request)->get();
        
        // Si vous utilisez Maatwebsite/Laravel-Excel, vous pourriez faire quelque chose comme:
        // return Excel::download(new VentesExport($ventes), 'liste-ventes.xlsx');
        
        // Sinon, pour une solution simple, on peut juste rediriger avec un message
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
            // Si période est "custom" ou n'est pas définie, on utilise les dates personnalisées
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