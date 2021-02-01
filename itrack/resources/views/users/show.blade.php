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
              <li class="breadcrumb-item active" aria-current="page">View User Details</li>

            </ol>
          </nav>
       </div>

       <div class="mt-3">
        <div class="bg-white p-3 inner">
            <div class="mb-3">
                <h4 class="font-weight-bold">USER DETAILS</h4>
            </div>
        <h6>ID# : <b>{{$user->id}}</b></h6>
        <h6>FULL NAME : <b>{{$user->name}}</b></h6>
        <h6>EMAIL ADDRESS : <b>{{$user->email}}</b></h6>
        <h6>DESIGNATION : <b>{{$user->designation}}</b></h6>
        <h6>BLOCK STATUS : <b>{{$user->is_blocked ? 'Blocked' : 'Not Blocked'}}</b></h6>
        <h6>CREATED AT : <b>{{$user->created_at->format('M j, Y: h:i:sa')}}</b></h6>
        <h6>UPDATED AT : <b>{{$user->updated_at->format('M j, Y: h:i:sa')}}</b></h6>

        <hr>
        <div class="text-center">
          @can('update',$user)
            @if(!$user->isBlocked())
              <a href="{{route('users.edit',['user' => $user->id])}}" class="btn btn-sm btn-success">Edit</a>
            @else
              <button class="btn btn-sm btn-success" disabled>Edit</button>
            @endif
          @endcan
          &nbsp;
          @can('block', \App\Models\User::class)
            @if($user->id !== Auth::id())
            <label>
              <form method="POST" action="{{route('block_user',['user' => $user->id])}}">
              @csrf  
              @method('PATCH')
              <button class="btn btn-sm btn-warning">{{$user->isBlocked() ? 'Unblock user' : 'Block user'}}</button>
              </form>
            </label>   
            @endif
        @endcan
          &nbsp;
        @can('delete', \App\Models\User::class)
          <label>
          <form method="POST" action="{{route('users.destroy',['user' => $user->id])}}">
            @csrf  
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">Delete User</button>
            </form>
          </label>
        @endcan
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