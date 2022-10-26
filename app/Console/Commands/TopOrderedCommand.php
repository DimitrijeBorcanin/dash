<?php

namespace App\Console\Commands;

use App\Mail\TopOrderedMail;
use App\Models\Order;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TopOrderedCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:topordered';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check if orders have unchecked top ordered field.';

    /**
     * Execute the console command.
     *
     * @return int
     */

    private $emails = ['vladan@dashfurniture.rs'];

    public function handle()
    {
        $orders = Order::whereNull('top_ordered')->get();
        if(!$orders->isEmpty()){
            foreach($this->emails as $email){
                if(env('APP_ENV') != 'local'){
                    Mail::to($email)->send(new TopOrderedMail($orders));
                }
            }
            $this->info('Top ordered mail has been sent.');
        } else {
            $this->info('All orders have top ordered field checked.');
        }
    }
}
