<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Register extends Controller
{
    function create(Request $request)
    {
        session()->flash('namalengkap', $request->namalengkap);
        session()->flash('namalengkap', $request->namalengkap);
        $request->validate([
            'namalengkap' => 'required',
            'emailbaru' => 'required',
            'passwordbaru' => 'required'
        ], [
            'namalengkap.required' => 'Nama Wajib Diisi',
            'emailbaru.required' => 'Email Wajib Diisi',
            'passwordbaru.required' => 'Password Wajib Diisi'
        ]);
        $data = [
            'namalengkap' => $request->namalengkap,
            'email' => $request->emailbaru,
            'password' => Hash::make($request->passwordbaru)
        ];
        User::create($data);
        $inforegister = [
            'email' => $request->emailbaru,
            'password' => $request->passwordbaru
        ];
        if (Auth::attempt($inforegister)) {
            return redirect()->route('pelanggan.home')->with('success', Auth::user()->namalengkap . 'Silahkan Login');
        } else {
            return redirect('/')->withErrors('Register gagal');
        }
    }
    public function index()
    {
        $dataAdmin = User::where('jabatan', 'admin')
            ->get();
        return view('admin', ['dataAdmin' => $dataAdmin]);
    }
    public function inputAdmin(Request $request)
    {
        $request->validate([
            'emailAdmin' => 'required',
            'password' => 'required'
        ]);
        User::create([
            'email' => $request->emailAdmin,
            'namalengkap' => $request->namalengkap,
            'password' => Hash::make($request->password),
            'jabatan' => 'admin'
        ]);
        return redirect()->route('kelola.admin');
    }
    public function editAdmin(Request $request)
    {
        $editAdmin = User::where('id', $request->id)
            ->update([
                'email' => $request->emailAdmin,
                'namalengkap' => $request->namalengkap,
                'password' => Hash::make($request->password)
            ]);
        return redirect()->route('kelola.admin');
    }
    public function hapusAdmin(Request $request)
    {
        $hapusAdmin = User::where('id', $request->id)
            ->delete();
        return redirect()->route('kelola.admin');
    }
}
