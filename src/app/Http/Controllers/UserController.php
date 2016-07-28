<?php

namespace App\Http\Controllers;

use App\Http\Traits\CartTrait;
use App\Http\Traits\CategoryTrait;
use App\Http\Traits\SearchTrait;
use App\Product;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class UserController extends Controller
{
    use  CategoryTrait, SearchTrait, CartTrait;

    //user client list
    public function showUsers()
    {

        // Get all latest products, and paginate them by 10 products per page
        $users = User::latest('created_at')->paginate(10);

        // Count all Products in Products Table
        $userCount = User::all()->count();

        // From Traits/CartTrait.php
        // ( Count how many items in Cart for signed in user )
        $cart_count = $this->countProductsInCart();

        //dd($product);
        return view('admin.user.show', compact('userCount', 'users', 'cart_count'));
    }

    //driver list user
    public function showUsersDriver()
    {

        // Get all latest products, and paginate them by 10 products per page
        $users = User::where('role', 'driver')->get();

        // Count all Products in Products Table
        $userCount = User::where('role', 'driver')->count();

        // From Traits/CartTrait.php
        // ( Count how many items in Cart for signed in user )
        $cart_count = $this->countProductsInCart();

        //dd($product);
        return view('admin.user.driver.show', compact('userCount', 'users', 'cart_count'));
    }

    //dirver add form
    public function getDriverAdd()
    {
        // From Traits/CartTrait.php
        // ( Count how many items in Cart for signed in user )
        $cart_count = $this->countProductsInCart();

        return view('admin.user.driver.add', compact('cart_count'));
    }

    public function postDriverAdd(Requests\DriverRequest $request/*, AppMailers $mailer*/)
    {

        // Create the user in the DB.
        //dd('hello post drive');

        /*Pas oublier d'ajouter au fillable !*/
        $user = User::create([
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'zip' => $request->input('zip'),
            'role' => 'driver',
            'password' => bcrypt($request->input('password')),
            'verified' => 1,
        ]);

        /*/**
         * send email conformation to user that just registered.
         * -- sendEmailConfirmationTo is in Mailers/AppMailers.php --
         */
        //$mailer->sendEmailConfirmationTo($user);

        // Flash a info message saying you need to confirm your email.
        //flash()->overlay('Info', 'Please confirm your email address in your inbox.');
        flash()->overlay('Info', 'Driver ' . $user->first_name . ' ' . $user->last_name . ' Add');

        return redirect()->back();

    }

    //edit drive !!
    public function getDriverEdit($id)
    {

        // dd('edit driver');
        //get user by id
        $user = User::findOrFail($id);
        // From Traits/CartTrait.php
        // ( Count how many items in Cart for signed in user )
        $cart_count = $this->countProductsInCart();

        return view('admin.user.driver.edit', compact('cart_count', 'user'));
    }

    public function postDriverEdit($id, Requests\DriverEditRequest $request)
    {

        // Find the Products ID from URL in route
        $user = User::findOrFail($id);


        $user->email = $request->input('email');
        $user->username = $request->input('username');
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->address = $request->input('address');
        $user->city = $request->input('city');
        $user->zip = $request->input('zip');
        $user->role = 'driver';
        $user->password = bcrypt($request->input('password'));
        $user->verified = 1;
        //dd($user);
        $user->update($request->all());
        flash()->overlay('Info', 'Driver ' . $user->first_name . ' ' . $user->last_name . ' Update');


        return redirect()->back();
    }
    public function showUserProductPrice($id)
    {

        //dd($id);
        // Get all latest products, and paginate them by 10 products per page
       // $users = User::with('product')->get($id);
        $user = User::find($id);

        // Count all Products in Products Table
        $products = Product::all();
        //dd($products);
        $product = $products[4];

        //dd($user->id);
        //dd($product->user()->find($id)->pivot->price);

        // From Traits/CartTrait.php
        // ( Count how many items in Cart for signed in user )

        $cart_count = $this->countProductsInCart();

        //dd($product);
        return view('admin.user.productprice', compact('products', 'users', 'cart_count'));
    }
    public function addUserProductPrice(Requests\PriceAddRequest $request)
    {
        //dd($request);

        //user_id get information
        $user_id = $request->input('id_user');
        //get all information from user with the id
        $user = Product::find($user_id);
        //prodduct_id get product id number
        $product_id = $request->input('id_product');
        //get all information about the product with the id
        $product = Product::find($product_id);

        //get the special price for yser
        $price = $request->input('price');

        //validation if price = 0 delet the sync
        if($price ==0 ){
            $product->user()->sync([]);
            flash()->success('Success', 'Special Price deleted !');
        }else{
            $product->user()->sync([$user_id,['price'=>$price]]);
            flash()->success('Success', 'Special Price Updated !');
        }

        //flash notification for update

        // Redirect back to Show all products page.
        return redirect()->route('admin.user.price.show', compact('user_id'));
    }
    public function showAdminUser()
    {

        // Get all latest products, and paginate them by 10 products per page
        $users = User::where('role', 'client')->get();

        // Count all Products in Products Table
        $userCount = User::where('role', 'client')->count();

        // From Traits/CartTrait.php
        // ( Count how many items in Cart for signed in user )
        $cart_count = $this->countProductsInCart();

        //dd($product);
        return view('admin.user.admin.show', compact('userCount', 'users', 'cart_count'));
    }

}
