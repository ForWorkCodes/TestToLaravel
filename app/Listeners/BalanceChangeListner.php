<?php

namespace App\Listeners;

use App\Contracts\OperationBalanceInterface;
use App\Events\BalanceChangeEvent;
use App\Services\OperationUserService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class BalanceChangeListner implements OperationBalanceInterface
{
    protected $user_id;
    protected $type;
    protected $balance_id;
    protected $amount;
    protected $status;
    protected $description;


    public function getData()
    {
        return [
            'user_id' => $this->user_id,
            'type' => $this->type,
            'balance_id' => $this->balance_id,
            'amount' => $this->amount,
            'status' => $this->status,
            'description' => $this->description,
        ];
    }

    /**
     * Handle the event.
     */
    public function handle(BalanceChangeEvent $event): void
    {
        $this->user_id = $event->user_id;
        $this->type = $event->type;
        $this->balance_id = $event->balance_id;
        $this->amount = $event->amount;
        $this->status = $event->status;
        $this->description = $event->description;

        $obOperation = new OperationUserService();
        $obOperation->create($this);
    }
}
