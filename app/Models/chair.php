<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chair extends Model
{
    use HasFactory;
    protected $table = 'ghe_ngoi';
    protected $primaryKey = 'ghe_ngoi_id';


    protected $fillable = [
        'Id_rap3',
        'So_ghe',
        'Looi_ghe',
        'price',
    ];
}
