<?php

namespace App\Console\Commands;

use App\Services\UserService;
use Illuminate\Console\Command;

class UserCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create {name} {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command: create user';

    /**
     * @var UserService
     */
    protected $userService;

    public function __construct(UserService $service)
    {
        parent::__construct();

        $this->userService = $service;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $name = $this->argument('name');
            $email = $this->argument('email');
            $password = $this->argument('password');

            // Нужно добавлять по login, не проблема, просто не сразу обратил внимание, но миграции сделал. Если нужно, то можно переделать
            $user = $this->userService->create($name, $email, $password);

            $this->info('User created successfully. ID = ' . $user->id);
        } catch (\Exception $e) {
            $this->error("Error when create user: \n" . $e->getMessage());
        }
    }
}
