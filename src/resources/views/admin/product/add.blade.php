@extends('admin.dash')

@section('content')

    <div class="container" id="admin-product-container">

            <br><br>
        <a href="#menu-toggle" class="btn btn-default" id="menu-toggle"><i class="fa fa-bars fa-5x"></i></a>
        <a href="{{ url('admin/products') }}" class="btn btn-danger">Back</a>
            <br><br>

        <h4 class="text-center">Add new Product</h4><br><br>

        <div class="col-md-12">

            {{--<form role="form" method="POST" action="{{ route('admin.product.post') }}">--}}
            {{Form::open(['route' => 'admin.product.post','files' => true])}}
                {{csrf_field()}}

                <div class="col-sm-6 col-md-6" id="Product-Input-Field">
                    <div class="form-group{{ $errors->has('product_name') ? ' has-error' : '' }}">
                        <label>Product Name</label>
                        <input type="text" class="form-control" name="product_name" value="{{ old('product_name') }}" placeholder="Add New Product">
                        @if($errors->has('product_name'))
                            <span class="help-block">{{ $errors->first('product_name') }}</span>
                        @endif
                    </div>
                </div>

                <div class="col-sm-6 col-md-6" id="Product-Input-Field">
                    <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                        <label>Category</label>
                        <select class="form-control" name="category" id="category" data-url="{{ url('api/dropdown')}}">
                            <!--<option value=""></option>-->
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('category'))
                            <span class="help-block">{{ $errors->first('category') }}</span>
                        @endif
                    </div>
                </div>

                <div class="col-md-12" id="category-dropdown-container">

                    <div class="col-sm-6 col-md-6" id="Product-Input-Field">
                        <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                            <label>Price</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="material-icons"><i class="glyphicon glyphicon-yen"></i></i> </div>
                                <input type="text" class="form-control" name="price" value="{{ old('price') }}" placeholder="Product Price">
                            </div>
                            @if($errors->has('price'))
                                <span class="help-block">{{ $errors->first('price') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6" id="Product-Input-Field">
                        <div class="form-group{{ $errors->has('reduced_price') ? ' has-error' : '' }}">
                            <label>Reduced Price (optional)</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="material-icons"><i class="glyphicon glyphicon-yen"></i></i></div>
                                <input type="text" class="form-control" name="reduced_price" value="{{ old('reduced_price') }}" placeholder="Product Reduced Price">
                            </div>
                            @if($errors->has('reduced_price'))
                                <span class="help-block">{{ $errors->first('reduced_price') }}</span>
                            @endif
                        </div>
                    </div>

                </div>



                <div class="col-sm-3 col-md-3" id="Product-Input-Field">
                    <div class="form-group">
                        <label>Featured Product</label><br>
                        <input type="checkbox" name="featured" value="1">
                    </div>
                </div>

                <div class="col-sm-3 col-md-3" id="Product-Input-Field">
                    <div class="form-group{{ $errors->has('product_qty') ? ' has-error' : '' }}">
                        <label>Product Quantity</label>
                        <input type="number" class="form-control" name="product_qty" value="{{ old('product_qty') }}" placeholder="Add Product Quantity" min="0">
                        @if($errors->has('product_qty'))
                            <span class="help-block">{{ $errors->first('product_qty') }}</span>
                        @endif
                    </div>
                </div>


                <div class="col-sm-6 col-md-6" id="Product-Input-Field">
                    <div class="form-group{{ $errors->has('product_sku') ? ' has-error' : '' }}">
                        <label>Product SKU</label>
                        <input type="text" class="form-control" name="product_sku"  id="product_sku" value="{{ old('product_sku') }}" placeholder="Generate Product SKU" >
                        <button class="btn btn-info btn-sm waves-effect waves-light" onclick="GetRandom()" type="button" id="product_sku">generate</button>
                        @if($errors->has('product_sku'))
                            <span class="help-block">{{ $errors->first('product_sku') }}</span>
                        @endif
                    </div>
                </div>

               {{-- <div class="form-group {!! $errors->has('photo') ? 'has-error' : '' !!}">
                    {!! Form::label('photo', 'Product photo (jpeg, png)') !!}
                    {{ Form::file('photo') }}
                    {!! $errors->first('photo', '<p class="help-block">:message</p>') !!}

                    @if (isset($model) && $model->photo !== '')
                        <div class="row">
                            <div class="col-md-6">
                                <p>Current photo:</p>
                                <div class="thumbnail">
                                    <img src="{{ url('/img/products/' . $model->photo) }}" class="img-rounded">
                                </div>
                            </div>
                        </div>
                    @endif
                </div> --}}

                <!-- Nav tabs -->
                <!--<ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">DESCRIPTION</a></li>
                    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">SPECS</a></li>
                </ul>-->

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="col-md-12" id="category-dropdown-container">
                        <div class="form-group {!! $errors->has('description') ? 'has-error' : '' !!}">
                            {!! Form::label('description', 'Description') !!}
                            {!! Form::textarea('description', null, ['class'=>'form-control']) !!}
                            {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                </div>



                <div class="form-group col-md-12">
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Create Product</button>
                </div>

           <!-- </form> -->
            {{Form::close()}}
        </div> <!-- Close col-md-12 -->

    </div>  <!-- Close container -->
@endsection

@section('footer')
        <!-- Include Froala Editor JS files. -->
    <script type="text/javascript" src="{{ asset('src/public/js/libs/froala_editor.min.js') }}"></script>

    <!-- Include Plugins. -->
    <script type="text/javascript" src="{{ asset('src/public/js/plugins/align.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('src/public/js/plugins/char_counter.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('src/public/js/plugins/font_family.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('src/public/js/plugins/font_size.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('src/public/js/plugins/line_breaker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('src/public/js/plugins/lists.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('src/public/js/plugins/paragraph_format.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('src/public/js/plugins/paragraph_style.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('src/public//js/plugins/quote.min.js') }}"></script>


   <!-- <script>
        $(function() {
            $('#product-description').froalaEditor({
                charCounterMax: 1000,
                height: 500,
                codeBeautifier: true,
                placeholderText: 'Insert Product description...',
            })
        });
    </script>-->



@endsection
