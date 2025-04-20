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

    /**
     * Affiche la liste des produits
     */
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Affiche le formulaire de création
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Enregistre un nouveau produit
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'category' => 'required|string',
                'price' => 'required|numeric|min:0',
                'stock' => 'required|integer|min:0',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = Str::slug($validated['name']) . '-' . time() . '.' . $image->getClientOriginalExtension();
                
                // Vérifier si le dossier existe, sinon le créer
                if (!Storage::disk('public')->exists('products')) {
                    Storage::disk('public')->makeDirectory('products');
                }
                
                $path = $image->storeAs('products', $filename, 'public');
                $validated['image'] = $path;
            }

            Product::create($validated);

            return redirect()->route('admin.products.index')
                ->with('success', 'Produit créé avec succès.');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Erreur lors de la création du produit : ' . $e->getMessage());
        }
    }

    /**
     * Affiche le formulaire d'édition
     */
    public function edit(Product $product)
    {
        $types = [
            'nutrition' => 'Nutrition',
            'accessoire' => 'Accessoire',
            'vetement' => 'Vêtement'
        ];
        
        return view('admin.products.edit', compact('product', 'types'));
    }

    /**
     * Met à jour un produit
     */
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

            return redirect()->route('admin.products.index')
                ->with('success', 'Produit mis à jour avec succès.');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Erreur : ' . $e->getMessage());
        }
    }

    /**
     * Supprime un produit
     */
    public function destroy(Product $product)
    {
        try {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            
            $product->delete();
            
            return redirect()->route('admin.products.index')
                ->with('success', 'Produit supprimé avec succès.');
        } catch (\Exception $e) {
            return back()->with('error', 'Erreur lors de la suppression : ' . $e->getMessage());
        }
    }
} 