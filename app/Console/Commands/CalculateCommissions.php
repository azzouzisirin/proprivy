<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PaymentLink;

class CalculateCommissions extends Command
{
    protected $signature = 'commissions:calculate';
    protected $description = 'Calculate commissions for payments';

    public function handle()
    {
        // Sélectionner les liens de paiement qui sont payés et n'ont pas de commission définie
        $paymentLinks = PaymentLink::where('status', 'paid')->where('commission', 0)->get();

        foreach ($paymentLinks as $link) {
            // Calculer la commission (ici 3% du montant dû)
            $commission = $link->amount_due * 0.03; // Commission de 3%
            $netAmount = $link->amount_due - $commission;

            // Mettre à jour les champs commission et net_amount
            $link->update([
                'commission' => $commission,
                'net_amount' => $netAmount,
            ]);
        }

        // Message de confirmation
        $this->info('Commissions calculated successfully!');
    }
}