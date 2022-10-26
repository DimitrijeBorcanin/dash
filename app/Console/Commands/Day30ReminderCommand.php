<?php

namespace App\Console\Commands;

use App\Mail\Day30ReminderMail;
use App\Models\Order;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class Day30ReminderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:day30';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remind about orders that have not been produced in 30 days.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    private $emails = ['vladan@dashfurniture.rs', 'slavica@metalistrpg.rs', 'slavisa@metalistrpg.rs', 'nenad@dashfurniture.rs'];

    public function handle()
    {
        $orders = Order::with('product')->whereNull('made')->whereRaw('DATEDIFF(CURRENT_TIMESTAMP, created_at) = 30')->get();
        if(!$orders->isEmpty()){
            foreach($orders as $order){
                foreach($this->emails as $email){
                    if(env('APP_ENV') != 'local'){
                        Mail::to($email)->send(new Day30ReminderMail($order));
                    }
                }
            }
            $this->info('Day 30 reminder mail has been sent.');
        } else {
            $this->info('No orders.');
        }
    }
}
