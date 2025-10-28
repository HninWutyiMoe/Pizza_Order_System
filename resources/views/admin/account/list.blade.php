@extends('admin.layouts.main')
@section('title', 'Admin List')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Admin List</h2>

                            </div>
                        </div>
                    </div>
                    {{-- Create Alert --}}
                    @if (session('createSuccess'))
                        <div class="col-6 offset-6">
                            <div class="alert alert-success alert-dismissible fade show " role="alert">
                                <i class="fa-regular fa-circle-check"></i>{{ session('createSuccess') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    {{-- Delete Alert --}}
                    @if (session('deleteSuccess'))
                        <div class="col-6 offset-6">
                            <div class="alert alert-danger alert-dismissible fade show " role="alert">
                                <i class="fa-regular fa-circle-check"></i>{{ session('deleteSuccess') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    {{-- Password Change Success alert --}}
                    @if (session('changeSuccess'))
                        <div class="col-12">
                            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-cloud-arrow-down me-2"></i>{{ session('changeSuccess') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    {{-- search --}}
                    <div class="row py-3">
                        <div class="col-4">
                            <h6> Search Key : <span class="text-danger"> {{ request('key') }}</span> </h6>
                        </div>
                        <div class="col-4 offset-4">
                            <form action="{{ route('admin#list') }}" method="GET">
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
                            <h5><i class="fa-solid fa-database"></i> {{ $admin->total() }}</h5>
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
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($admin as $a)
                                    <tr class="tr-shadow">
                                        <input type="hidden" id="adminId" value="{{ $a->id }}">
                                        <td>
                                            @if ($a->image == null)
                                                @if ($a->gender == 'male')
                                                    <img src="{{ asset('image/male.jpg') }}" class="shadow-sm img-thumbnail"
                                                        style="width: 70px; height:70px;">
                                                @else
                                                    <img src="{{ asset('image/female.png') }}"
                                                        class="shadow-sm img-thumbnail" style="width: 70px; height:70px;">
                                                @endif
                                            @else
                                                <img src="{{ asset('storage/' . $a->image) }}"
                                                    class="shadow-sm img-thumbnail" style="width: 70px; height:70px;">
                                            @endif
                                        </td>

                                        <td>{{ $a->name }}</td>

                                        <td>{{ $a->email }}</td>

                                        <td>{{ $a->gender }}</td>

                                        <td>{{ $a->phone }}</td>

                                        <td>{{ $a->address }}</td>

                                        <td>
                                            @if (Auth::user()->id == $a->id)

                                            @else
                                            <div class="d-flex">
                                                <select class="statusChange form-control">
                                                    <option value="user"
                                                        @if ($a->role == 'user') selected @endif>User</option>
                                                    <option value="admin"
                                                        @if ($a->role == 'admin') selected @endif>Admin</option>
                                                </select>

                                                <div class="table-data-feature ms-3">
                                                    <a href="{{ route('admin#view', $a->id) }}">
                                                        <button class="item me-2" data-toggle="tooltip" data-placement="top"
                                                            title="view_detail"><i class="fa-solid fa-eye fs-6"></i>
                                                        </button>
                                                    </a>
                                                    {{-- <a href=" {{ route('admin#delete', $a->id) }} ">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Delete">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </a> --}}
                                                </div>
                                            </div>
                                            @endif
                                            {{-- <div class="table-data-feature">

                                                @if (Auth::user()->id == $a->id)

                                                @else
                                                    <a href="{{route('admin#changeRole',$a->id)}}">
                                                        <button class="item me-2" data-toggle="tooltip" data-placement="top"
                                                            title="Edit"><i class="fa-solid fa-user-minus"></i>
                                                        </button>
                                                    </a>
                                                    <a href=" {{ route('admin#delete', $a->id) }} ">

                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Delete">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </a>
                                                @endif
                                            </div> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{ $admin->links() }}
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
                $adminId = $parentNode.find('#adminId').val();
                // console.log($adminId);

                $data = {
                    'role': $currentStatus,
                    'adminId': $adminId
                };

                $.ajax({

                    type: 'get',

                    url: '/admin/admin/change/role',

                    data: $data,

                    dataType: 'json',
                })
                window.location.href = "/admin/list";
            })
        })
    </script>
@endsection
