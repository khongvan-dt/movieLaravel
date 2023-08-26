<?php

namespace App\Http\Controllers;
use App\Models\PhimRap; 

use App\Models\rapChieu;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class phimRapController extends Controller
{
    public function list()
    {
        $ListCinema = rapChieu::all();
        $ListMovie =  DB::table('movie')
            ->join('the_loai', 'the_loai.the_loai_id', '=', 'movie.the_loai_id')
            ->select('the_loai.tenTheLoai', 'movie.movie_id', 'movie.the_loai_id', 'movie.movie_name', 'movie.dao_dien', 'movie.Max_time', 'movie.Ngay_chieu', 'movie.img', 'movie.priceMovie', 'movie.dv_chinh', 'movie.description')
            ->get();
        return view('admin.moreMovieTheater', compact('ListMovie', 'ListCinema'));
    }
    public function insert(Request $request)
    {
        $selectedCinemas = $request->input('cinemaCheck', []);
        $selectedMovies = $request->input('movieCheck', []);

        // Lặp qua danh sách rạp và phim để tạo bản ghi liên kết
        foreach ($selectedCinemas as $cinemaId) {
            foreach ($selectedMovies as $movieId) {
                PhimRap::create([
                    'Id_Rap' => $cinemaId,
                    'ID_Phim' => $movieId,
                ]);
            }
        }

        return redirect()->route('phimRaps')->with('insert', 'Insert thành công!');
    }
}
