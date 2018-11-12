<?php

/*----------------------------------------
php artisan orders:process {status} {user}
-------------------------------------------*/
namespace App\Console\Commands;

use App\User;
use App\Order;
use App\OrderHistory;
use App\State;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;

class ProcessingOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:process {status?} {user=admin}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Procesamiento de Ordenes con condiciones especiales';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $arguments = $this->argument();
        $user = User::where('username', $arguments['user'])->first();

        if (isset($arguments['status'])) {

            switch ($arguments['status']) {

                case 'issued_case':
                    $days_to_close = Config::get('yws.days_to_close');

                    $this->info($this->description);
                    $this->info('Days for close orders older: '.$days_to_close);

                    $now = Carbon::now();
                    
                    $orders = Order::byStatus($arguments['status'])->get();
                    if ($orders->count()) {

                        $state = State::where('code', 'out_of_time')->get()->first();

                        foreach ($orders as $order) {
                            
                            //Order Date
                            $order_date = Carbon::parse($order->order_date);
                            //Days in Weekend
                            $days_weekend = $order_date->diffInDaysFiltered(function(Carbon $date) {
                               return $date->isWeekend();
                            }, $now);
                            //Time elapsed
                            $days_elapsed = $order_date->diffInDays($now);

                            if (($days_elapsed - $days_weekend) >= $days_to_close) {
                            
                                $this->info("ORDER ".$order->order_number." older day ".($days_elapsed - $days_weekend));
                                
                                //Log States
                                OrderHistory::create([
                                    "order_id" => $order->id,
                                    "state_id" => $state->id,
                                    "user_id" => $user->id,
                                    'log_date' => $order->DateForTimezone,
                                ]);

                                //Change State
                                $order->state_id = $state->id;
                                $order->save();

                                //Log
                                $order->createLog();
                                $order->sendNotice();

                                //Send email notification
                                $order->sendMail(['command' => 'out_of_time']);
                            }
                        }
                    }
                    
                    break;
                
                default:
                    # code...
                    break;
            }
        } else {
            $this->error("Not define status. Please set argument status. Example: php artisan orders:process issued_case.");
        }
    }
}
