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
            @if(session('welcome'))
              <div class="alert welcome alert-dismissible fade show" role="alert">
                <strong>{{session('welcome')}}</strong>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>
            @endif
       <div class="title">
        <nav style="width:853px; --bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb bg-white">
              <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            </ol>
          </nav>
       </div>

        <div class="grid">
          <div class="box users-grid">
            <div class="text-center">
              <span class="fa fa-users"></span>

              <div class="users-count mt-3">
                <h4 class="badge badge-pill badge-success">{{$users_count}}</h4>
              </div>
            </div>

            <div class="info p-2 text-center">
              <p>Contains information about users who have access to this platform.</p>
            </div>

            <div class="text-center">
            <a href="{{route('users.index')}}" class="btn btn-sm btn-primary">Show Users</a>
            </div>
          </div>

          <div class="box items-grid">
              <div class="text-center">
                <span class="fa fa-list"></span>
                <div class="items-count mt-3">
                  <h4 class="badge badge-pill badge-success">{{$items_count}}</h4>
                </div>
              </div>
              <div class="info p-2 text-center">
                <p>Contains information about items available in the system.</p>
              </div>
              <div class="text-center">
                <a href="{{route('items.index')}}" class="btn btn-sm btn-primary">Show Items</a>
                </div>
          </div>

          <div class="box stocks-grid">
            <div class="text-center">
              <span class="fa fa-check"></span>
              <div class="stocks-count mt-3">
                <h4 class="badge badge-pill badge-success">{{$stocks_count}}</h4>
              </div>
            </div>
            <div class="info p-2 text-center">
              <p>Contains information about stockings that have been made for every item.</p>
            </div>
            <div class="text-center">
              <a href="{{route('stocks.index')}}" class="btn btn-sm btn-primary">Show Stockings</a>
              </div>
        </div>

        <div class="box issues-grid">
          <div class="text-center">
            <span class="fa fa-minus"></span>
            <div class="issues-count mt-3">
              <h4 class="badge badge-pill badge-success">{{$issuings_count}}</h4>
            </div>
          </div>
          <div class="info p-2 text-center">
            <p>Contains information about issuings that have been made for every item.</p>
          </div>
          <div class="text-center">
            <a href="{{route('issuings.index')}}" class="btn btn-sm btn-primary">Show Issuings</a>
            </div>
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