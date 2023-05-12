<?php

namespace App\Jobs;

use App\Services\BalanceUserService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateUserBalance implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user_id;
    protected $type;
    protected $amount;
    protected $description;
    /**
     * Create a new job instance.
     */
    public function __construct($user_id, $type, $amount, $description = '')
    {
        $this->user_id = $user_id;
        $this->type = $type;
        $this->amount = $amount;
        $this->description = $description;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        BalanceUserService::updateBalanceUser($this->user_id, $this->type, $this->amount, $this->description);
    }
}
