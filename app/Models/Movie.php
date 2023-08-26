<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    protected $table = 'movie';
    protected $primaryKey = 'movie_id';


    protected $fillable = [
        'the_loai_id',
        'movie_name	',
        'dao_dien',
        'Max_time',
        'Ngay_chieu',
        'img',
        'dv_chinh',
        'description',
    ];
}
