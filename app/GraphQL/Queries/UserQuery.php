<?php

namespace App\GraphQL\Queries;
use Illuminate\Support\Facades\Auth;

class UserQuery
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        // TODO implement the resolver
    }

    public function me(){
        return auth('sanctum')->user();
    }

}
