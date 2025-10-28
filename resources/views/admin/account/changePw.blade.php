@extends('admin.layouts.main')
@section('title','Password Change')
@section('content')

<!-- Password Change-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="col-9 offset-2">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Change Password</h3>
                        </div>

                        @if (session('changeSuccess'))
                            <div class="col-12">
                                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                    <i class="fa-solid fa-cloud-arrow-down me-2"></i>{{session('changeSuccess')}}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                        @endif

                        @if (session('notMatch'))
                            <div class="col-12">
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="fa-solid fa-cloud-arrow-down me-2"></i>{{session('notMatch')}}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                        @endif

                        <hr>

                        <form action="{{route('admin#changingPw')}}" method="post" novalidate="novalidate">
                            @csrf
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Old Password</label>
                                <input id="cc-pament" name="oldPassword" type="password" value="" class="form-control

                                @error('oldPassword')
                                    is-invalid
                                @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Old Password...">
                                @error('oldPassword')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror

                            </div>

                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">New Password</label>
                                <input id="cc-pament" name="newPassword" type="password" value="" class="form-control
                                @error('newPassword')
                                    is-invalid
                                @enderror" aria-required="true" aria-invalid="false" placeholder="Enter New Password...">

                                @error('newPassword')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Confirm Password</label>
                                <input id="cc-pament" name="confirmPassword" type="password" value="" class="form-control

                                @error('confirmPassword')
                                    is-invalid
                                @enderror" aria-required="true" aria-invalid="false" placeholder="Confirm Password...">

                                @error('confirmPassword')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror

                            </div>

                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-dark btn-block my-3">
                                    <span id="payment-button-amount">Change Password</span>
                                    <i class="fa-solid fa-circle-right"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Password Change-->

@endsection
