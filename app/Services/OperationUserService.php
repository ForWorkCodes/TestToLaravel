<?php
namespace App\Services;

use App\Contracts\OperationBalanceInterface;
use App\Models\UserOperaion;

class OperationUserService
{
    public function create(OperationBalanceInterface $object)
    {
        $arData = $object->getData();

        UserOperaion::create([
            'user_id' => $arData['user_id'] ?: '',
            'action' => $arData['type'] ?: '',
            'balance_id' => $arData['balance_id'] ?: '',
            'amount' => $arData['amount'] ?: '',
            'status' => $arData['status'] ?: '',
            'description' => $arData['description'] ?: '',
        ]);
    }
}
?>
