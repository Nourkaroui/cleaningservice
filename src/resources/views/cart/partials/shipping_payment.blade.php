@if ($cart_total === 0)

@else
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default" id="Checkout-Shipping-Payment-Container">
                <div class="panel-heading">Order Details</div>
                <div class="panel-body">

                    <form id="payment-form" role="form" method="POST" action="/cleaningservice/order">
                        {!! csrf_field() !!}

                        <div class="alert alert-danger payment-errors @if(!$errors->any()){{'hidden'}}@endif">
                            {{$errors->first('error')}}
                        </div>

                        <div class="col-md-4">
                            <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                <div class="heading">Shipping Address : </div>
                                <hr>
                                <div class="center-on-small-only">
                                    {{$user->first_name.' '.$user->last_name }}
                                </div>
                                <div class="center-on-small-only">
                                    {{$user->address }}
                                </div>
                                <div class="center-on-small-only">
                                    {{$user->city }}
                                </div>
                                <p class="center-on-small-only">
                                    {{$user->zip }}
                                </p>
                            </div>

                        </div>

                        <div class="col-md-2">
                            </div>
                        <div class="col-md-6">

                        <div class="heading">Payment information</div>
                            <hr>
                            <div class="col-sm-6 col-md-6 center-on-small-only">
                                Item(s) Subtotal :
                            </div>
                            <div class="col-sm-6 col-md-6 center-on-small-only">
                                ￥{{$cart_total-0}}
                            </div>
                            <br>
                            <div class="col-sm-6 col-md-6 center-on-small-only">
                                Shipping & Handling:
                                </div>
                            <div class="col-sm-6 col-md-6 center-on-small-only">
                                ￥ 0
                            </div>
                            <br>
                            <div class="col-sm-6 col-md-6 center-on-small-only">
                                Total:
                            </div>
                            <div class="col-sm-6 col-md-6 center-on-small-only">
                                ￥{{$cart_total-0}}
                            </div>
                            <div class="col-sm-6 col-md-6 center-on-small-only">
                                Promotion Applied:
                            </div>
                            <div class="col-sm-6 col-md-6 center-on-small-only">
                                ￥{{$user->discount-0}}
                            </div>
                            <br>
                            <hr>

                            <div class="col-sm-6 col-md-6 center-on-small-only">
                                Grand Total:
                            </div>
                            <div class="col-sm-6 col-md-6 center-on-small-only">
                               <div class="light-300 black-text medium-500 center-on-small-only"> ￥{{$cart_grand_total}}</div>
                            </div>

                        <br>
                            <br><br>
                            </div>
                        <!--List product start-->

                        @foreach($cart_products as $cart_item)

                            <div class="col-sm-12 col-md-12" >
                                <div class="col-sm-5 col-md-3 center-on-small-only">
                                    <a href="{{ route('show.product', $cart_item->products->product_name) }}">
                                        <h6 class="center-on-small-only" id="featured-product-name">{{ $cart_item->products->product_name }}</h6><br>
                                        @if ($cart_item->products->photos->count() === 0)
                                            <img src="/cleaningservice/src/public/images/no-image-found.jpg" alt="No Image Found Tag" id="Product-similar-Image" style="width: 50px; height: 50px;" >
                                        @else
                                            @if ($cart_item->featuredPhoto)
                                                <img src="/cleaningservice/{{ $cart_item->featuredPhoto->thumbnail_path }}" alt="Photo ID: {{ $cart_item->featuredPhoto->id }}" style="width: 50px; height: 50px;" />
                                            @elseif(!$cart_item->featuredPhoto)
                                                <img src="/cleaningservice/{{ $cart_item->products->photos->first()->thumbnail_path}}" alt="Photo" style="width:50px; height: 50px;" />
                                            @else
                                                N/A
                                            @endif
                                        @endif
                                    </a>
                                </div>
                                <div class="col-sm-5 col-md-2" id="Carts-Sub-Containers">
                                    @if($cart_item->products->reduced_price == 0)
                                        <div class="center-on-small-only">PRODUCT PRICE</div> <div class="light-300 black-text medium-500 center-on-small-only" id="Product_Reduced-Price-Cart">${{ $cart_item->products->price }}</div>
                                        <br>
                                        <p class="center-on-small-only">ID: {{ $cart_item->products->product_sku }}</p>
                                    @else
                                        <div class="center-on-small-only">PRODUCT PRICE</div> <div class="green-text medium-500 center-on-small-only" id="Product_Reduced-Price-Cart">${{ $cart_item->products->reduced_price }}</div>
                                        <br>
                                        <p class="center-on-small-only">ID: {{ $cart_item->products->product_sku }}</p>
                                    @endif
                                </div>
                                <div class="col-sm-1 col-md-1">
                                    <div class=" center-on-small-only"> QTY</div>
                                    <div class=" center-on-small-only"><b>{{$cart_item->qty}}</b></div>
                                </div>
                                <div class="col-sm-3 col-md-2" id="Carts-Sub-Containers">
                                    <div class="center-on-small-only">PRODUCT TOTAL</div>
                                    <div class="black-text medium-500 center-on-small-only" id="Product_Reduced-Price-Cart">${{$cart_item->total}}</div>
                                </div>
                        </div>
                        @endforeach

                        <!--payment maybe other time -->
                        {{--

                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('full_name') ? ' has-error' : '' }}">
                                <label>Name On Card</label>
                                <input type="text" class="form-control" size="20" name="full_name"
                                       value="{{ old('full_name') }}">
                                @if ($errors->has('full_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('full_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Card Number</label>
                                <input type="text" class="form-control" maxlength="19" data-stripe="number">
                                <p>For test purposes enter: 4242 4242 4242 4242</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>CVC</label>
                                <input type="text" class="form-control" maxlength="4" data-stripe="cvc"/>
                                <p>For test purposes enter: 123</p>
                            </div>
                        </div>

                        <!--<div class="form-group">
                            <label class="col-md-4 control-label">Expiration (MM/YYYY)</label>
                            <div class="col-md-6">
                                <input style="width: 20% !important; display: inline !important;" type="text" class="form-control" size="2" data-stripe="exp-month"/>
                                <span style="font-size: 30px; vertical-align: middle">/</span>
                                <input style="width: 40% !important; display: inline !important;" type="text" class="form-control" size="4" data-stripe="exp-year"/>
                            </div>
                        </div> -->

                        <div class="form-group">
                            <div class="col-md-3">
                                {!! Form::label(null, 'Ex. Month') !!}
                                {!! Form::selectMonth(null, null, ['class' => 'form-control', 'data-stripe="exp-month"'], '%m') !!}
                            </div>
                            <div class="col-md-3">
                                {!! Form::label(null, 'Ex. Year') !!}
                                {!! Form::selectYear(null, date('Y'), date('Y') + 10, null, ['class' => 'form-control', 'data-stripe="exp-year"']) !!}
                            </div>
                        </div>

                        --}}
                        <div class="col-md-12">
                            <br><br>
                            <div class="form-group">
                                <button type="submit" class="btn btn-default waves-effect waves-light">
                                    CONFIRM ORDER
                                </button>
                            </div>
                        </div>




                    </form> <!-- close form -->

                </div>  <!-- close panel-body -->
            </div>  <!-- close panel-default -->
        </div>  <!-- close col-md-10 -->
    </div>  <!-- row -->
@endif

<br><br><br><br> <br><br><br><br>