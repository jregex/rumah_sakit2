<?php

namespace App\Http\Controllers;

use App\Models\Aturan;
use App\Models\CategoryAturan;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard'
        ];
        return view('admin.dashboard', $data);
    }

    public function jenis_aturan()
    {
        $data = [
            'title'=>'List Kategori Aturan',
            'categories'=>CategoryAturan::get()
        ];
        return view('admin.aturan.categories',$data);
    }

    public function tambah_jenis(Request $request)
    {
        $request->validate([
            'jenis_aturan'=>'required'
        ]);
        $save = CategoryAturan::create([
            'jenis_aturan'=>$request->jenis_aturan
        ]);
        if($save)
        {
            return redirect()->route('jenis.index')->with('success','jenis aturan was added');
        }else{
            return redirect()->route('jenis.index')->with('failed','jenis aturan failed to update');

        }
    }

    public function update_jenis(Request $request)
    {
        $request->validate([
            'jenis_aturan' => 'required'
        ]);
        $id=$request->jenis_id;
        $update = CategoryAturan::where('id',$id)->update([
            'jenis_aturan' => $request->jenis_aturan
        ]);
        if ($update) {
            return redirect()->route('jenis.index')->with('success', 'Data was update');
        } else {
            return redirect()->route('jenis.index')->with('failed', 'Data failed to update');
        }
    }

    public function delete_jenis(CategoryAturan $categoryAturan)
    {
        $delete = $categoryAturan->delete();
        if ($delete) {
            return redirect()->route('jenis.index')->with('success', 'Data was deleted');
        } else {
            return redirect()->route('jenis.index')->with('failed', 'Data failed to delete');
        }
    }

    public function editJenis($id)
    {
        $jenis = CategoryAturan::where('id',$id)->first();
        return response()->json(['message'=>'success','data'=>$jenis]);
    }

    public function list_aturan()
    {
        $data = [
            'title'=>'List aturan',
            'aturans'=>Aturan::with('category_aturan')->get(),
            'jenis_aturan'=>CategoryAturan::get()
        ];
        return view('admin.aturan.index',$data);
    }

    public function tambah_aturan(Request $request)
    {
        $request->validate([
            'jenis_id'=>'required',
            'aturan'=>'required',
            'file_aturan'=>'required|file|mimes:pdf,docx,doc,xlsx,xls,csv'
        ],
        [
            'file_aturan.mimes'=>'jenis file harus pdf,docx,doc,xlsx,xls,csv'
        ]
        );

        $file=$request->file('file_aturan');

        if (!Storage::exists('/public/aturan')) {
            Storage::makeDirectory('public/aturan', 0775, true);
        }
        $filename =  $file->hashName();

        Storage::putFile('aturan',$file);
        $save = Aturan::create([
            'category_aturan_id'=>$request->jenis_id,
            'aturan'=>$request->aturan,
            'file_aturan'=>$filename
        ]);
        if($save)
        {
            return redirect()->route('aturan.index')->with('success','Data was added');
        }else{
            return redirect()->route('aturan.index')->with('failed','Data failed to add');

        }
    }

    public function edit_aturan(Aturan $aturan)
    {
        $data = [
            'title'=>'Edit Aturan',
            'aturans'=>$aturan,
            'jenis_aturan'=>CategoryAturan::get()
        ];
        return view('admin.aturan.edit',$data);
    }

    public function update_aturan(Request $request,Aturan $aturan)
    {

        $file=$request->file('file_aturan_new');
        if($file)
        {
            $request->validate(
                [
                    'file_aturan'=>'required|file|mimes:pdf,docx,doc,xlsx,xls,csv'
                ],
                [
                    'file_aturan.mimes'=>'jenis file harus pdf,docx,doc,xlsx,xls,csv'
                ]
            );
            if (!Storage::exists('/public/aturan')) {
                Storage::makeDirectory('public/aturan', 0775, true);
            }
            $filename =  $file->hashName();
            Storage::putFile('aturan',$file);
            Storage::delete('aturan/' . $aturan->file_aturan);
        }else{
            $filename=$aturan->file_aturan;
        }

        $update = Aturan::where('id',$aturan->id)->update([
            'category_aturan_id'=>$request->jenis_id,
            'aturan'=>$request->aturan,
            'file_aturan'=>$filename
        ]);
        if($update)
        {
            return redirect()->route('aturan.index')->with('success','Data berhasil diupdate');
        }else{
            return redirect()->route('aturan.index')->with('failed','Data gagal diupdate');

        }
    }

    public function delete_aturan(Aturan $aturan)
    {
        $delete = $aturan->delete();
        if($delete)
        {
            Storage::delete('aturan/' . $aturan->file_aturan);
            return redirect()->route('aturan.index')->with('success','Data berhasil di hapus');
        }else{
            return redirect()->route('aturan.index')->with('failed','Data gagal di hapus');

        }
    }

    public function download_aturan(Aturan $aturan)
    {
        return Storage::download('aturan/'.$aturan->file_aturan,$aturan->aturan);
    }

}
