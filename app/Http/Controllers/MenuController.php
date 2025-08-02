<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\ProductsCategory;
use App\Models\Label;
use App\Models\ProductTranslation;

class MenuController extends Controller
{
    public function menu()
    {
        return view('Menu.menu');
    }

    public function menuAdmin() 
    {
        $products = Products::with(['category', 'label', 'translations'])->get();
        $categories = ProductsCategory::all();
        $labels = Label::all();
        
        return view('Menu.admin', compact('products', 'categories', 'labels'));
    }

    // ========== GESTIÓ DE PRODUCTES ==========
    
    public function createProduct(Request $request) 
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'label_id' => 'nullable|string|max:255',
            'category_id' => 'required|exists:products_categories,id',
            'translations' => 'required|array',
            'translations.*.locale' => 'required|string|max:5',
            'translations.*.name' => 'required|string|max:255',
            'translations.*.description' => 'nullable|string',
        ]);

        $product = Products::create($request->except('translations'));
        foreach ($request->input('translations', []) as $translation) {
            $product->translations()->create($translation);
        }

        return redirect()->route('admin.products')->with('success', 'Producte creat correctament.');
    }

    public function updateProduct(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:products,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'label_id' => 'nullable|string|max:255',
            'category_id' => 'required|exists:products_categories,id',
            'translations' => 'array',
            'translations.*.locale' => 'required|string|max:5',
            'translations.*.name' => 'required|string|max:255',
            'translations.*.description' => 'nullable|string',
        ]);

        $product = Products::findOrFail($request->id);
        $product->update($request->except(['id', 'translations']));

        // Actualitzar traduccions
        if ($request->has('translations')) {
            $product->translations()->delete(); // Esborrar traduccions existents
            foreach ($request->input('translations', []) as $translation) {
                $product->translations()->create($translation);
            }
        }

        return redirect()->route('admin.products')->with('success', 'Producte actualitzat correctament.');
    }

    public function deleteProduct(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:products,id',
        ]);

        $product = Products::findOrFail($request->id);
        $product->translations()->delete();
        $product->delete();

        return redirect()->route('admin.products')->with('success', 'Producte eliminat correctament.');
    }

    // ========== GESTIÓ DE CATEGORIES ==========
    
    public function createCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        ProductsCategory::create($request->all());

        return redirect()->route('admin.products')->with('success', 'Categoria creada correctament.');
    }

    public function updateCategory(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:products_categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category = ProductsCategory::findOrFail($request->id);
        $category->update($request->except('id'));

        return redirect()->route('admin.products')->with('success', 'Categoria actualitzada correctament.');
    }

    public function deleteCategory(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:products_categories,id',
        ]);

        $category = ProductsCategory::findOrFail($request->id);
        
        // Verificar si té productes associats
        if ($category->products()->count() > 0) {
            return redirect()->route('admin.products')
                ->with('error', 'No es pot eliminar la categoria perquè té productes associats.');
        }

        $category->delete();
        return redirect()->route('admin.products')->with('success', 'Categoria eliminada correctament.');
    }

    // ========== GESTIÓ D'ETIQUETES ==========
    
    public function createLabel(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:255',
        ]);

        Label::create($request->all());

        return redirect()->route('admin.products')->with('success', 'Etiqueta creada correctament.');
    }

    public function updateLabel(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:labels,id',
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:255',
        ]);

        $label = Label::findOrFail($request->id);
        $label->update($request->except('id'));

        return redirect()->route('admin.products')->with('success', 'Etiqueta actualitzada correctament.');
    }

    public function deleteLabel(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:labels,id',
        ]);

        $label = Label::findOrFail($request->id);
        
        // Verificar si té productes associats
        if ($label->products()->count() > 0) {
            return redirect()->route('admin.products')
                ->with('error', 'No es pot eliminar l\'etiqueta perquè té productes associats.');
        }

        $label->delete();
        return redirect()->route('admin.products')->with('success', 'Etiqueta eliminada correctament.');
    }

    // ========== API ENDPOINTS ==========
    
    public function getProductsByCategory($categoryId)
    {
        $products = Products::where('category_id', $categoryId)
            ->with(['label', 'translations'])
            ->get();
        return response()->json($products);
    }

    public function getProductsByLabel($labelId)
    {
        $products = Products::where('label_id', $labelId)
            ->with(['category', 'translations'])
            ->get();
        return response()->json($products);
    }

    public function getProductDetails($productId)
    {
        $product = Products::with(['category', 'label', 'translations'])
            ->findOrFail($productId);
        return response()->json($product);
    }
}
