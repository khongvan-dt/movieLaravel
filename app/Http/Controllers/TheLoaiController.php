<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TheLoai;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Support\Facades\Auth;

use Illuminate\Database\Eloquent\Collection;


class TheLoaiController  extends Controller
{
    public function themTheLoai(Request $rq)
    {
        $data = $rq->validate([
            'Category' => 'required|string|max:100',
        ]);
        TheLoai::create([
            'tenTheLoai' => $data['Category'],
        ]);
        return redirect()->route('addCategory')->with('r', true);
    }


    public function listTheLoai()
    {
        $theLoaiData = TheLoai::all();
        return view('admin.add_category', compact('theLoaiData'));
    }
    public function deleteCategory($Categoryid)
    {
        $Category = TheLoai::find($Categoryid);
        if ($Category) {
            $Category->delete();
            return redirect()->route('addCategory')->with('delete', true);
        }
    }
    public function editCategory($id)
    {
        $EditCategory = TheLoai::find($id);
        return view('admin.editCategory', compact('EditCategory')); 
        //compact tên biến
    }  
    
    public function updateCategory(Request $request, $id)
    {
        $request->validate([
            'edit_category' => 'required|string|max:100',
        ]); 
    
        $category = TheLoai::find($id);
        $category->tenTheLoai = $request->input('edit_category');
        $category->save();
    
        return redirect()->route('addCategory')->with('update', true); 
    }
    
}
