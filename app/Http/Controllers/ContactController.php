<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('Account.contact');
    }
    
    public function send(Request $request)
    {
        // Lògica per enviar el formulari de contacte
        return redirect()->back()->with('success', 'Missatge enviat correctament!');
    }
}
