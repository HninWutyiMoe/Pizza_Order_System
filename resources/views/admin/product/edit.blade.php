@extends('admin.layouts.main')
@section('title', 'Edit Product')
@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid ">
                <div class="col-lg-11 offset-1">
                    <div class="card">
                        <div class="card-body">

                            {{-- <div class="card-title">
                                <h3 class="text-center title-2">Update</h3>
                            </div> --}}
                            <div class="ms-5">
                                <a href="{{route('product#list')}}"><i class="fa-solid fa-arrow-left-long"></i></a>
                            </div>

                            <hr>

                            <form action=" {{route('update#product')}} " method="POST" enctype="multipart/form-data">
                                @csrf
                                @if($errors->any()) @foreach ($errors->all() as $error) <div>{{ $error }}</div> @endforeach @endif
                                <div class="row">

                                    <div class="col-5 offset-1">
                                             <input type="hidden" name="pizzaId" value="{{$pizza->id}}">
                                            <img src="{{ asset('storage/' . $pizza->image) }}" class="img-thumbnail shadow-sm" />

                                        <div class="form-group">
                                            <h5 class=" my-2 mx-3">Change Pizza Photo</h5>
                                            <input type="file" name="pizzaImage" class="form-control @error('pizzaImage') is-invalid @enderror">
                                            @error('pizzaImage')
                                            <div class="is-invalid">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        </div>

                                        <div class="mt-3">
                                            <button class="btn btn-danger col-12" type="submit">Update</button>
                                        </div>

                                    </div>

                                    <div class="row col-6">

                                        <div class="form-group">
                                            <label class="mb-1 control-label">Pizza Name</label>
                                            <input type="text" name="pizzaName"
                                                value="{{ old('pizzaName', $pizza->name) }}"
                                                class="form-control @error('pizzaName') is-invalid @enderror">
                                                @error('pizzaName')
                                                <div class="is-invalid">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                        <div class="form-group">
                                            <label class="mb-1 control-label">Description</label>
                                            <textarea type="text" name="pizzaDescription" class="form-control @error('pizzaDescription') is-invalid @enderror" cols="30" rows="10">{{ old('pizzaDescription', $pizza->description) }}
                                            </textarea>
                                            @error('pizzaDescription')
                                            <div class="is-invalid">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="" class="mb-1 control-label">Category</label>
                                            <select name="pizzaCategory" class="au-input au-input--full form-control"
                                                style="border-radius: 10px; height: 43px;">
                                                <option value="">Choose Category</option>
                                                @foreach ($category as $c)
                                                    <option value="{{$c->id}}" @if ($pizza->category_id == $c->id) selected @endif>{{$c->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="" class="mb-1 control-label">Price</label>
                                            <input type="number" name="pizzaPrice"
                                                value="{{ old('pizzaPrice', $pizza->price) }}"
                                                class="form-control @error('pizzaPrice') is-invalid @enderror">
                                                @error('pizzaPrice')
                                            <div class="is-invalid">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="" class="mb-1 control-label">Waiting-Times</label>
                                            <input type="text" name="waitingTime"
                                                value="{{ old('waitingTime', $pizza->waiting_time) }}" class="form-control"></input>
                                        </div>

                                        <div class="form-group">
                                            <label for="" class="mb-1 control-label">View-Count</label>
                                            <input type="number" name="viewCount" disabled  value="{{ old('viewCount', $pizza->view_count) }}" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label for="" class="mb-1 control-label">Created-date</label>
                                            <input type="text" name="createDate"
                                                value="{{ old('createDate', $pizza->created_at->format('j-F-Y')) }}" class="form-control"
                                                disabled></input>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->

@endsection
