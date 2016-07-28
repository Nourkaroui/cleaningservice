@extends('admin.dash')

@section('content')

<div class="container" id="admin-category-container">

        <br><br>
    <a href="#menu-toggle" class="btn btn-default" id="menu-toggle"><i class="fa fa-bars fa-5x"></i></a>
    <a href="{{ url('admin/categories') }}" class="btn btn-danger">Back</a>
        <br><br>

    <div class="col-sm-8 col-md-9" id="admin-category-container">

            <form role="form" method="POST" action="{{ route('admin.category.post') }}">
                {{ csrf_field() }}

                    <h4 class="blue-text text-center">
                       Add Category
                    </h4>


                    <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                        <input type="text" class="form-control" name="category" value="{{ old('category') }}" placeholder="Add New Category">
                        @if($errors->has('category'))
                            <span class="help-block">{{ $errors->first('category') }}</span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                        <input type="textarea" class="form-control" name="description" value="{{ old('description') }}" placeholder="Description .. ">
                        @if($errors->has('description'))
                            <span class="help-block">{{ $errors->first('description') }}</span>
                        @endif
                    </div>


                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-link grey lighten-5">Create Category</button>
                    </div>

            </form>

    </div>

</div>

@endsection