<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    function index()
    {
        return redirect()->route('stok.ayam');
    }
    function pelanggan()
    {
        return redirect()->route('pelanggan.home');
    }
    function owner()
    {
        return redirect()->route('kelola.admin');
    }
}
