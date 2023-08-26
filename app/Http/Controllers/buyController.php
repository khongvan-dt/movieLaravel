<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\ticket; 
use Carbon\Carbon; // Để làm việc với ngày và thời gian
use Illuminate\Support\Facades\Auth; // Để truy cập người dùng đã xác thực

class buyController extends Controller
{
    public function listBuy(Request $request)
    {
        session()->forget('ticket');
        $movies = DB::table('movie')
            ->join('the_loai', 'the_loai.the_loai_id', '=', 'movie.the_loai_id')
            ->select('the_loai.tenTheLoai', 'movie.movie_id', 'movie.the_loai_id', 'movie.movie_name', 'movie.dao_dien', 'movie.Max_time', 'movie.Ngay_chieu', 'movie.img', 'movie.priceMovie', 'movie.dv_chinh', 'movie.description')
            ->get();


        $time = DB::table('lich_chieu')
            ->join('rap_chieu', 'rap_chieu.rap_chieu_id', '=', 'lich_chieu.Id_rap2')

            ->select(
                'rap_chieu.Name_rap',
                'lich_chieu.Id_rap2',
                'lich_chieu.movie_id2',
                'lich_chieu.lich_chieu_id',
                DB::raw('GROUP_CONCAT(lich_chieu.ngayChieu) AS ngayChieu'),
                DB::raw('GROUP_CONCAT(lich_chieu.strat) AS strat'),
                DB::raw('GROUP_CONCAT(lich_chieu.end) AS end')
            )
            ->groupBy(
                'rap_chieu.Name_rap',
                'lich_chieu.Id_rap2',
                'lich_chieu.movie_id2',
                'lich_chieu.lich_chieu_id'
            )
            ->groupBy('ngayChieu')
            ->get();
        return view('web.index', compact('movies', 'time'));
    }
    public function buy(Request $request, $lichChieuId, $movieId)
    {
        $ch = DB::table('rap_chieu')
            ->join('lich_chieu', 'rap_chieu.rap_chieu_id', '=', 'lich_chieu.Id_rap2')
            ->join('ghe_ngoi', 'rap_chieu.rap_chieu_id', '=', 'ghe_ngoi.Id_rap3')
            ->select('rap_chieu.Name_rap', 'ghe_ngoi.So_ghe', 'ghe_ngoi.So_ghe', 'ghe_ngoi.ghe_ngoi_id', 'ghe_ngoi.Looi_ghe', 'ghe_ngoi.price')
            ->where('lich_chieu.lich_chieu_id', $lichChieuId)
            ->get();
        $chairs = $request->input('chairs', []);
        $product = [
            'lichChieuId' => $lichChieuId,
            'movieId' => $movieId,
            'chairs' => $chairs,
        ];
        session()->push('ticket', $product);
        $tickets = session()->get('ticket', []);

        return view('web.by', compact('ch', 'tickets'));
    }




    public function showTicket(Request $request)
    {
        $selectedSeats = $request->input('chairs', []);
        $ticketSession = session('ticket', []);
        $tickets = [];

        foreach ($ticketSession as $ticket) {
            foreach ($selectedSeats as $selectedSeat) {
                $newTicket = [
                    'lichChieuId' => $ticket['lichChieuId'],
                    'movieId' => $ticket['movieId'],
                    'chairs' => $selectedSeat,
                ];
                $tickets[] = $newTicket;
            }
        }

        $chairsInfo = [];
        $totalPrice = 0;

        foreach ($tickets as $ticket) {
            $lichChieuId = $ticket['lichChieuId'];
            $movieId = $ticket['movieId'];
            $chairs = $ticket['chairs'];

            $ch = DB::table('rap_chieu')
                ->join('lich_chieu', 'rap_chieu.rap_chieu_id', '=', 'lich_chieu.Id_rap2')
                ->join('ghe_ngoi', 'rap_chieu.rap_chieu_id', '=', 'ghe_ngoi.Id_rap3')
                ->join('movie', 'movie.movie_id', '=', 'lich_chieu.movie_id2')
                ->select(
                    'rap_chieu.Name_rap',
                    'ghe_ngoi.So_ghe',
                    'ghe_ngoi.ghe_ngoi_id',
                    'ghe_ngoi.Looi_ghe',
                    'ghe_ngoi.price',
                    'lich_chieu.ngayChieu',
                    'lich_chieu.strat',
                    'lich_chieu.end',
                    'movie.movie_name',
                    'movie.priceMovie',
                    'movie.movie_id',
                    'lich_chieu.lich_chieu_id'
                )
                ->where('lich_chieu.lich_chieu_id', $lichChieuId)
                ->where('movie.movie_id', $movieId)
                ->where('ghe_ngoi.So_ghe', $chairs)
                ->get();

            $chairsInfo[] = $ch;

            foreach ($ch as $info) {
                $totalPrice += $info->price + $info->priceMovie;
            }
        }

        session(['ticket' => $tickets]);

        return view('web.ticket', ['chairsInfo' => $chairsInfo, 'totalPrice' => $totalPrice]);
    }


    public function insertTicket(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $userId = Auth::id();
        $selectedSeats = $request->input('chair', []);
        $totalPrice = $request->input('total_price');

        $tickets = [];

        foreach ($selectedSeats as $selectedSeat) {
            $ticket = [
                'Id_users' => $userId,
                'ID_ghe2' => $selectedSeat,
                'movie_id3' => $request->input('movie_id'),
                'Id_lich_chieu2' => $request->input('lich_chieu_id'),
                'gia' => $totalPrice,
                'Ngay_dat_ve' => Carbon::now(),
                'thanh_toan' => $request->input('pay'),
            ];
            $tickets[] = $ticket;
        }

        Ticket::insert($tickets);

        return redirect()->route('end')->with('insert', true);
    }
    public function end()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $userId = Auth::id();
        $ticketList = session('ticket', []);

        $ch = [];

        
        foreach ($ticketList as $ticket) {
            $lich_chieu_id = $ticket['lichChieuId'];
            $movieId = $ticket['movieId'];
            $chairs = $ticket['chairs'];

            $result = DB::table('rap_chieu')
                ->join('lich_chieu', 'rap_chieu.rap_chieu_id', '=', 'lich_chieu.Id_rap2')
                ->join('ghe_ngoi', 'rap_chieu.rap_chieu_id', '=', 'ghe_ngoi.Id_rap3')
                ->join('movie', 'movie.movie_id', '=', 'lich_chieu.movie_id2')
                ->join('ve', 've.Id_lich_chieu2', '=', 'rap_chieu.rap_chieu_id')
                ->select(
                    'rap_chieu.Name_rap',
                    'ghe_ngoi.So_ghe',
                    'ghe_ngoi.ghe_ngoi_id',
                    'ghe_ngoi.Looi_ghe',
                    'ghe_ngoi.price',
                    'lich_chieu.ngayChieu',
                    'lich_chieu.strat',
                    'lich_chieu.end',
                    'movie.movie_name',
                    'movie.priceMovie',
                    'movie.movie_id',
                    'lich_chieu.lich_chieu_id'
                )
                ->where('ve.Id_users', $userId)
                ->where('lich_chieu.lich_chieu_id', $lich_chieu_id)
                ->where('movie.movie_id', $movieId)
                ->where('ghe_ngoi.ghe_ngoi_id', $chairs)
                ->first(); 

            if ($result) {
                $ch[] = $result;
            }
        }


        return view('web.end', ['ch' => $ch]);
    }
}
