@extends('admin.layouts.main')
@section('title', 'Admin Profile')
@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">

        <div class="row px-5">
            @if (session('updateSuccess'))
                <div class="col-6 offset-6">
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-cloud-arrow-down me-2"></i>{{ session('updateSuccess') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
        </div>

        <div class="section__content section__content--p30">
            <div class="container-fluid ">

                <div class="col-10 offset-1">
                    <div class="card shadow-lg">

                        <div class="card-header bg-info py-2 shadow-sm">
                            <h3 class="text-center title-2">Account Info</h3>
                        </div>

                        <div class="card-body bg-info-subtle ">

                            <div class="col">

                                <div class="col-4 offset-4 py-3">
                                    @if (Auth::user()->image == null)
                                        @if (Auth::user()->gender == 'male')
                                            <img src="{{ asset('image/male.jpg') }}" class="shadow-sm img-thumbnail"
                                                style="width:150px; height:150px; border-radius: 50%">
                                        @else
                                            <img src="{{ asset('image/female.png') }}"
                                                class="shadow-sm img-thumbnail"
                                                style="width:150px; height:150px; border-radius: 50%">
                                        @endif
                                    @else
                                        <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                            class="shadow-sm img-thumbnail"
                                            style="width:150px; height:150px; border-radius: 50%">
                                    @endif
                                </div>

                                <div class="col-8 offset-3">
                                    <h5 class="my-2"> <i class="fa-solid fa-user-pen me-2"></i>{{ Auth::user()->name }}
                                    </h5>
                                    <h5 class="my-3"> <i class="fa-solid fa-at me-2"></i>{{ Auth::user()->email }}</h5>
                                    <h5 class="my-3"> <i class="fa-solid fa-phone me-2"></i>{{ Auth::user()->phone }}</h5>
                                    <h5 class="my-3"> <i
                                            class="fa-solid fa-mars-and-venus me-2"></i>{{ Auth::user()->gender }}</h5>
                                    <h5 class="my-3"> <i
                                            class="fa-solid fa-location-dot me-2"></i>{{ Auth::user()->address }}</h5>
                                    <h5 class="my-3"> <i
                                            class="fa-solid fa-calendar-days me-2"></i>{{ Auth::user()->created_at->format('j-F-Y') }}
                                    </h5>
                                </div>
                            </div>
                            <div class="card-footer">

                                <a href="{{ route('admin#editProfile') }}" class=" col-12">
                                    <button class="btn btn-primary shadow-sm" style="width: 100%;">
                                        <i class="fa-regular fa-pen-to-square me-2"></i>Edit Profile
                                    </button>
                                </a>

                            </div>

                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->

@endsection
