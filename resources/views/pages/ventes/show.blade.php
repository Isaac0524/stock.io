
<div style="display: flex; justify-content: center; align-items: center; min-height: 80vh;">
    <div style="background: #fff; border-radius: 12px; box-shadow: 0 2px 16px rgba(0,0,0,0.08); padding: 32px 40px; min-width: 400px;">
        <div style="margin-bottom: 16px;">
            <a href="{{ route('index') }}" class="btn btn-secondary" style="padding: 8px 18px; background: #7f8c8d; color: #fff; border-radius: 6px; text-decoration: none; font-weight: 500;">
                ← Retour au tableau de bord
            </a>
        </div>
        <h1 style="text-align: center; margin-bottom: 24px; color: #2c3e50;">Détail de la vente</h1>

        <div style="margin-bottom: 24px;">
            <p style="font-size: 1.1em; margin: 0 0 8px;"><strong>Client :</strong> {{ $transaction->client }}</p>
            <p style="font-size: 1.1em; margin: 0;"><strong>Total :</strong> {{ number_format($transaction->total_prix, 0, ',', ' ') }} FCFA</p>
        </div>

        <table style="width: 100%; border-collapse: collapse; margin-bottom: 24px;">
            <thead>
                <tr style="background: #f5f6fa;">
                    <th style="padding: 10px; border-bottom: 2px solid #e1e1e1; text-align: left;">Produit</th>
                    <th style="padding: 10px; border-bottom: 2px solid #e1e1e1; text-align: right;">Quantité</th>
                    <th style="padding: 10px; border-bottom: 2px solid #e1e1e1; text-align: right;">Prix</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaction->ventes as $vente)
                    <tr>
                        <td style="padding: 8px 10px; border-bottom: 1px solid #f0f0f0;">{{ $vente->produit->nom }}</td>
                        <td style="padding: 8px 10px; border-bottom: 1px solid #f0f0f0; text-align: right;">{{ $vente->quantite }}</td>
                        <td style="padding: 8px 10px; border-bottom: 1px solid #f0f0f0; text-align: right;">{{ number_format($vente->prix_total, 0, ',', ' ') }} FCFA</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="text-align: center;">
            <a href="{{ route('recu.pdf', ['id' => $transaction->id]) }}" class="btn btn-primary" style="padding: 10px 24px; background: #2980b9; color: #fff; border-radius: 6px; text-decoration: none; font-weight: 500;">
                Télécharger le reçu PDF
            </a>
        </div>
    </div>
</div>
