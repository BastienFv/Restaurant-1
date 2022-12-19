<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProduitController extends Controller
{
    public function index()
    {
        $id = Auth::user();
    //    dd($id);
        //Illuminate\Database\QueryException: SQLSTATE[HY000]: General error: 1364 Field 'restaurateur_id' doesn't have a default    ->where('produits.restaurateur_id', '=', Auth::user()->id)value (SQL: insert into `produits` (`nom_produit`, `categorie_id`, `description`, `prixHT`, `TVA`, `prixTTC`, `quantite`, `updated_at`, `created_at`) values (1231, 3, 123, 123, 10, 123, 123, 2022-12-15 11:41:16, 2022-12-15 11:41:16)) in file /Users/vladimirsinkevitch/Desktop/Developpeur/Restaurant/restaurant_laravel/vendor/laravel/framework/src/Illuminate/Database/Connection.php on line 760
    //    $produits = Produit::all();
      //  $produits = Produit::find(Auth::user());
        $produits = Produit::find($id);
    

       // id
     //  $produits = Produit::where('produits.restaurateur_id', '=', Auth::user()->re)->get();

        return response()->json([
            'restaurateur_id' => $id,
            'produits' => $produits,
            'produits' => DB::table('produits')
                ->Join('categories', 'categories.id', '=', 'categorie_id')
                ->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   /*  public function create()
    {
        //
    } */

    public function store(Request $request)
    {
        // create a new product
        $request->validate([
            'nom_produit' => 'required|string',
            'categorie_id' => 'required|integer',
            'description' => 'required',
            'prixHT' => 'required|integer',
            'TVA' => '',
            'prixTTC' => 'required|integer',
            'quantite' => 'required|integer',
            'restaurateur_id' => 'required|integer',
        ]);

        $produit = Produit::create([
            'nom_produit' => $request->nom_produit,
            'categorie_id' => $request->categorie_id,
            'description' => $request->description,
            'prixHT' => $request->prixHT,
            'TVA' => $request->TVA,
            'prixTTC' => $request->prixTTC,
            'quantite' => $request->quantite,
            'restaurateur_id' => $request->restaurateur_id,
        ]);

        return response()->json(['produit' => $produit]);
    }

    public function show($id)
    {
        // show a product
        $produit = Produit::find($id);
        return response()->json(['produit' => $produit]);
    }


    public function edit($id)
    {
        // edit a product
        $produit = Produit::find($id);
        return response()->json(['produit' => $produit]);
    }

    public function update(Request $request, $id)
    {
        // update a product
        $request->validate([
            'nom_produit' => 'required|string',
            'categorie' => 'required|string',
            'description' => 'required|string',
            'prixHT' => 'required|float',
            'TVA' => 'required|float',
            'prixTTC' => 'required|float',
            'quantite' => 'required|integer',
        ]);

        $produit = Produit::find($id);
        $produit->nom_produit = $request->nom_product;
        $produit->categorie_id = $request->categorie_id;
        $produit->description = $request->description;
        $produit->prixHT = $request->prixHT;
        $produit->TVA = $request->TVA;
        $produit->prixTTC = $request->prixTTC;
        $produit->save();

        return response()->json([
            'message' => 'Produit updated.',
            'produit' => $produit
        ], 201);
    }


    public function destroy($id)
    {
        // delete a product
        $produit = Produit::find($id);
        $produit->delete();
        return response()->json([
            'message' => 'Produit deleted.',
            'produit' => $produit
        ], 201);
    }
}
