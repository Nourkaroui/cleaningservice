@extends('admin.dash')

@section('content')

    <div class="container-fluid" id="admin-product-container">

        <br><br>
        <a href="#menu-toggle" class="btn btn-default" id="menu-toggle"><i class="fa fa-bars fa-5x"></i></a>
        <!--<a href="" class="btn btn-primary">Add new Product</a>-->
        <br><br>

        {{-- <h6>There are {{ $userCount }} products</h6><br>--}}


        <table class="table table-bordered table-condensed table-hover">
            <thead>
            <tr>


                <th class="text-center blue white-text">Product Name</th>
                <th class="text-center blue white-text">sku_number</th>
                <th class="text-center blue white-text">price</th>


            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>

                    <form action="{{route('admin.user.price.post')}}" method="post" class="form-inline">
                        {{ csrf_field() }}
                        <input type="hidden" name="id_user" value="{{$user->id}}">
                        <input type="hidden" name="id_product" value="{{ $product->id }}">

                        <td class="text-center">{{ $product->product_name }}</td>
                        <td class="text-center">{{ $product->product_sku }}</td>
                        @if($product->user->count() == 0)
                            <td class="text-center">
                                <div class="col-sm-2 text-center">
                                    <div class="">User price : {{ 0 }}</div>
                                </div>
                                <div class="col-sm-6 text-center">
                                    <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                                        <input type="number" class="form-control" name="price" value="0">
                                        <div class="">Default price : {{ $product->price }}</div>
                                        @if($errors->has('price'))
                                            <span class="help-block">{{ $errors->first('price') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-2 text-center">
                                    <button class="btn btn-sm btn-default"><i class="fa fa-refresh"
                                                                              aria-hidden="true"></i></button>
                                </div>
                            </td>
                        @else
                            <td class="text-center">
                                <div class="col-sm-2 col-md-2">
                                    <div class="">User price
                                        : {{ $product->user()->find($user->id)->pivot->price }}</div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                                        <input type="number" class="form-control" name="price"
                                               value="{{ $product->user()->find($user->id)->pivot->price }}">
                                        <div class="">Default price : {{ $product->price }}</div>
                                        @if($errors->has('price'))
                                            <span class="help-block">{{ $errors->first('price') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-2 col-md-2">
                                    <button class="btn btn-sm btn-default"><i class="fa fa-refresh"
                                                                              aria-hidden="true"></i></button>
                                </div>
                            </td>
                        @endif

                    </form>

                </tr>
            @endforeach
            </tbody>
        </table>


    </div>

@endsection