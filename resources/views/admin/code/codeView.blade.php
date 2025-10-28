@extends('admin.layouts.main')
@section('title', 'Order List')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="table-responsive table-responsive-data2">
                    <div class="my-3 fs-5">
                        <a href="{{route('admin#orderList')}}">
                            <i class="fa-solid fa-arrow-left-long"></i>
                        </a>
                    </div>
                    <div class="col-5 row">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="text-center">
                                    <i class="fa-solid fa-clipboard me-2"></i>Order info
                                </h4>
                                <span class="text-warning">
                                    <i class="fa-solid fa-triangle-exclamation me-2 text-danger"></i>Include Delivery Charges
                                </span>
                            </div>
                            <div class="card-body">
                                <div class="row pb-2">
                                    <div class="col">
                                        <i class="fa-solid fa-user-large me-2"></i>Name
                                    </div>
                                    <div class="col">
                                        {{ strtoupper( $list[0]->user_name ) }}
                                    </div>
                                </div>
                                <div class="row pb-2">
                                    <div class="col">
                                        <i class="fa-solid fa-barcode me-2"></i>Order Code
                                    </div>
                                    <div class="col">
                                        {{ $list[0]->order_code }}
                                    </div>
                                </div>
                                <div class="row pb-2">
                                    <div class="col">
                                        <i class="fa-solid fa-calendar-check me-2"></i>Order Date
                                    </div>
                                    <div class="col">
                                        {{ $list[0]->created_at->format('M-j-Y') }}
                                    </div>
                                </div>
                                <div class="row pb-2">
                                    <div class="col">
                                        <i class="fa-solid fa-money-bill-1 me-2"></i>Total
                                    </div>
                                    <div class="col">
                                        {{ $order->total_price }} mmk
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>Order Id</th>
                                <th>Product Image</th>
                                <th>Product Name</th>
                                <th>Order Date</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list as $l)
                                <tr class="tr-shadow">

                                    <td>{{ $l->id }}</td>

                                    <td class="col-2"><img src="{{ asset('storage/' . $l->product_image) }}"
                                            class="img-thumbnail"></td>

                                    <td>{{ $l->product_name }}</td>

                                    <td>{{ $l->created_at->format('j-M-Y') }}</td>

                                    <td>{{ $l->qty }}</td>

                                    <td>{{ $l->total }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection



