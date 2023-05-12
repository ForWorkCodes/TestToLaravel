<?php
namespace App\Services;

use App\Events\BalanceChangeEvent;
use App\Jobs\UpdateUserBalance;
use App\Models\User;
use App\Models\UserBalance;
use Illuminate\Support\Facades\Validator;
class BalanceUserService
{
    /**
     * @param ...$array
     * @return User
     * @throws \Exception
     */
    public function change(...$array) // Ну либо именованные параметры, это даже будет более правильно
    {
        [$email, $type, $amount, $description] = $array;

        $validation = Validator::make([
            'email' => $email,
            'type' => $type,
            'amount' => $amount,
            'description' => $description,
        ], [
            'email' => 'required|email',
            'type' => 'required|in:minus,plus',
            'amount' => 'required|numeric|min:0.01',
            'description' => 'nullable|string|max:255'
        ]);

        if ($validation->fails())
            throw new \Exception($validation->errors()->first());

        $obUser = UserService::findUserByEmail($email);

        dispatch(new UpdateUserBalance($obUser->id, $type, $amount, $description));

        return $obUser;
    }

    /**
     * @param $user_id
     * @return void
     */
    public function create($user_id)
    {
        UserBalance::create([
            'user_id' => $user_id,
            'amount' => 0
        ]);
    }

    public static function updateBalanceUser($user_id, $type, $amount, $description)
    {
        $balance = UserBalance::where('user_id', $user_id)->first();

        if (!$balance)
            throw new \Exception("Balance not found");

        $curAmount = (float)$balance->amount;
        $status = 'success';

        if ($type == 'plus') {
            $newAmount = $curAmount + $amount;
        } elseif ($type == 'minus') {
            $newAmount = $curAmount - $amount;

            if ($newAmount < 0) {
                $newAmount = 0;
                $description .= "; Balance can't be negative";
                $status = "error";
            }
        }

        // Обновляем значение amount в модели UserBalance
        $balance->update(['amount' => $newAmount]);

        event(new BalanceChangeEvent($user_id, $type, $balance->id, $amount, $status, $description));
    }
}
?>
