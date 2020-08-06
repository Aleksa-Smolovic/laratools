<?php

namespace App\GraphQL\Mutations;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\User;
use Log;

class UserMutator
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        // TODO implement the resolver
    }

    public function login($root, array $args){
        $credentials = Arr::only($args, ['email', 'password']);
        if (Auth::once($credentials)) {
            $user = auth()->user();
            return $user->createToken(time())->plainTextToken;
        }else{
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);    
        }

    }

    public function logout(){
        return auth()->user()->tokens()->delete();
    }

    public function createUser($root, array $args)
    {  
        $user = new User();
        $user->name = $args['name'];
        $user->email = $args['email'];
        $user->email_verified_at = now();
        $user->role_id = $args['role']['connect'];
        $user->password =  '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';
        $user->remember_token = Str::random(10);
        $user->save();
        return $user;
    }

}
