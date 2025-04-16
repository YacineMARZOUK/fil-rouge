<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ShopController extends Controller
{
    /**
     * Affiche la liste des produits
     */
    public function index(Request $request)
    {
        $query = Product::query();

        // Filtrage par type
        if ($request->has('type')) {
            $query->where('type', $request->type);
        }

        // Recherche par nom
        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Tri
        $sort = $request->input('sort', 'title');
        $direction = $request->input('direction', 'asc');
        
        switch ($sort) {
            case 'price-asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price-desc':
                $query->orderBy('price', 'desc');
                break;
            case 'name':
                $query->orderBy('title', $direction);
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        // Récupérer les types uniques pour le filtre
        $types = Product::distinct()->pluck('type');

        // Paginer les résultats
        $products = $query->paginate(12);

        return view('shop.index', compact('products', 'types'));
    }

    /**
     * Affiche les détails d'un produit
     */
    public function show(Product $product)
    {
        return view('shop.show', compact('product'));
    }
} 