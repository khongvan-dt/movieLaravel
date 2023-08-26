<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

use App\Models\Movie;
use Illuminate\Support\Facades\DB;
use App\Models\lichChieu;

use Illuminate\Http\Request;

class showTimeController extends Controller
{
    public function listMovie()
    {
        $movies = DB::table('movie')
            ->join('phimrap', 'phimrap.ID_Phim', '=', 'movie.movie_id')
            ->join('rap_chieu', 'phimrap.Id_Rap', '=', 'rap_chieu.rap_chieu_id')
            ->select('rap_chieu.Name_rap', 'phimrap.ID_Phim', 'phimrap.Id_Rap', 'movie.movie_id', 'movie.the_loai_id', 'movie.movie_name', 'movie.dao_dien', 'movie.Max_time', 'movie.Ngay_chieu', 'movie.img', 'movie.priceMovie', 'movie.dv_chinh', 'movie.description')
            ->get();
        return view('admin.addSTime', compact('movies'));
    }
    public function addtime($rapId, $movieId, Request $request)
    {
        $time = DB::table('movie')
            ->join('phimrap', 'phimrap.ID_Phim', '=', 'movie.movie_id')
            ->join('rap_chieu', 'phimrap.Id_Rap', '=', 'rap_chieu.rap_chieu_id')
            ->select(
                'rap_chieu.Name_rap',
                'phimrap.ID_Phim',
                'phimrap.Id_Rap',
                'movie.movie_id',
                'movie.the_loai_id',
                'movie.movie_name',
                'movie.dao_dien',
                'movie.Max_time',
                'movie.Ngay_chieu',
                'movie.img',
                'movie.priceMovie',
                'movie.dv_chinh',
                'movie.description'
            )
            ->where('rap_chieu.rap_chieu_id', '=', $rapId)
            ->where('movie.movie_id', '=', $movieId)
            ->first();

        if ($request->isMethod('post')) {
            $lichChieu = new lichChieu();
            $lichChieu->movie_id2 = $movieId;
            $lichChieu->Id_rap2 = $rapId;
            $lichChieu->ngayChieu = $request->input('ngayChieu');
            $lichChieu->strat = $request->input('strat');
            $lichChieu->end = $request->input('end');
            $lichChieu->save();
            return redirect()->route('addShowTime', ['rapId' => $rapId, 'movieId' => $movieId])->with('insert', true);
        }

        return view('admin.addtime', compact('time', 'rapId', 'movieId'));
    }
}
