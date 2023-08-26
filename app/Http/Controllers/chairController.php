<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use App\Models\rapChieu;
use App\Models\chair;
use Illuminate\Http\Request;

class chairController extends Controller
{

    public function listRap() 
    {
        $ListRapChieu = rapChieu::all();
    
        $innerJoin = DB::table('rap_chieu')
            ->join('ghe_ngoi', 'rap_chieu.rap_chieu_id', '=', 'ghe_ngoi.Id_rap3')
            ->select('rap_chieu.Name_rap', 'ghe_ngoi.So_ghe', 'ghe_ngoi.Looi_ghe', 'ghe_ngoi.price', 'ghe_ngoi.ghe_ngoi_id')
            ->get();
    
        return view('admin.addChair', compact('ListRapChieu', 'innerJoin'));
    }
    
    public function addChair(Request $request)
    {
        $validatedData = $request->validate([
            'rapChieu' => 'required|integer',
            'soGhe' => 'required|string',
            'loaiGhe' => 'required|string',
            'price' => 'required|numeric',
        ]);

        $insert =  chair::create([
            'Id_rap3' => $validatedData['rapChieu'],
            'So_ghe' => $validatedData['soGhe'],
            'Looi_ghe' => $validatedData['loaiGhe'],
            'price' => $validatedData['price'],
        ]);

        return redirect()->route('addChair')->with('r', true);
    }
    public function deleteChair($ChairId)
    {
        $Chair= chair::find($ChairId);
        if (!$Chair) {
            return redirect()->back()->with('error', 'chair not found');
        }

        $Chair->delete();
        return redirect()->route('addChair')->with('delete', true);
    }
    public function editChair($ChairId)
    {
        $ListRapChieu = rapChieu::all();

        $EditC = DB::table('rap_chieu')
        ->join('ghe_ngoi', 'rap_chieu.rap_chieu_id', '=', 'ghe_ngoi.Id_rap3')
        ->select('rap_chieu.rap_chieu_id','rap_chieu.Name_rap', 'ghe_ngoi.So_ghe', 'ghe_ngoi.Looi_ghe', 'ghe_ngoi.price', 'ghe_ngoi.ghe_ngoi_id')
        ->where('ghe_ngoi.ghe_ngoi_id', $ChairId)
        ->first();
        return view('admin.editChair', compact('EditC','ListRapChieu'));
        //compact tên biến
    }
    public function updateChair(Request $request, $ChairId)
    {
        $validatedData = $request->validate([
            'rap' => 'required|integer',
            'edit_so_ghe' => 'required|string',
            'edit_looi_ghe' => 'required|string',
            'edit_price' => 'required|numeric',
        ]);

        $updatedChair = chair::find($ChairId);

        if (!$updatedChair) {
            return redirect()->route('addChair')->with('error', 'Không tìm thấy ');
        } else {
            $updatedChair->Id_rap3 = $request->input('rap');
            $updatedChair->So_ghe = $request->input('edit_so_ghe');
            $updatedChair->Looi_ghe = $request->input('edit_looi_ghe');
            $updatedChair->price = $request->input('edit_price');
            $updatedChair->save();
            return redirect()->route('addChair')->with('update', true);
        }
    }
}
