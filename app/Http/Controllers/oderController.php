<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class oderController extends Controller
{
    public function order()
    {
        $result = DB::table('ve')
            ->join('lich_chieu', 've.Id_lich_chieu2', '=', 'lich_chieu.lich_chieu_id')
            ->join('rap_chieu', 'lich_chieu.Id_rap2', '=', 'rap_chieu.rap_chieu_id')
            ->join('ghe_ngoi', 've.ID_ghe2', '=', 'ghe_ngoi.ghe_ngoi_id')
            ->join('movie', 'lich_chieu.movie_id2', '=', 'movie.movie_id')
            ->join('users', 've.Id_users', '=', 'users.id')

            ->select(
                'rap_chieu.Name_rap',
                'ghe_ngoi.So_ghe',
                'ghe_ngoi.ghe_ngoi_id',
                'ghe_ngoi.Looi_ghe',
                'ghe_ngoi.price AS ghe_price',
                'lich_chieu.ngayChieu',
                'lich_chieu.strat',
                'lich_chieu.end',
                'movie.movie_name',
                'movie.priceMovie AS movie_price',
                'movie.movie_id',
                'lich_chieu.lich_chieu_id',
                've.Ngay_dat_ve',
                've.gia AS ve_price',
                'users.name'
            )
            ->get();

        return view('admin.oder', compact('result'));
    }
}

