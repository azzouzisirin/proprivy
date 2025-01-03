<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reminder;
use App\Notifications\PaymentReminderNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
 use App\Models\User;
use App\Models\Rental;
 use Tests\TestCase;
class SendPaymentReminders extends Command
{
    protected $signature = 'send:payment-reminders';
    protected $description = 'Envoyer des rappels de paiement aux propriétaires et locataires';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Obtenez les rappels qui sont proches de leur date d'échéance
        $reminders = Reminder::where('is_sent', false)
                             ->whereDate('due_date', '=', Carbon::today()->addDays(3)) // Exemple : 3 jours avant l'échéance
                             ->get();

        foreach ($reminders as $reminder) {
            // Envoyer une notification au locataire
            $user = $reminder->user;
            $rental = $reminder->rental;

            $user->notify(new PaymentReminderNotification($reminder->due_date, $rental->property_name));

            // Marquer le rappel comme envoyé
            $reminder->update(['is_sent' => true]);

            $this->info("Rappel envoyé pour la location: {$rental->property_name} à l'utilisateur: {$user->name}");
        }

        $this->info('Tous les rappels de paiement ont été envoyés.');
    }

    public function test_scheduler_runs_reminder_job()
{
    // Exécutez la tâche planifiée manuellement pour le test
    Artisan::call('schedule:run');

    // Assurez-vous qu'aucune erreur n'est retournée lors de l'exécution du job
    $this->assertStringContainsString('Reminder job executed', Artisan::output());
}
public function test_performance_with_large_number_of_reminders()
{
    // Créer un grand nombre de rappels
    $user = User::factory()->create();
    $rental = Rental::factory()->create();

    $startTime = microtime(true);

    for ($i = 0; $i < 10000; $i++) {
        Reminder::create([
            'user_id' => $user->id,
            'rental_id' => $rental->id,
            'due_date' => Carbon::now()->addDays(2),
        ]);
    }

    $endTime = microtime(true);

    // Mesurez le temps d'exécution pour insérer 10 000 rappels
    $executionTime = $endTime - $startTime;

    // Définissez une limite de performance acceptable (par exemple, 5 secondes)
    $this->assertLessThan(5, $executionTime, "Performance test failed. Time exceeded 5 seconds.");
}
}

