<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use App\Models\User;

use Illuminate\Support\Facades\Schema;

use App\Models\main;
use App\Models\front_preview;
use App\Models\navbar;
use App\Models\section1;
use App\Models\section2;
use App\Models\section3;
use App\Models\section4;

use App\Classes\InitialValues;

include('InitialValues.php');

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function changePassword()
    {
        return view('auth.change-password');
    }

    public function updatePassword(Request $request)
    {
        # Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);


        #Match The Old Password
        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->with("error", "Contraseña actual incorrecta");
        }


        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect()->route('home')->with("success", "Contraseña cambiada exitosamente");
    }


    public function changeUser()
    {
        return view('auth.change-user');
    }

    public function updateUser(Request $request)
    {
        # Validation
        $request->validate([
            'usuario' => 'required',
            'email' => 'required|email',
        ]);

        $user = User::find(auth()->user()->id);
        $user->name = $request->usuario;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('home')->with('success', 'Datos del administrador cambiados exitosamente');
    }



    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.home');
    }
}
