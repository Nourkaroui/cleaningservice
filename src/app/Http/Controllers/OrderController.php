<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Mailers\AppMailers;
use App\Order;
use Carbon\Carbon;
use Validator;
use App\Product;
use Stripe\Stripe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Routing\Controller as BaseController;

use App\Http\Traits\BrandAllTrait;
use App\Http\Traits\CategoryTrait;
use App\Http\Traits\SearchTrait;
use App\Http\Traits\CartTrait;


class OrderController extends Controller {

    
    use BrandAllTrait, CategoryTrait, SearchTrait, CartTrait;


    /**
     * Show products in Order view
     * 
     * @return mixed
     */
    public function index() {

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

        // Set the $user_id the the currently authenticated user
        $user_id = Auth::user()->id;
        $user = Auth::user();
        //dd($user);

        // Count the items in a signed in users shopping cart
        $check_cart = Cart::with('products')->where('user_id', '=', $user_id)->count();

        // Count all the products in a cart  with the currently signed in user
        $count = Cart::where('user_id', '=', $user_id)->count();

        // If there are no items in users shopping cart, redirect them back to cart
        // page so they cant access checkout view with no items
        if (!$check_cart) {
            return redirect()->route('cart');
        }

        // Set $cart_books to the member ID, along with the products.
        // ( "products" is coming from the Products() method in the Product.php Model )
        $cart_products = Cart::with('products')->where('user_id', '=', $user_id)->get();

        // Set $cart_products to the total in the Cart for that user_id to check and see if the cart is empty
        $cart_total = Cart::with('products')->where('user_id', '=', $user_id)->sum('total');
        $cart_grand_total = $cart_total-$user->discount;
        //dd($cart_total, $cart_total, $user->discount,$cart_total-$user->discount );

        return view('cart.checkout', compact('search', 'categories', 'cart_count', 'count','user'))
            ->with('cart_products', $cart_products)
            ->with('cart_total', $cart_total)
            ->with('cart_grand_total',$cart_grand_total);
    }


    /**
     * Make the order when user enters all credentials
     * 
     * @param Request $request
     * @return mixed
     */
    public function postOrder(Request $request, AppMailers $mailer) {

        $user = Auth::user();


        // Validate each form field
        $validator = Validator::make($request->all(), [
            //'first_name' => 'required|max:30|min:2',
            //'last_name'  => 'required|max:30|min:2',
        ]);

        // If error occurs, display it
        if ($validator->fails()) {
            return redirect('/checkout')
                ->withErrors($validator)
                ->withInput();
        }

        // Set your secret key: remember to change this to your live secret key in production
        Stripe::setApiKey('YOUR STRIPE SECRET KEY');

        // Set Inputs to the the form fields so we can store them in DB
        //$first_name = Input::get('first_name');


        // Set $user_id to the currently authenticated user
        $user_id = Auth::user()->id;

        // Set $cart_products to the Cart Model with its products where
        // the user_id = to the current signed in user ID
        $cart_products = Cart::with('products')->where('user_id', '=', $user_id)->get();

        // Set $cart_total to the Cart Model alond with all its products, and
        // where the user_id = the current signed in user ID, and
        // also get the sum of the total field.
        $cart_total = Cart::with('products')->where('user_id', '=', $user_id)->sum('total');

        $cart_grand_total = $cart_total-$user->discount;
        //  Get the total, and set the charge amount
        $charge_amount = number_format($cart_total, 2) * 100;

        //dd($charge_amount);
        // Create the charge on Stripe's servers - this will charge the user's card
        /*try {
            $charge = \Stripe\Charge::create(array(
                'source' => $request->input('stripeToken'),
                'amount' => $charge_amount, // amount in cents, again
                'currency' => 'usd',
            ));

        } catch(\Stripe\Error\Card $e) {
            // The card has been declined
            echo $e;
        }*/


        //dd('hello');
        // Create the order in DB, and assign each variable to the correct form fields

        /*$order = Order::create (
            array(
                'user_id'       => $user_id,
                'date'          => Carbon::now(),
                'total'         => $cart_total,
                'Shipping'      => 0,
                'total_shipping'=> $cart_total,
                'user_discount' => $user->discount,
                'grand_total'   => $cart_grand_total,

            ));

        // Attach all cart items to the pivot table with their fields
        foreach ($cart_products as $order_products) {
            $order->orderItems()->attach($order_products->product_id, array(
                'qty'    => $order_products->qty,
                'price'  => $order_products->products->price,
                'reduced_price'  => $order_products->products->reduced_price,
                'total'  => $order_products->products->price * $order_products->qty,
                'total_reduced'  => $order_products->products->reduced_price * $order_products->qty,
            ));
        }


        // Decrement the product quantity in the products table by how many a user bought of a certain product.
        \DB::table('products')->decrement('product_qty', $order_products->qty);

        
        // Delete all the items in the cart after transaction successful
        Cart::where('user_id', '=', $user_id)->delete();*/

        $mailer->sendEmailOrderTo($user, $cart_total, $cart_products, $cart_grand_total);
        // Then return redirect back with success message
        flash()->success('Success', 'Your order was processed successfully.');

        return redirect()->route('cart');

    }

    /************************************************************* Admin Order ***************************************************/

    public function showOrder(){

        // From Traits/CartTrait.php
        // ( Count how many items in Cart for signed in user )
        $cart_count = $this->countProductsInCart();

        // Get all the orders in DB
        $orders = Order::with('user')->get();

        // Get the grand total of all totals in orders table
        $count_total = Order::sum('total');


        // Get all the carts in DB
        $carts = Cart::all();

        return view('admin.order.show', compact('cart_count', 'orders', 'users', 'carts', 'count_total', 'products', 'product_quantity'));

    }
    /**
    validation of order this methode is actif for admin or super user only
     */
    public function validateOrder($id){

        //find order
        $order = Order::find($id);

        //validate order
        $order->cancel = 0;
        $order->validation = 1;
        $order->save();

        return redirect()->route('admin.order.show');
    }
    /**
    cancel of order this methode is actif for user and admin or super user only
     */
    public function cancelOrder($id){


        //find order
        $order = Order::find($id);

        //cancel order
        $order->cancel = 1;
        $order->validation = 0;
        $order->save();

        return redirect()->route('admin.order.show');
    }

    public function deliveredOrder($id){

        //find order
        $order = Order::find($id);

        //validate order
        $order->cancel = 0;
        $order->validation = 1;
        $order->delivered = 1;

        dd('changer la redirect');
        return redirect()->route('admin.order.show');
    }


    }