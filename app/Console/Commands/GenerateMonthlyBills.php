<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\MaintenanceBill;
use Illuminate\Support\Carbon;
use App\Models\User;

class GenerateMonthlyBills extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:bills';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Monthly Bills';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $month = Carbon::now()->format('Y-m');
        $dueDate = Carbon::now()->endOfMonth();

        $users = User::all(); // or filter by residents

        foreach ($users as $user) {
            MaintenanceBill::firstOrCreate([
                'user_id' => $user->id,
                'month' => $month,
            ], [
                'amount' => 1000, // fixed or calculate dynamically
                'due_date' => $dueDate,
            ]);
        }

        $this->info("Bills generated for $month");
    }
}
