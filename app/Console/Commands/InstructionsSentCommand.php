<?php

namespace App\Console\Commands;

use App\Mail\InstructionsSentMail;
use App\Models\Order;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class InstructionsSentCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:instructionssent';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check if orders have unchecked instructions sent field.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    private $emails = ['vladan@dashfurniture.rs'];

    public function handle()
    {
        $orders = Order::whereNull('instructions_sent')->get();
        Log::info('Instructions sent command: No of orders: ' . count($orders));
        if(!$orders->isEmpty()){
            foreach($this->emails as $email){
                if(env('APP_ENV') != 'local'){
                    Mail::to($email)->send(new InstructionsSentMail($orders));
                }
            }
            $this->info('Instruction sent mail has been sent.');
            Log::info('Instruction sent mail has been sent.');
        } else {
            $this->info('All orders have instructions sent field checked.');
            Log::info('All orders have instructions sent field checked.');
        }
    }
}
