<?php

namespace App\Http\Controllers;

use Illuminate\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;

class AuthController extends Controller
{
    public function login()
    {
        return view('Fidelitzacio.login');
    }
    
    public function register()
    {
        return view('Fidelitzacio.registre');
    }
    
    public function processLogin(Request $request)
    {
        // Validació de les credencials
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            if (Auth::user()->is_admin) {
                // Redirigeix a l'administració si l'usuari és administrador
                return redirect()->route('dashboard');
            } else {
                return redirect()->route('fidelitzacio');
            }
        }
        return redirect()->route('home');
    }
    
    public function processRegister(Request $request)
    {
        // Validació del registre
        $data = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8'
        ]);

        if($data->fails()) {
            return Response::json([
                'success' => false,
                'message' => 'Validació fallida.',
                'errors' => $data->errors()
            ], 422);
        }

        $data = $data->validated();

        // Creació de l'usuari
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'avatar' => 'default-avatar.png', // Imatge per defecte
        ]);

        


        return redirect()->route('fidelitzacio')->with('success', 'Usuari registrat correctament.');
    }
}
