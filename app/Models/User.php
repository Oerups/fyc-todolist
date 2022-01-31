<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['name', 'email', 'password'];

    public function createToken()
    {
        $this->token = bin2hex(openssl_random_pseudo_bytes(16));
        $this->save();

        return $this->token;
    }
}
