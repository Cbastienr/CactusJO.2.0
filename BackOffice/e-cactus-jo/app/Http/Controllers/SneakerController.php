<?php

namespace App\Http\Controllers;

use App\Models\Sneaker;
use Illuminate\Http\Request;

class SneakerController extends Controller
{
    // Affiche la liste des sneakers (via API)
    public function index()
    {
        // Supposons que Sneaker::allFromApi() retourne un tableau
        $sneakersArray = Sneaker::allFromApi();

        // Convertir en collection Laravel si ce n'est pas déjà une collection
        $sneakers = collect($sneakersArray);

        return view('sneakers.index', compact('sneakers'));
    }

    // Affiche un sneaker spécifique (via API)
    public function show($uid)
    {
        $sneaker = Sneaker::findFromApi($uid);

        if (!$sneaker) {
            abort(404, 'Sneaker non trouvé');
        }

        return view('sneakers.show', compact('sneaker'));
    }

    // Crée un nouveau sneaker dans la base de données locale
    public function create()
    {
        return view('sneakers.create');
    }

    // Enregistre un sneaker dans la base de données locale
    public function store(Request $request)
    {
        $request->validate([
            'brand' => 'required|string|max:255',
            'colorway' => 'required|string|max:255',
            'estimatedMarketValue' => 'required|numeric|between:0,999999.99',
            'gender' => 'required|in:men,women,unisex',
            'image' => 'required|url',
            'links' => 'required|json',
            'name' => 'required|string|max:255',
            'release_date' => 'required|date_format:Y-m-d',
            'release_year' => 'required|digits:4',
            'retail_price' => 'required|numeric|between:0,999999.99',
            'silhouette' => 'required|string|max:255',
            'sku' => 'required|string|unique:sneakers,sku',
            'story' => 'nullable|string',
            'uid' => 'required|string|unique:sneakers,uid',
        ]);

        Sneaker::create($request->all());
        return redirect()->route('sneakers.index');
    }

    // Édite un sneaker
    public function edit($uid)
    {
        $sneaker = Sneaker::where('uid', $uid)->firstOrFail();
        return view('sneakers.edit', compact('sneaker'));
    }

    // Met à jour un sneaker dans la base de données locale
    public function update(Request $request, $uid)
    {
        $request->validate([
            'brand' => 'required|string|max:255',
            'colorway' => 'required|string|max:255',
            'estimatedMarketValue' => 'required|numeric|between:0,999999.99',
            'gender' => 'required|in:men,women,unisex',
            'image' => 'required|url',
            'links' => 'required|json',
            'name' => 'required|string|max:255',
            'release_date' => 'required|date_format:Y-m-d',
            'release_year' => 'required|digits:4',
            'retail_price' => 'required|numeric|between:0,999999.99',
            'silhouette' => 'required|string|max:255',
            'sku' => 'required|string|unique:sneakers,sku,' . $uid,
            'story' => 'nullable|string',
            'uid' => 'required|string|unique:sneakers,uid,' . $uid,
        ]);

        $sneaker = Sneaker::where('uid', $uid)->firstOrFail();
        $sneaker->update($request->all());
        return redirect()->route('sneakers.index');
    }

    // Supprime un sneaker de la base de données locale
    public function destroy($uid)
    {
        $sneaker = Sneaker::where('uid', $uid)->firstOrFail();
        $sneaker->delete();
        return redirect()->route('sneakers.index');
    }
}