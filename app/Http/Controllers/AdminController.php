<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Setting;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $jml=Post::get()->mapWithKeys(function($post,$key){
            return [
                'last_insert'=>$post->created_at->diffForHumans(),
                'jml'=>$post->where('status','Active')->count()
            ];
        });
        if(isset($jml)){
            $hasil = [
                'last_insert'=>0,
                'jml'=>0
            ];
        }else{
            $hasil=$jml;
        }
        $data = [
            'title' => 'Dashboard',
            'jml_post'=>$hasil
        ];
        // return $data;
        return view('admin.dashboard', $data);
    }

    public function list_setting()
    {
        $data=[
            'title'=>'Pengaturan',
            'settings'=>Setting::first()
        ];
        return view('admin.settings',$data);
    }
    public function update_setting(Request $request,Setting $setting)
    {
        $request->validate([
            'email' => 'email',
        ]);
        $file = $request->file('profile');
        if ($file) {
            if (!Storage::exists('/public/setting')) {
                Storage::makeDirectory('public/setting', 0775, true);
            }
            $namafile =  md5(date('d-m-s', strtotime(now()))) . '.' . $file->getClientOriginalExtension();
            $img = Image::make($file->path());
            $img->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $result = $img->save(Storage::path('public/setting/' . $namafile));
            if ($result) {
                // (Storage::exists('/public/setting/'.$setting->profile)) ?? unlink(public_path('storage/setting/' . $setting->image));
                if(Storage::exists('/public/setting/'.$setting->profile)){
                    unlink(public_path('storage/setting/' . $setting->image));
                }
            }
        } else {
            $namafile = $setting->profile;
        }
        $update = Setting::where('id', $setting->id)->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'profile' => $namafile,
            'long' => $request->long,
            'lat' => $request->lat,
            'alamat' => $request->alamat,
            'desc' => $request->desc,
        ]);
        if ($update) {
            return redirect()->route('settings.index')->with('success', 'profile was successfully update');
        } else {
            return redirect()->route('settings.index')->with('failed', 'profile was successfully update');
        }
    }

}
