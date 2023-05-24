<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Users',
            'var' => 'user',
            'users' => User::with('role')->get()
        ];
        return view('admin.users.index', $data);
    }
    public function login()
    {
        $data = [
            'title' => 'Login',
        ];
        return view('admin.login', $data);
    }

    public function login_check(Request $request)
    {
        $username = $request->username;
        $cek = User::where('username', $username)
            ->orWhere('email', $username)
            ->first();
        if ($cek) {
            $password = $request->password;
            if (Hash::check($password, $cek->password)) {
                $request->session()->put('admin-account', $cek);
                return redirect()->route('dashboard')->with('success', 'login success');
            } else {
                return redirect()->route('login')->with('failed', 'Wrong password');
            }
        } else {
            return redirect()->route('login')->with('failed', 'User not found');
        }
    }

    public function profile(Request $request)
    {
        $data = [
            'title' => 'My Profile',
            'var' => 'profile', 'users' => User::where('id', $request->session()->get('admin-account.id'))->with('role')->first(),
            'roles' => Role::get()
        ];
        return view('admin.users.profile', $data);
    }

    public function logout(Request $request)
    {
        $request->session()->forget('admin-account');
        return redirect()->route('login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username',
            'email' => 'required|email',
            'name' => 'required',
            'password' => 'required',
            'role_id' => 'required',
            'image' => 'image|mimes:jpg,png,bmp,jpeg,webp'
        ]);
        $file = $request->file('image');
        if (!$file) {
            $namafile = "default.webp";
        } else {
            if (!Storage::exists('/public/userprofile')) {
                Storage::makeDirectory('public/userprofile', 0775, true);
            }
            $namafile =  md5(date('d-m-s', strtotime(now()))) . '.' . $file->getClientOriginalExtension();
            $img = Image::make($file->path());
            $img->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save(Storage::path('public/userprofile/' . $namafile));
        }
        $save = User::create([
            'name' => $request->name,
            'role_id' => $request->role_id,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'image' => $namafile
        ]);
        if ($save) {
            return redirect()->route('users.index')->with('success', 'Data was Successfully added');
        } else {
            return redirect()->route('users.index')->with('failed', 'Data was failed added');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $data = [
            'title' => 'Edit Users',
            'var' => 'user',
            'users' => $user,
            'roles' => Role::all()
        ];
        return view('admin.users.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'email' => 'email',
        ]);
        $file = $request->file('image');
        if ($file) {
            $namafile =  md5(date('d-m-s', strtotime(now()))) . '.' . $file->getClientOriginalExtension();
            $img = Image::make($file->path());
            $img->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $result = $img->save(Storage::path('public/userprofile/' . $namafile));
            if ($result) {
                unlink(public_path('storage/userprofile' . $user->image));
            }
        } else {
            $namafile = $user->image;
        }
        $update = User::where('id', $user->id)->update([
            'username' => $request->username,
            'email' => $request->email,
            'name' => $request->name,
            'role_id' => $request->role_id,
            'image' => $namafile
        ]);
        if ($update) {
            $sesi = $request->session()->get('admin-account');
            $sesi['name'] = $request->name;
            $sesi['username'] = $request->username;
            $sesi['email'] = $request->email;
            $sesi['role_id'] = $request->role_id;
            $sesi['image'] = $namafile;
            return redirect()->route('users.index')->with('success', 'Data was successfully updated');
        } else {
            return redirect()->route('users.index')->with('failed', 'Data failed to update');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->username != session()->get('admin-account.username')) {
            $delete = $user->delete();
            if ($delete) {
                unlink(public_path('storage/userprofile/' . $user->image));
                return redirect()->route('users.index')->with('success', 'Data was successfully deleted');
            } else {
                return redirect()->route('users.index')->with('failed', 'Data failed to delete');
            }
        } else {
            return redirect()->route('users.index')->with('failed', 'User was using');
        }
    }

    public function updateProfile(User $user, Request $request)
    {
        $update = User::where('id', $user->id)->update([
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'role_id' => $request->input('role_id')
        ]);
        if ($update) {
            $sesi = $request->session()->get('admin-account');
            $sesi['name'] = $request->name;
            $sesi['username'] = $request->username;
            $sesi['email'] = $request->email;
            $sesi['role_id'] = $request->role_id;
            return redirect()->route('profile_')->with('success', 'profile was successfully update');
        } else {
            return redirect()->route('profile_')->with('success', 'profile was successfully update');
        }
    }
    public function list_users(){
        $users = User::get();
        return response()->json(['data'=>$users,'message'=>'ok','status'=>200]);
    }
}
