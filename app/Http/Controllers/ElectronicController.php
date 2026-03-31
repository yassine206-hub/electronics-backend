<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Electronic;

class ElectronicController extends Controller
{
    // Get all products
    public function index()
    {
        $electronics = Electronic::all();
        return response()->json($electronics);
    }

    // Add a product
    public function store(Request $request)
    {
        $electronic = new Electronic();
        $electronic->name = $request->name;
        $electronic->category = $request->category;
        $electronic->price = $request->price;
        $electronic->quantity = $request->quantity;
        $electronic->description = $request->description;
        $electronic->manufacturer = $request->manufacturer;
        $electronic->model_number = $request->model_number;
        $electronic->save();

        return response()->json(['message' => 'Product added', 'product' => $electronic]);
    }

    // Update a product
    public function update(Request $request, $id)
    {
        $electronic = Electronic::find($id);
        $electronic->name = $request->name;
        $electronic->category = $request->category;
        $electronic->price = $request->price;
        $electronic->quantity = $request->quantity;
        $electronic->description = $request->description;
        $electronic->manufacturer = $request->manufacturer;
        $electronic->model_number = $request->model_number;
        $electronic->save();

        return response()->json(['message' => 'Product updated', 'product' => $electronic]);
    }

    // Delete a product
    public function destroy($id)
    {
        $electronic = Electronic::find($id);
        $electronic->delete();

        return response()->json(['message' => 'Product deleted']);
    }

    // Search products
    public function search(Request $request)
    {
        $query = $request->query('q');
        $electronics = Electronic::where('name', 'like', '%' . $query . '%')->get();
        return response()->json($electronics);
    }

    // Upload image for a product
    public function uploadImage(Request $request, $id)
    {
        $electronic = Electronic::find($id);

        // Sauvegarder l'image dans le dossier public/images
        $image = $request->file('image');
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('images'), $imageName);

        // Sauvegarder le nom de l'image dans la base de données
        $electronic->image = $imageName;
        $electronic->save();

        return response()->json(['message' => 'Image uploaded', 'image' => $imageName]);
    }
}