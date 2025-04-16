<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    public function create()
    {
        $types = [
            'nutrition' => 'Nutrition',
            'accessoire' => 'Accessoire',
            'vetement' => 'Vêtement'
        ];
        
        return view('admin.products.create', compact('types'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'price' => 'required|numeric|min:0',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'stock' => 'required|integer|min:0',
                'type' => 'required|in:nutrition,accessoire,vetement'
            ]);

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = Str::slug($validated['name']) . '-' . time() . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('products', $filename, 'public');
                $validated['image'] = $path;
            }

            Product::create($validated);

            return redirect()->route('admin.dashboard')
                ->with('success', 'Produit ajouté avec succès.');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Une erreur est survenue lors de l\'ajout du produit. Veuillez réessayer.');
        }
    }
} 