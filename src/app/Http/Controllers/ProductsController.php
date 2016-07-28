<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Http\Controllers\Controller;
use App\ProductPhoto;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductEditRequest;
use Intervention\Image\ImageManager;

use App\Http\Traits\BrandAllTrait;
use App\Http\Traits\CategoryTrait;
use App\Http\Traits\SearchTrait;
use App\Http\Traits\CartTrait;


class ProductsController extends Controller {

    use  CategoryTrait, SearchTrait, CartTrait;


    /**
     * Show all products
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showProducts() {

        // Get all latest products, and paginate them by 10 products per page
        $product = Product::latest('created_at')->paginate(10);

        // Count all Products in Products Table
        $productCount = Product::all()->count();

        // From Traits/CartTrait.php
        // ( Count how many items in Cart for signed in user )
        $cart_count = $this->countProductsInCart();

        //dd($product);
        return view('admin.product.show', compact('productCount', 'product', 'cart_count'));
    }


    /**
     * Return the view for add new product
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addProduct() {
        // From Traits/CategoryTrait.php
        // ( This is to populate the parent category drop down in create product page )
        //$categories = $this->parentCategory();
        $categories = $this->categoryAll();

        // From Traits/BrandAll.php
        // Get all the Brands
       // $brands = $this->brandsAll();

        // From Traits/CartTrait.php
        // ( Count how many items in Cart for signed in user )
        $cart_count = $this->countProductsInCart();

        return view('admin.product.add', compact('categories', 'cart_count'));
    }


    /**
     * Add a new product into the Database.
     *
     * @param ProductRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addPostProduct(ProductRequest $request) {
        // Check if checkbox is checked or not for featured product
        $featured = Input::has('featured') ? true : false;

        // Replace any "/" with a space.
        $product_name =  str_replace("/", " " ,$request->input('product_name'));

        $product =new Product();
        $product->product_name = $product_name;
        $product->product_qty = $request->input('product_qty');
        $product->product_sku = $request->input('product_sku');
        $product->price = $request->input('price');
        $product->reduced_price = $request->input('reduced_price');
        $product->price = $request->input('category');
        $product->description = $request->input('description');
        $product->featured = $featured;
        //photo register
       // $product->photo = $this->savePhoto($request->file('photo'));

            // Save the product into the Database.
        $product->save();
        /*$productPhoto = ProductPhoto::create([
            'product_id'    =>$product->id,
            'name'          =>$product_name,
            'path'          =>$product->photo,
            'thumbnail_path'=>$product->photo,
        ]);*/

