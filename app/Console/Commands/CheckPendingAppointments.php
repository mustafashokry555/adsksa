<?php

namespace App\Console\Commands;

use App\Models\Appointment;
use App\Models\CartItem;
use App\Models\Invoice;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CheckPendingAppointments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'appointments:check-pending';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check pending appointments older than 10 minutes and cancel related data';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $expiredTime = Carbon::now()->subMinutes(10);

        DB::transaction(function () use ($expiredTime) {

            $appointments = Appointment::where('status', 'P')
                ->where('created_at', '<=', $expiredTime)
                ->get();

            foreach ($appointments as $appointment) {

                // 1️⃣ Update appointment status to D
                $appointment->update([
                    'status' => 'D'
                ]);

                // 2️⃣ Delete cart items related to this appointment
                CartItem::where('appointment_id', $appointment->id)->delete();

                // 3️⃣ Handle invoices
                $invoices = Invoice::where('appointment_id', $appointment->id)
                    ->where('paymentstatus', 'cancelled')
                    ->get();

                foreach ($invoices as $invoice) {

                    // 4️⃣ Cancel related payments
                    Payment::where('invoice_id', $invoice->id)
                        ->update(['status' => 'cancelled']);
                }
            }
        });

        Log::info('Expired pending appointments processed successfully.');
        return Command::SUCCESS;
    }
}
