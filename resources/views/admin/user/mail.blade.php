@extends('admin.layouts.main')
@section('title', 'User_Mail')
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
                            <form action="{{ route('admin#receiveMail') }}" method="GET">
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
                            <h5 class="text-secondary"><i class="fa-solid fa-database"></i> {{ $mail->total() }}</h5>
                        </div>
                    </div>

                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Message</th>
                                    <th>Posted_Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mail as $m)
                                <tr class="tr-shadow">
                                    <td>{{ $m->id }}</td>

                                    <td>{{ $m->name }}</td>

                                    <td>{{ $m->email }}</td>

                                    <td>{{ $m->message }}</td>

                                    <td>{{ $m->created_at->format('j-M-Y') }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection

