<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lichChieu extends Model
{
    use HasFactory;
    protected $table = 'lich_chieu';
    protected $primaryKey = 'lich_chieu_id';


    protected $fillable = [
        'movie_id2',
        'Id_rap2',
        'ngayChieu',
        'strat',
        'end',
    ];
}
