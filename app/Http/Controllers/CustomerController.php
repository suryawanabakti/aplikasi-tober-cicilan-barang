<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = User::role('customer')->get();
        return view('admin.customer.index', compact('customers'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        Alert::success("Berhasil hapus user");
        return back();
    }
}