        //$productPhoto->save();
        // Flash a success message
            flash()->success('Success', 'Product created successfully!');
        // Redirect back to Show all products page.
        return redirect()->route('admin.product.show');
    }


    /**
     * This method will fire off when a admin chooses a parent category.
     * It will get the option and check all the children of that parent category,
     * and then list them in the sub-category drop-down.
     *
     * @return \Illuminate\Http\Response
     */
    public function categoryAPI() {
        // Get the "option" value from the drop-down.
        $input = Input::get('option');

        // Find the category name associated with the "option" parameter.
        $category = Category::find($input);

        // Find all the children (sub-categories) from the parent category
        // so we can display then in the sub-category drop-down list.
        $subcategory = $category->children();

        // Return a Response, and make a request to get the id and category (name)
        return \Response::make($subcategory->get(['id', 'category']));
    }


    /**
     * Return the view to edit & Update the Products
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editProduct($id) {

        $product = Product::with('category')->find($id);

        // If no product exists with that particular ID, then redirect back to Show Products Page.
        if (!$product) {
            return redirect('admin/products');
        }
        //$categories = $this->parentCategory();
        $categories = $this->categoryAll();

        // From Traits/CartTrait.php
        // ( Count how many items in Cart for signed in user )
        $cart_count = $this->countProductsInCart();

        // Return view with products and categories
        return view('admin.product.edit', compact('product', 'categories', 'cart_count'));

    }


    /**
     * Update a Product
     *
     * @param $id
     * @param ProductEditRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProduct($id, ProductEditRequest $request) {
        // Check if checkbox is checked or not for featured product
        $featured = Input::has('featured') ? true : false;

        // Find the Products ID from URL in route
        $product = Product::findOrFail($id);

        $product->product_name = $request->input('product_name');
        $product->product_qty = $request->input('product_qty');
        $product->product_sku = $request->input('product_sku');
        $product->category_id = $request->input('category');
        $product->price = $request->input('price');
        $product->reduced_price = $request->input('reduced_price');
        $product->price = $request->input('category');
        $product->description = $request->input('description');
        $product->featured = $featured;
        //photo register
        $urlphoto = $request->file('photo');
        if($urlphoto != null) {
            $product->photo = $this->savePhoto($request->file('photo'));
        }
        // Update the product with all the validation rules
        $product->update($request->all());
        //photo create
      /*  $productPhoto = ProductPhoto::create([
            'product_id'    =>$product->id,
            'name'          =>$product_name,
            'path'          =>$product->photo,
            'thumbnail_path'=>$product->photo,
        ]);*/
        // Flash a success message
        flash()->success('Success', 'Product updated successfully!');
        // Redirect back to Show all categories page.
        return redirect()->route('admin.product.show');
    }


    /**
     * Delete a Product
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteProduct($id) {

        if (Auth::user()->id == 2) {
            // If user is a test user (id = 2),display message saying you cant delete if your a test user
            flash()->error('Error', 'Cannot delete Product because you are signed in as a test user.');
        } else {
            // Find the product id and delete it from DB.
            Product::findOrFail($id)->delete();
        }

        // Then redirect back.
        return redirect()->back();
    }


    /**
     * Display the form for uploading images for each Product
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function displayImageUploadPage($id) {

        $product = Product::where('id', '=', $id)->get();
        //version moi
        ProductPhoto::where('product_id', '=', $id)->get();

        // From Traits/CartTrait.php
        // ( Count how many items in Cart for signed in user )
        $cart_count = $this->countProductsInCart();

        return view('admin.product.upload', compact('product', 'cart_count'));
    }


    /**
     * Show a Product in detail
     *
     * @param $product_name
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($product_name) {

        $user= \Auth::user();
        if($user){
            $new = Product::with(array('user'=> function($query){
                $query->where('user_id','=',\Auth::user()->id);
            }))->orderBy('created_at', 'desc')->where('featured', '=', 0)->take(4)->get();
        }else{
            // Find the product by the product name in URL
            $product = Product::ProductLocatedAt($product_name);
        }

        // Find the product by the product name in URL
        $product = Product::ProductLocatedAt($product_name);


        // From Traits/SearchTrait.php
        // Enables capabilities search to be preformed on this view )
        $search = $this->search();

        // From Traits/CategoryTrait.php
        // ( Show Categories in side-nav )
        $categories = $this->categoryAll();

        // Get brands to display left nav-bar
        //$brands = $this->BrandsAll();

        // From Traits/CartTrait.php
        // ( Count how many items in Cart for signed in user )
        $cart_count = $this->countProductsInCart();

        $similar_product = Product::where('id', '!=', $product->id)
            ->where(function ($query) use ($product) {
                $query->orWhere('category_id', '=', $product->category_id);
            })->get();

        /*$similar_product = Product::where('id', '!=', $product->id)
            ->where(function ($query) use ($product) {
                $query->where('brand_id', '=', $product->brand_id)
                    ->orWhere('cat_id', '=', $product->cat_id);
            })->get();*/

        return view('pages.show_product', compact('product', 'search', 'categories', 'similar_product', 'cart_count', 'user'));
    }

    //function pic save
    protected function savePhoto(UploadedFile $photo)
    {
        //dd($photo);
        $fileName = str_random(40) . '.' . $photo->guessClientExtension();
        $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'img'. DIRECTORY_SEPARATOR .'products';
        //dd($destinationPath);


        $photo->move($destinationPath, $fileName);

        return $fileName;
    }



}