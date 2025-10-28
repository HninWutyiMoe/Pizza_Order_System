@extends('user.layouts.master')
@section('content')
    <!-- Contact Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-6 offset-3 my-4">
                <div class="contact-form bg-light p-30">
                    {{-- Create Alert --}}
                    @if (session('sentSuccess'))
                        <div class="col-6 offset-6">
                            <div class="alert alert-success alert-dismissible fade show " role="alert">
                                <i class="fa-regular fa-circle-check"></i>{{ session('sentSuccess') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    <form action="{{ route('user#contacting') }}" method="POST" novalidate="novalidate">
                        @csrf
                        <div class="control-group mb-3">
                            <input type="text" name="userName"
                                class="form-control @error('userName') is-invalid @enderror py-4" placeholder="Your Name" />
                            @error('userName')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="control-group mb-4">
                            <input type="email" class="form-control @error('userEmail') is-invalid @enderror py-4"
                                name="userEmail" placeholder="Your Email" />
                            @error('userEmail')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="control-group mb-4">
                            <textarea class="form-control @error('userMessage') is-invalid @enderror" rows="6" name="userMessage"
                                placeholder="Message" required="required"></textarea>
                            @error('userMessage')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div>
                            <button class="btn btn-dark py-2 px-4 text-white" type="submit">Send Message
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            {{-- <div class="col-lg-5 mb-5">
                <div class="bg-light p-30 mb-30">
                    <iframe style="width: 100%; height: 250px;"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3001156.4288297426!2d-78.01371936852176!3d42.72876761954724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4ccc4bf0f123a5a9%3A0xddcfc6c1de189567!2sNew%20York%2C%20USA!5e0!3m2!1sen!2sbd!4v1603794290143!5m2!1sen!2sbd"
                        frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
                <div class="bg-light p-30 mb-4">
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, New York, USA</p>
                    <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@example.com</p>
                    <p class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
                </div>
            </div> --}}
        </div>
    </div>
    <!-- Contact End -->
@endsection
