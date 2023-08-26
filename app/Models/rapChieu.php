<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rapChieu extends Model
{
    use HasFactory;
    protected $table = 'rap_chieu'; 
    protected $primaryKey = 'rap_chieu_id'; 


    protected $fillable = [
        'Name_rap',
        'adress',
        'sdt',
        'Email',
        'Website',
    ];
}
