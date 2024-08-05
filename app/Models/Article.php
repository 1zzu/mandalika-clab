<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $table = 'tb_posts';

    protected $fillable = [
        'id_post',
        'user_id',
        'title',
        'body',
        'image',
        'updated_at',
        'deleted_at',
        'archived_at'
    ];
}
