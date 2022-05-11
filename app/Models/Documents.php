<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'sender_name',
        'recv_name',
        'from_office',
        'to_office',
        'referenceNo',
    ];
}