<?php
namespace App\Services;

use App\Models\User;
use App\Models\UserBalance;
use Illuminate\Support\Facades\Validator;
class BalanceUserService
{
    /**
     * @var UserService
     */
    protected $userService;

    public function __construct(UserService $service)
    {
        $this->userService = $service;
    }

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

        $obUser = $this->userService->findUserByEmail($email);

        // Событие перед изменением

        // Изменить количество бонусов

        // Событие после изменения

//        UserBalance::firstOrCreate([
//            'user_id' => $obUser->id
//        ], [
//            'amount' => $amount,
//            'status' => 'pending',
//            'description' => $description,
//        ]);
        return $obUser;
    }
}
?>
