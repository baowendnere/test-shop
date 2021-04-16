<?php

namespace App\Http\Controllers;

use App\Exports\ProductsExport;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class MainController extends Controller
{
    public function addProduct()
    {
        $Product = Product::create([
            "designation" => "Cahier",
            "description" => "La description du cahier",
            "prix" => 500
        ]);

        dd($Product);
    }

    public function addCategory()
    {
        $category = Category::create([
            "libelle" => "Vetement",
            "description" => "La description du vetement"
        ]);

        $product = Product::create([
            "category_id" => $category->id,
            "designation" => "Pantalon",
            "description" => "La description du pantalon",
            "prix" => 5000
        ]);

        dump($category);
        dd($product);
    }

    public function updateProduct(Product $id)
    {
        dump($id);
        // $product = Product::findOrFail($id);
        // dump($product);
        $id -> designation = "Chemise";
        $id -> description = "La description de la chemise";
        $id -> prix = 6000;
        $id -> save();
        dd($id);
    }

    public function updateProduct2()
    {
        // $product = Product::findOrFail(2);
        $result = Product::where("id", 2)->update([
            "designation" => "Tricot",
            "description" => "La description du tricot",
            "designation" => 3500,
        ]);
        dd($result);
    }

    public function deleteProduct($id)
    {
        // $product = Product::findOrFail(2);
        $result = Product::destroy($id);
        dd($result);
    }

    public function getProduct(Product $product)
    {
        $category = Category::first();
        dd($category, $category->products);
        dd($product->category);
    }

    public function addCommand()
    {
        // $user = User::create([
        //     "name" => "Tanguy KABORE",
        //     "email" => "admin@admin.com",
        //     "password" => Hash::make("admin")
        // ]);
        
        $user = User::first();
        $product1 = Product::first();
        $product2 = Product::findOrFail(2);
        
        // $user->products()->attach($product1);
        $user->products()->sync($product2);
        dd($user->products);
    }

    public function welcome()
    {
        $products = Product::orderByDesc("id")->take(9)->get();
        return view("welcome", ["products" => $products]);
    }

    public function testCollection()
    {
        $collection1 = collect([
            [
                "title" => "Mon super livre 1",
                "price" => 1000,
                "description" => "La description du livre 1"
            ],
            [
                "title" => "Mon super livre 2",
                "price" => 2000,
                "description" => "La description du livre 2"
            ],
            [
                "title" => "Mon super livre 3",
                "price" => 3000,
                "description" => "La description du livre 3"
            ]
        ]);

        
        dd($collection1);
    }

    public function exportProducts()
    {
        return Excel::download(new ProductsExport, "products.xlsx");
    }
}
