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
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'price' => 'required|numeric|min:0',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'quantity' => 'required|integer|min:0',
                'type' => 'required|in:nutrition,accessoire,vetement'
            ]);

            if ($request->hasFile('image')) {
                try {
                    $image = $request->file('image');
                    $filename = Str::slug($validated['title']) . '-' . time() . '.' . $image->getClientOriginalExtension();
                    
                    // Vérifier si le dossier existe, sinon le créer
                    if (!Storage::disk('public')->exists('products')) {
                        Storage::disk('public')->makeDirectory('products');
                    }
                    
                    $path = $image->storeAs('products', $filename, 'public');
                    $validated['image'] = $path;
                } catch (\Exception $e) {
                    return back()->withInput()
                        ->with('error', 'Erreur lors de l\'upload de l\'image : ' . $e->getMessage());
                }
            }

            Product::create($validated);

            return redirect()->route('admin.dashboard')
                ->with('success', 'Produit ajouté avec succès.');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Erreur : ' . $e->getMessage());
        }
    }

    public function edit(Product $product)
    {
        $types = [
            'nutrition' => 'Nutrition',
            'accessoire' => 'Accessoire',
            'vetement' => 'Vêtement'
        ];
        
        return view('admin.products.edit', compact('product', 'types'));
    }

    public function update(Request $request, Product $product)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'price' => 'required|numeric|min:0',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'quantity' => 'required|integer|min:0',
                'type' => 'required|in:nutrition,accessoire,vetement'
            ]);

            if ($request->hasFile('image')) {
                try {
                    // Supprimer l'ancienne image
                    if ($product->image) {
                        Storage::disk('public')->delete($product->image);
                    }

                    $image = $request->file('image');
                    $filename = Str::slug($validated['title']) . '-' . time() . '.' . $image->getClientOriginalExtension();
                    $path = $image->storeAs('products', $filename, 'public');
                    $validated['image'] = $path;
                } catch (\Exception $e) {
                    return back()->withInput()
                        ->with('error', 'Erreur lors de l\'upload de l\'image : ' . $e->getMessage());
                }
            }

            $product->update($validated);

            return redirect()->route('shop')
                ->with('success', 'Produit modifié avec succès.');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Erreur : ' . $e->getMessage());
        }
    }

    public function destroy(Product $product)
    {
        try {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            
            $product->delete();
            
            return redirect()->route('shop')
                ->with('success', 'Produit supprimé avec succès.');
        } catch (\Exception $e) {
            return back()->with('error', 'Erreur lors de la suppression : ' . $e->getMessage());
        }
    }
} 