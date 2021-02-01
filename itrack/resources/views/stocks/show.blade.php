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
              <li class="breadcrumb-item"><a href="{{route('stocks.index')}}">Stocks</a></li>
              <li class="breadcrumb-item active" aria-current="page">View Stock Details</li>

            </ol>
          </nav>
       </div>

       <div class="mt-3">
        <div class="bg-white p-3 inner">
            <div class="mb-3">
                <h4 class="font-weight-bold">STOCK DETAILS</h4>
            </div>
            <h6>ID# : <b>{{$stock->id}}</b></h6>
            <h6>FROM : <b>{{$stock->from}}</b></h6>
            <h6>STOCKED BY : <b>{{$stock->stocker->name}}</b> <small>({{$stock->stocker->designation}})</small></h6>
            <h6>ITEM STOCKED : <b>{{$stock->item->item_name}}</b></h6>
            <h6>QUANTITY STOCKED : <b>{{$stock->quantity}}</b></h6>
            <h6>STOCK REPORT  : <b>@if($stock->report === NULL) No report @else {{$stock->report}} @endif</b></h6>
            <h6>CREATED AT : <b>{{$stock->created_at->format('M j, Y: h:i:sa')}}</b></h6>
            <h6>UPDATED AT : <b>{{$stock->updated_at->format('M j, Y: h:i:sa')}}</b></h6>
            <hr>
            <div class="text-center">
                @can('update',$stock)
                <a href="{{route('stocks.edit',['stock' => $stock->id])}}" class="btn btn-sm btn-success">Edit</a>
                @endcan

                &nbsp;

                @can('delete',$stock)
                <label>
                    <form method="POST" action="{{route('stocks.destroy',['stock' => $stock->id])}}">
                    @csrf  
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Delete</button>
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