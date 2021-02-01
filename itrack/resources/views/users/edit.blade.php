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
              <li class="breadcrumb-item"><a href="{{route('users.index')}}">Users</a></li>
              <li class="breadcrumb-item active" aria-current="page">Edit User Details</li>
            </ol>
          </nav>
       </div>

       <div class="mt-3">
        <div class="bg-white p-3 inner">
          <form method="POST" action="{{route('users.update',['user' => $user->id])}}">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label class="label form-label font-weight-bold">FULL NAME</label>
                @if(Auth::user()->isSuperAdmin() || Auth::user()->isOwner($user->id))
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{$user->name ?? old('name')}}"/>
                @error('name')
                    <span class="invalid-feedback text-danger">{{$message}}</span>
                @enderror
                @else 
                    <input type="text" name="name" class="form-control" value="{{$user->name}}" readonly />
                @endif  
            </div>

            <div class="form-group">
                <label class="label form-label font-weight-bold">EMAIL ADDRESS</b></label>
                @if(Auth::user()->isOwner($user->id))
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{$user->email ?? old('email')}}"/>
                    @error('email')
                        <span class="invalid-feedback text-danger">{{$message}}</span>
                    @enderror
                @else
                    <input type="email" name="email" class="form-control" value="{{$user->email}}"readonly />
                 @endif
            </div>

              <div class="form-group">
                  <label class="label form-label font-weight-bolder">DESIGNATION</label>
                  @can('updateAny', Auth::user())
                    <input type="text" name="designation" class="form-control @error('designation') is-invalid @enderror" 
                    value="{{$user->designation ?? old('designation')}}"/>
                  @error('designation')
                        <span class="invalid-feedback text-danger">{{$message}}</span>
                  @enderror
                  @else
                    <input type="text" name="designation" class="form-control" value="{{$user->designation}}" readonly />
                  @endcan
              </div>
                      
                    @if(Auth::user()->isOwner($user->id))
                    <div class="form-group">
                        <label class="font-weight-bold">PASSWORD</label> 
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" />
                        @error('password')
                            <span class="invalid-feedback text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    @endif
               

              <div class="form-group">
                  <button type="submit"  class="btn btn-lg btn-success mt-2">UPDATE</button>
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
