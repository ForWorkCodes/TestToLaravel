<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserService
{
    /**
     * @param $email
     * @return User
     * @throws \Exception
     */
    public function findUserByEmail($email)
    {
        $obUser = User::where('email', $email)->first();

        if (!$obUser)
            throw new \Exception("User not found");

        return $obUser;
    }

    /**
     * @param ...$array
     * @return User
     * @throws \Exception
     */
    public function create(...$array) // Ну либо именованные параметры, это даже будет более правильно
    {
        [$name, $email, $password] = $array;

        $validation = Validator::make([
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ], [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validation->fails())
            throw new \Exception($validation->errors()->first());

        $obUser = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        return $obUser;
    }
}
?>
