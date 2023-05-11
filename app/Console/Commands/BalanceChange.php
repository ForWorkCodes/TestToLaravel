<?php

namespace App\Console\Commands;

use App\Services\BalanceUserService;
use Illuminate\Console\Command;

class BalanceChange extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'balance:change {email} {type} {amount} {description?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command: change balance for user';

    /**
     * @var BalanceUserService
     */
    protected $balanceService;

    public function __construct(BalanceUserService $service)
    {
        parent::__construct();

        $this->balanceService = $service;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $email = $this->argument('email');
            $type = $this->argument('type');
            $amount = $this->argument('amount');
            $description = $this->argument('description');

            $obUser = $this->balanceService->change($email, $type, $amount, $description);

            $this->info('Balance changed for ' . $obUser->name);
        } catch (\Exception $e) {
            $this->error("Error when create user: \n" . $e->getMessage());
        }
    }
}
