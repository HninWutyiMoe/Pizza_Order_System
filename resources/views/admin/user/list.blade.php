@extends('admin.layouts.main')
@section('title', 'User_List')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    {{-- search --}}
                    <div class="row py-3">
                        <div class="col-4">
                            <h6> Search Key : <span class="text-secondary"> {{ request('key') }}</span>
                            </h6>
                        </div>
                        <div class="col-4 offset-4">
                            <form action="{{ route('admin#userList') }}" method="GET">
                                @csrf
                                <div class="d-flex">
                                    <input type="text" class="form-control" name="key" placeholder="Search..."
                                        value="{{ request('key') }}"></input>
                                    <button class="btn bg-dark text-white" type="submit">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    {{-- total --}}
                    <div class="row pb-3">
                        <div class="col-3">
                            <h5><i class="fa-solid fa-database"></i> {{ $users->total() }}</h5>
                        </div>
                    </div>

                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Role</th>
                                    {{-- <th></th> --}}
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($users as $u)
                                    <tr class="tr-shadow">

                                        <input type="hidden" id="userId" value="{{ $u->id }}">

                                        <td>
                                            @if ($u->image == null)
                                                @if ($u->gender == 'male')
                                                    <img src="{{ asset('image/male.jpg') }}" class="shadow-sm img-thumbnail"
                                                        style="width: 80px; height:80px;">
                                                @else
                                                    <img src="{{ asset('image/female.png') }}"
                                                        class="shadow-sm img-thumbnail" style="width: 80px; height:80px;">
                                                @endif
                                            @else
                                                <img src="{{ asset('storage/' . $u->image) }}"
                                                    class="shadow-sm img-thumbnail" style="width: 80px; height:80px;">
                                            @endif
                                        </td>

                                        <td>{{ $u->name }}</td>

                                        <td>{{ $u->email }}</td>

                                        <td>{{ $u->gender }}</td>

                                        <td>{{ $u->phone }}</td>

                                        <td>{{ $u->address }}</td>

                                        <td>
                                            <div class="d-flex">
                                                <select class="statusChange form-control">
                                                    <option value="user"
                                                        @if ($u->role == 'user') selected @endif>
                                                        User</option>
                                                    <option value="admin"
                                                        @if ($u->role == 'admin') selected @endif>
                                                        Admin</option>
                                                </select>

                                                <div class="table-data-feature ms-2 mt-1">

                                                    <a href="{{ route('user#view', $u->id) }}">
                                                        <button class="item me-2" data-toggle="tooltip" data-placement="top"
                                                            title="view_detail"><i class="fa-solid fa-eye fs-6"></i>
                                                        </button>
                                                    </a>

                                                    <a href=" {{ route('user#delete', $u->id) }} ">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Delete">
                                                            <i class="fa-solid fa-trash fs-6"></i>
                                                        </button>
                                                    </a>
                                                </div>

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{ $users->links() }}
                        </div>
                    </div>
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
                $userId = $parentNode.find('#userId').val();
                // console.log($userId);

                $data = {
                    'role': $currentStatus,
                    'userId': $userId
                };

                $.ajax({

                    type: 'get',

                    url: '/user/change/role',

                    data: $data,

                    dataType: 'json',
                })
                window.location.href = "/user/userList";
            })
        })
    </script>
@endsection
