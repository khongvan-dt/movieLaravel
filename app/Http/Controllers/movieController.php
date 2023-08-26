<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use App\Models\Movie;
use App\Models\TheLoai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Psy\Readline\Hoa\Console;
// insert làm chuẩn
class movieController extends Controller
{
    public function listTheLoai()
    {
        $theLoaiData = TheLoai::all();

        return view('admin.addMovie', compact('theLoaiData'));
    }
    public function listMovie()
    {
        $movies = DB::table('movie')
            ->join('the_loai', 'the_loai.the_loai_id', '=', 'movie.the_loai_id')
            ->select('the_loai.tenTheLoai', 'movie.movie_id', 'movie.the_loai_id', 'movie.movie_name', 'movie.dao_dien', 'movie.Max_time', 'movie.Ngay_chieu', 'movie.img', 'movie.priceMovie', 'movie.dv_chinh', 'movie.description')
            ->get();
        return view('admin.tables', compact('movies'));
    }



    public function addMovie(Request $request)
    {
        $validatedData = $request->validate([
            'theLoai' => 'required',
            'movieName' => 'required|string|max:100',
            'daoDien' => 'required|string',
            'MaxTime' => 'required|string',
            'NgayChieu' => 'required|string',
            'dvChinh' => 'required|string',
            'Description' => 'required|string',
            'fileImg' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('fileImg')) {
            $imageFile = $request->file('fileImg'); // trỏ đến mảng 
            $fileName = $imageFile->getClientOriginalName(); // lấy tên ảnh
            $imageFile->move(public_path('movieImages'), $fileName); //lưu ảnh vào trong thư mục public/movieImages

            $imagePath = 'movieImages/' . $fileName;

            $movie = new Movie();
            $movie->the_loai_id = $request->input('theLoai');
            $movie->movie_name = $request->input('movieName');
            $movie->dao_dien = $request->input('daoDien');
            $movie->Max_time = $request->input('MaxTime');
            $movie->Ngay_chieu = $request->input('NgayChieu');
            $movie->priceMovie = $request->input('priceMovie');

            $movie->dv_chinh = $request->input('dvChinh');
            $movie->description = $request->input('Description');
            $movie->img = $imagePath; // Lưu đường dẫn đến hình ảnh trong cơ sở dữ liệu
            $movie->save();

            return redirect()->back()->with('r', true);
        }
    }
    //lưu bảng cách khác 
    /*
            public function saveMovie(Request $request)
        {
            $validatedData = $request->validate([
                'theLoai' => 'required',
                'movieName' => 'required|string|max:100',
                'daoDien' => 'required|string',
                'MaxTime' => 'required|string',
                'NgayChieu' => 'required|string',
                'dvChinh' => 'required|string',
                'Description' => 'required|string',
                'fileImg' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust max file size as needed
            ]);

            $imagePath = $request->file('fileImg')->store('public/images'); // Store the uploaded image

            $movie = new Movie();
            $movie->the_loai_id = $request->input('theLoai');
            $movie->movie_name = $request->input('movieName');
            $movie->dao_dien = $request->input('daoDien');
            $movie->Max_time = $request->input('MaxTime');
            $movie->Ngay_chieu = $request->input('NgayChieu');
            $movie->dv_chinh = $request->input('dvChinh');
            $movie->description = $request->input('Description');
            $movie->img = $imagePath; // Store the image path in the database
            $movie->save();

            return redirect()->back()->with('r', true); // Redirect back with success message
        }*/
    public function deleteMovie($movieId)
    {
        $movie = Movie::find($movieId);

        if (!$movie) {
            return redirect()->back()->with('error', 'Movie not found');
        }

        $movie->delete();
        return redirect()->route('TablePage')->with('delete', true);
    }
    public function editMovie($movieId)
    {
        $theLoaiData = TheLoai::all();
        $movie = DB::table('movie')
            ->join('the_loai', 'the_loai.the_loai_id', '=', 'movie.the_loai_id')
            ->select('the_loai.tenTheLoai', 'movie.the_loai_id', 'movie.movie_id', 'movie.movie_name', 'movie.priceMovie', 'movie.dao_dien', 'movie.Max_time', 'movie.Ngay_chieu', 'movie.img', 'movie.dv_chinh', 'movie.description')
            ->where('movie.movie_id', $movieId)
            ->first();
        return view('admin.editMovie', compact('movie', 'theLoaiData'));
    }
    public function updateMovie(Request $request, $movieId)
    {
        $validated = $request->validate([
            'theLoai' => 'required|integer',
            'editNameMovie' => 'required|string',
            'editTime' => 'required|string',
            'editDay' => 'required|string',
            'editDD' => 'required|string',
            'editDV' => 'required|string',
            'editPrice' => 'required|numeric',
            'editImg' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Not required for updating
            'Description' => 'required|string'
        ]);

        $update = Movie::find($movieId);
        if (!$update) {
            return redirect()->route('addChair')->with('error', 'Không tìm thấy');
        }

        $update->the_loai_id = $request->input('theLoai');
        $update->movie_name = $request->input('editNameMovie');
        $update->dao_dien = $request->input('editDD');
        $update->Max_time = $request->input('editTime');
        $update->Ngay_chieu = $request->input('editDay');
        $update->priceMovie = $request->input('editPrice');
        $update->dv_chinh = $request->input('editDV');
        $update->description = $request->input('Description');

        if ($request->hasFile('editImg')) {
            $imageFile = $request->file('editImg');
            $fileName = $imageFile->getClientOriginalName();
            $imageFile->move(public_path('movieImages'), $fileName);
            $imagePath = 'movieImages/' . $fileName;
            $update->img = $imagePath;
        }

        $update->save();

        return redirect()->route('TablePage')->with('update', true);
    }
}
