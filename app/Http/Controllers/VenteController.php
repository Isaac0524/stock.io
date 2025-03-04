<?php
namespace App\Http\Controllers;

use TCPDF;
use App\Models\Vente;
use App\Models\Produits;
use Illuminate\Http\Request;

class VenteController extends Controller
{

    public function create()
    {
        // Récupérer tous les produits pour afficher dans le formulaire de vente
        $produits = Produits::all();
        return view('pages.ventes.create', compact('produits'));
    } 
    public function index()
    {
        // Récupérer toutes les ventes avec les informations du produit
        $ventes = Vente::with('produit')->get();
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
        $unités = ['', 'un', 'deux', 'trois', 'quatre', 'cinq', 'six', 'sept', 'huit', 'neuf'];
        $dizaines = ['', 'dix', 'vingt', 'trente', 'quarante', 'cinquante', 'soixante', 'soixante-dix', 'quatre-vingt', 'quatre-vingt-dix'];
        $exceptions = [11 => 'onze', 12 => 'douze', 13 => 'treize', 14 => 'quatorze', 15 => 'quinze', 16 => 'seize', 71 => 'soixante et onze', 72 => 'soixante-douze', 73 => 'soixante-treize', 74 => 'soixante-quatorze', 75 => 'soixante-quinze', 76 => 'soixante-seize', 91 => 'quatre-vingt-onze', 92 => 'quatre-vingt-douze', 93 => 'quatre-vingt-treize', 94 => 'quatre-vingt-quatorze', 95 => 'quatre-vingt-quinze', 96 => 'quatre-vingt-seize'];
        
        if ($nombre == 0) {
            return 'zéro';
        }
    
        $mots = '';
    
        if ($nombre >= 1000000) {
            $millions = floor($nombre / 1000000);
            $mots .= convertirNombreEnLettres($millions) . ' million' . ($millions > 1 ? 's' : '') . ' ';
            $nombre %= 1000000;
        }
    
        if ($nombre >= 1000) {
            $milliers = floor($nombre / 1000);
            if ($milliers > 1) {
                $mots .= convertirNombreEnLettres($milliers) . ' mille ';
            } else {
                $mots .= 'mille ';
            }
            $nombre %= 1000;
        }
    
        if ($nombre >= 100) {
            $centaines = floor($nombre / 100);
            if ($centaines > 1) {
                $mots .= $unités[$centaines] . ' cent';
            } else {
                $mots .= 'cent';
            }
            $nombre %= 100;
            if ($nombre > 0) {
                $mots .= ' ';
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
}