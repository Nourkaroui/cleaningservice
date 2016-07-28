@extends('admin.dash')

@section('content')

    <div class="container-fluid" id="admin-product-container">

        <br><br>
        <a href="#menu-toggle" class="btn btn-default" id="menu-toggle"><i class="fa fa-bars fa-5x"></i></a>
        <!--<a href="" class="btn btn-primary">Add new Product</a>-->
        <br><br>

        @if ($orders->count() == 0)
            No orders
        @else
            @foreach($orders as $order)
                <div class="accordion-group">
                    <div class="accordion-heading" id="accordion-group">
                        <a class="accordion-toggle" data-toggle="collapse" href="#order{{$order->id}}">Order
                            #{{$order->id}} - {{prettyDate($order->created_at)}} -
                            for// {{$order->user->first_name.' '.$order->user->last_name}}
                        </a>
                    </div>
                    <div id="order{{$order->id}}" class="accordion-body collapse">
                        <div class="accordion-inner">
                            <table class="table table-striped table-condensed">
                                <thead>
                                <tr>
                                    <th>
                                        Product
                                    </th>
                                    <th>
                                        Quantity
                                    </th>
                                    <th>
                                        Product Price
                                    </th>
                                    <th>
                                        Total
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($order->orderItems as $orderitem)
                                    <tr>
                                        <td>
                                            <a href="{{ route('show.product', $orderitem->product_name) }}">{{$orderitem->product_name}}</a>
                                        </td>
                                        <td>{{$orderitem->pivot->qty}}</td>
                                        <td>
                                            @if($orderitem->pivot->reduced_price == 0)
                                                ${{ $orderitem->pivot->price }}
                                            @else
                                                ${{ $orderitem->pivot->reduced_price }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($orderitem->pivot->total_reduced == 0)
                                                ${{$orderitem->pivot->total}}
                                            @else
                                                ${{$orderitem->pivot->total_reduced}}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td><b>Customer Info</b></td>
                                    <td>{{ $order->user->first_name }} {{ $order->user->last_name }}</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><b>Shipping Address</b></td>
                                    <td>{{$order->user->address}}<br> {{$order->user->city}}, {{$order->user->zip}}</td>
                                    <td><b>Total</b></td>
                                    <td><b>${{$order->total}}</b></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        @if($order->validation)

                                            <a href="{{ route('admin.order.validate', $order->id) }}" class="btn btn-primary disabled" disabled="true">Validated</a>
                                        @else
                                            <a href="{{ route('admin.order.validate', $order->id) }}" class="btn btn-primary">Validate</a>
                                        @endif
                                        @if($order->cancel)
                                                <a href="{{ route('admin.order.cancel', $order) }}" class="btn btn-danger disabled">Cancel</a>
                                        @else
                                                <a href="{{ route('admin.order.cancel', $order) }}" class="btn btn-danger">Cancel</a>
                                        @endif
                                    </td>

                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
