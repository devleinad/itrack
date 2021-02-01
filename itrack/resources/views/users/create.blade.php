@extends("layouts.base")
@section('navbar')
    @include('includes.navbar')
@endsection('navbar')

@section('main-content')
    <div class="row justify-content-center mt-3">
        <div class="col-lg-3 col-md-3 col-sm-3">
            @include('includes.left_sidenav')
        </div>

        <div class="col-lg-9 col-md-9 col-sm-9">
            <div class="title">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb bg-white">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('users.index')}}">users</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add User</li>
                    </ol>
                </nav>
            </div>

            <div class="mt-3">
                <div class="bg-white p-3 inner">
                    <form method="POST" action="{{route('users.store')}}">
                        @csrf
                        <div class="form-group">
                            <label class="label form-label font-weight-bold">FULL NAME</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                   value="{{old('name')}}"/>
                            @error('name')
                            <span class="invalid-feedback text-danger">{{$message}}</span>
                            @enderror

                        </div>

                        <div class="form-group">
                            <label class="label form-label font-weight-bold">EMAIL ADDRESS</b></label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                   value="{{old('email')}}"/>
                            @error('email')
                            <span class="invalid-feedback text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="label form-label font-weight-bolder">DESIGNATION</label>
                            <input type="text" name="designation" class="form-control @error('designation') is-invalid @enderror"
                                   value="{{old('designation')}}"/>
                            @error('designation')
                            <span class="invalid-feedback text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">PASSWORD</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" />
                            @error('password')
                            <span class="invalid-feedback text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                        <label class="font-weight-bold">PASSWORD</label>
                        <input type="password" name="password_confirmation" class="form-control" />
                        </div>
                <div class="form-group">
                    <button type="submit"  class="btn btn-lg btn-success mt-2">CREATE</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('footer')
<div class="mt-3">
@include('includes.footer') 
</div>
@endsection
