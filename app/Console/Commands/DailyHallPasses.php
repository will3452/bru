<?php

namespace App\Console\Commands;

use App\Royalty;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class DailyHallPasses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'give:hall_passess';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'give daily hall passes';

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
     * @return int
     */
    public function handle()
    {

        $royalties = Royalty::with('user')->get();

        foreach ($royalties as $royalty) {
            $inc = $royalty->user->vip ? 6 : 3;
            $royalty->update([
                'hall_pass' => $royalty->hall_pass + $inc,
            ]);
        }

        Log::info('working');

        return 1;
    }
}
