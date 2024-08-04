<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $table = 'tb_services';

    protected $fillable = [
        'id_service',
        'title',
        'description',
        'body',
        'image',
        'deleted_at',
        'archived_at'
    ];
}
