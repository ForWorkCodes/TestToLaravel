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

            // Нужно добавлять по login, не проблема, просто не сразу обратил внимание, но миграции сделал. Если нужно, то можно переделать
            $this->info('Balance change request has been sent. For user ' . $obUser->name);
        } catch (\Exception $e) {
            $this->error("Error when create user: \n" . $e->getMessage());
        }
    }
}
