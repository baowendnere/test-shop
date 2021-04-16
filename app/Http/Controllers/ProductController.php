<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Mail\ProductAdd;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ProductFormRequest;
use App\Notifications\EditProduct;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderByDesc("id")->paginate(15);
        // dump($products);
        // $product = new Product();
        // $product->designation = "Livre";
        // $product->description = "La description du livre";
        // $product->prix = 2000;
        // $product->save();
        // $product500 = Product::where("prix", 500)->get();
        // $product500 = Product::where(["prix" => 500, "designation" => "cahier"])->get();
        // $product = Product::find(1);
        // $product = Product::findOrFail(10);
        // $firstProduct = Product::first();
        // dd($firstProduct);
        // dd($product);
        // dd($product500);
        // dd($products);
        return view("frontend.products.index", ["products" => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $product = new Product;
        return view("frontend.products.create",["categories" => $categories, "product" => $product]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductFormRequest $request)
    {

        // dd($request->file('image'));
        $imageName ="product.png";
        if($request->file('image')){
            $imageName = time().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs("public/uploads/products", $imageName);
        }
        
        $request->session()->put("imageName", $imageName);

       $product= Product::create([
            "designation"=>$request->designation,
            "prix"=>$request->prix,
            "category_id"=>$request->category_id,
            "description"=>$request->description,
            "image" => $imageName,
        ]);

        $user = User::first();
        if($user)
        Mail::to($user)->send(new ProductAdd);

        return redirect()->route('products.index')->with("statut", "Le produit a bien été ajouté !");

        //dd($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view("frontend.products.edit", ["product" => $product,
        "categories" => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductFormRequest $request, $id)
    {
        // dd($request);
        Product::where("id", $id)->update([
           "designation" => $request->designation,
           "prix" => $request->prix,
           "category_id" => $request->category_id,
           "description" => $request->description,
       ]);
        
       $user = User::first();
        if($user)
        $user->notify(new EditProduct);

       return redirect()->route('products.index')->with("statut", "Le produit a bien été modifié !");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::destroy($id);
        return redirect()->route('products.index')->with("statut", "Le produit a bien été supprimé !");
    }
}
