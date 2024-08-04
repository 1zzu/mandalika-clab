<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $table = 'tb_users';

    protected $fillable = [
        'id_user',
        'username',
        'passowrd',
        'role_id',
        'deleted_at'
    ];
}
