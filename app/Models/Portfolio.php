<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    protected $table = 'tb_portfolios';

    protected $fillable = [
        'service_id',
        'title',
        'description',
        'problem',
        'damage',
        'result',
        'location',
        'created_at',
        'deleted_at',
        'archived_at',
        'updated_at'
    ];
}
