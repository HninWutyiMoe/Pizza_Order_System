@extends('admin.layouts.main')
@section('title', 'Order List')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                        <div class="d-flex" style="justify-content: space-between" >

                            <div class=" input-group-append">
                                <span class="fw-bold input-group-text">
                                    <i class="fa-solid fa-database text-secondary me-2"></i>
                                    {{ count($order) }}
                                </span>
                            </div>

                            <form action="{{ route('admin#searchStatus') }}" method="get">
                                @csrf
                                <span class="input-group mb-3">
                                    <select name="orderStatus" class="custom-select text-danger fw-bold" id="inputGroup">
                                        <option value="">All</option>
                                        <option value="0" @if (request('orderStatus') == '0') selected @endif>Pending</option>
                                        <option value="1" @if (request('orderStatus') == '1') selected @endif>Accept</option>
                                        <option value="2" @if (request('orderStatus') == '2') selected @endif>Reject</option>
                                    </select>
                                    <div class="input-group-append">
                                        <button class="btn btn-sm bg-secondary text-white fw-bold input-group-text" type="submit">
                                            Search
                                        </button>
                                    </div>
                                </span>
                            </form>
                        </div>

                        </div>

                    @if (count($order) != 0)

                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th>User Name</th>
                                        <th>Order Code</th>
                                        <th>Total_Price</th>
                                        <th>Contact</th>
                                        <th>Order Status</th>
                                        <th>Order Date</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($order as $o)
                                        <tr class="tr-shadow">
                                        <input type="hidden" class="orderId" value="{{$o->id}}">

                                            <td>{{ $o->user_name }}</td>

                                            <td>
                                                <a href="{{ route('admin#codeView', $o->order_code) }}"
                                                    class="fw-bold text-decoration-none">
                                                    {{ $o->order_code }}
                                                </a>
                                            </td>

                                            <td>{{ $o->total_price }}</td>

                                            <td>{{ $o->contact_mail}}</td>

                                            <td>
                                                <select name="status" class="form-control statusChange">
                                                    <option value="0"
                                                        @if ($o->status == 0) selected @endif>Pending</option>
                                                    <option value="1"
                                                        @if ($o->status == 1) selected @endif>Accept</option>
                                                    <option value="2"
                                                        @if ($o->status == 2) selected @endif>Reject</option>
                                                </select>
                                            </td>

                                            <td>{{ $o->created_at->format('j-M-Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- <div class="mt-3">
                                {{ $order->links() }}
                                 $order->appends(request()->query())->links()
                            </div> --}}
                        </div>
                    @else
                        <h2 class="text-secondary text-center mt-4">There is no o here</h2>
                    @endif
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
@section('scriptSource')
<script>
     $(document).ready(function() {
            $('.statusChange').change(function() {
                $currentStatus = $(this).val();
                $parentNode = $(this).parents("tr");
                $orderId = $parentNode.find('.orderId').val();
                // console.log($orderId);

                $data = {
                    'status': $currentStatus,
                    'orderId': $orderId
                };

                $.ajax({

                    type: 'get',

                    url: '/order/ajax/changeStatus',

                    data: $data,

                    dataType: 'json',
                })
                window.location.href = "/order/orderList";
            })
        })
</script>
@endsection
