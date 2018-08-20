<?php

namespace App\GraphQL\Mutations;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Illuminate\Auth\Access\AuthorizationException;
use App\User;
use Carbon\Carbon;

class LoginUser extends Mutation{

    protected $attributes = [
        'name' => 'loginUser'
    ];

    public function type()
    {
        return GraphQL::type('User');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::nonNull(Type::string())],
            'email' => ['name' => 'email', 'type' => Type::nonNull(Type::string())],
            'password' => ['name' => 'password', 'type' => Type::nonNull(Type::string())],

        ];
    }

    // use \App\GraphQL\ResolveLogTrait;
    public function resolve($root, $args){

        $user = User::find($args['email']);

        if (!$user) {
            return null;
        }

        if ($user && app('hash')->check($args['password'], $user->password)) {
            $this->deleteExpiredTokens($user);
            $token = $user->createToken('APP_MOBILE')->accessToken;
            return [
                'user' => $user,
                'token' => $token
            ];
        }
        throw new AuthorizationException('Invalid credentials!');
        return null;
    }
    protected function deleteExpiredTokens($user)
    {
        $user->tokens()->where('expires_at', '<=', Carbon::now())->delete();
    }
}