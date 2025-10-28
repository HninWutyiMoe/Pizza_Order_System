@extends('admin.layouts.main')
@section('title', 'Pizza Details')
@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">

        <div class="section__content section__content--p30">
            <div class="container-fluid ">
                <div class="col-lg-11 offset-1">
                    <div class="card shadow-lg">
                        <div class="card-body">

                            <div class="ms-5">
                                <i class="fa-solid fa-arrow-left-long" onclick="history.back()"></i>
                            </div>

                            <div class="card-title">
                                <h3 class="text-center title-2">Pizza Details</h3>
                            </div>

                            <hr>

                            <div class="row ">
                                <div class="col-4 offset-1">
                                    <img src="{{ asset('storage/' . $pizza->image) }}" class="shadow-sm img-thumbnail" />
                                </div>

                                <div class="col-7">
                                    <span class="my-3 d-block w-50 text-center fs-5 btn bg-danger text-white"> <i class="fa-solid fa-pizza-slice me-2"></i>{{ $pizza->name }} </span>
                                    <span class="my-3 btn bg-dark text-white"> <i class="fa-solid fa-money-bill-1-wave me-2"></i>{{ $pizza->price }}</span>
                                    <span class="my-3 btn bg-dark text-white"> <i class="fa-solid fa-stopwatch me-2"></i>{{ $pizza->waiting_time }}</span>
                                    <span class="my-3 btn bg-dark text-white"> <i class="fa-solid fa-eye me-2"></i>{{ $pizza->view_count }}</span>
                                    <span class="my-3 btn bg-dark text-white"> <i class="fa-solid fa-layer-group me-2"></i>{{ $pizza->category_name }}</span>
                                    <span class="my-3 btn bg-dark text-white"> <i class="fa-solid fa-calendar-days me-2"></i>{{ $pizza->created_at}}</span>

                                    <div class="my-3 fs-5">  <i class="fa-solid fa-file-lines me-2"></i>Details</div>
                                    <div class="">{{ $pizza->description }}</div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->

@endsection
