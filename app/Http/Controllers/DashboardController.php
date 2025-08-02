<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Products;

class DashboardController extends Controller
{
    public function index() {
        return view('Dashboard.index');
    }

    public function users() {
        $users = User::all();
        return view('Dashboard.Usuaris.index', compact('users'));
    }

    public function deleteProduct(Request $request) {
        $request->validate([
            'id' => 'required|exists:products,id'
        ]);

        $product = Products::findOrFail($request->id);
        $product->delete();

        return redirect()->route('menu.admin')->with('success', 'Producto eliminado correctamente.');
    }

    public function addProduct(Request $request){
        $request->validate([
            'name' => 'required'
        ]);
        return redirect()->route('menu.admin.product')->with('success', 'Producto añadido correctamente');
    }
}
