<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PimpinanController extends Controller
{
    public function index()
    {
        $pimpinanPimpinan = User::role('pimpinan')->get();
        return view('admin.pimpinan.index', compact('pimpinanPimpinan'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back();
    }
}
