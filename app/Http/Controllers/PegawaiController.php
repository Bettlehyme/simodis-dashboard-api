<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PegawaiController extends Controller
{
    public function showLogin()
    {
        return view('user.login');
    }

    public function authenticate(Request $request)
    {
        $login = Auth::attempt([
            'name' => $request->post('username'),
            'password' => $request->post('password')
        ]);

        if ($login) {
            if (auth()->user()->status == 'Administrator') {
                $request->session()->regenerate();
                return redirect()->intended('/dash');
            } else {
                return redirect()->intended('/main/realisasi');
            }
        }
        return back()->with('error', 'Login failed!');

        // dd('berhasil login');
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/auth/login');
    }

    public function showUser()
    {
        $data = Pegawai::all();
        return view('user.data', compact('data'));
    }

    public function create()
    {
        $db = DB::table('pegawai')->select('status')->groupBy('status')->get();
        $data = json_decode($db);

        // dd($data);
        return view('user.add', compact('data'));
    }

    public function store(Request $request)
    {
        $model = new Pegawai;

        $model->name = $request->username;
        $model->email = $request->email;
        $model->password = Hash::make($request->password);
        $model->status = $request->status;
        if ($request->status == 'Administrator') {
            $model->is_admin = 1;
        } else {
            $model->is_admin = 0;
        }

        $model->save();

        return redirect('/user/data')->with('success', 'Data user berhasil ditambahkan!');
    }

    public function edit(Request $request)
    {
        //
    }

    public function update(Request $request)
    {
        //
    }

    public function destroy($id)
    {
        $model = Pegawai::find($id);
        $model->delete();

        return redirect('/user/data')->with('success', 'Data berhasil dihapus!');
    }
}
