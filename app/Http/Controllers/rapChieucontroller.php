<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\rapChieu;
use Illuminate\Support\Facades\Auth;

class RapChieuController extends Controller
{
    public function listCinema()
    {
        $listCinemas = rapChieu::all();
        return view('admin.add_products', compact('listCinemas'));
    }
    public function addCinema(Request $request)
    {
        $validatedData = $request->validate([
            'Name_rap' => 'required|string',
            'adress' => 'required|string',
            'sdt' => 'required|string',
            'Email' => 'required|email',
            'Website' => 'nullable|url',
        ]);
        $insert =  rapChieu::create([
            'Name_rap' => $validatedData['Name_rap'],
            'adress' => $validatedData['adress'],
            'sdt' => $validatedData['sdt'],
            'Email' => $validatedData['Email'],
            'Website' => $validatedData['Website'],
        ]);

        return redirect()->route('addProducts')->with('r', true);
    }
    public function deleteCinema($id)
    {
        $cinema = rapChieu::find($id);

        if ($cinema) {
            $cinema->delete();
            return redirect()->route('addProducts')->with('delete', true);
        }
        return redirect()->route('addProducts')->with('error', 'Không tìm thấy rạp chiếu');
    }
    public function editCinema($id)
    {
        $EditCinema = rapChieu::find($id);
        return view('admin.edit_product', compact('EditCinema'));
        //compact tên biến
    }
    public function updateCinema(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nameCinema' => 'required|string',
            'adress' => 'required|string',
            'sdt' => 'required|string',
            'Email' => 'required|email',
            'Website' => 'nullable|url',
        ]);

        $updatedCinema = rapChieu::find($id);

        if (!$updatedCinema) {
            return redirect()->route('addProducts')->with('error', 'Không tìm thấy rạp chiếu');
        } else {
            $updatedCinema->Name_rap = $request->input('nameCinema');
            $updatedCinema->adress = $request->input('adress');
            $updatedCinema->sdt = $request->input('sdt');
            $updatedCinema->Email = $request->input('Email');
            $updatedCinema->Website = $request->input('Website');
            $updatedCinema->save();
            return redirect()->route('addProducts')->with('update', true);
        }
    }
}
