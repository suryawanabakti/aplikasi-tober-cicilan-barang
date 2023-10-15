<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
        return back();
    }
}
