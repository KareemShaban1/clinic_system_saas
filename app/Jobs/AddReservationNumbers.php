<?php

namespace App\Jobs;

use App\Models\NumberOfReservations;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AddReservationNumbers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $numReservations;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($numReservations = 10)
    {
        $this->numReservations = $numReservations;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $today_reservation_number = NumberOfReservations::where('reservation_date',now()->today())->first();

        if(!$today_reservation_number ){
            NumberOfReservations::create([
                'reservation_date'=>now()->today(),
                'num_of_reservations'=>10
            ]);
        }
        
    }
}