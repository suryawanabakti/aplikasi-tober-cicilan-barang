<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'alamat' => ['required'],
            'phone' => ['required'],
            'nik' => ['required']
        ]);

        if ($request->foto) {
            $imageName = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('storage/foto'), $imageName);
            $foto = 'foto/' . $imageName;
        }
        if ($request->ktp) {
            $imageName = time() . '.' . $request->ktp->extension();
            $request->ktp->move(public_path('storage/ktp'), $imageName);
            $ktp = 'ktp/' . $imageName;
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'alamat' => $request->alamat,
            'password' => Hash::make($request->password),
            'nik' => $request->nik,
            'foto' => $foto,
            'ktp' => $ktp
        ]);
        event(new Registered($user));
        Auth::login($user);
        $user->assignRole('customer');
        return redirect(RouteServiceProvider::CUSTOMER_DASHBOARD);
    }
}
