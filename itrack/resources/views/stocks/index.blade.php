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
              <li class="breadcrumb-item active" aria-current="page">Stockings</li>
            </ol>
          </nav>
         
       </div>

       <div class="mt-3 p-2 inner">
        @can('create', \App\Models\Stock::class)
        <a href="{{route('stocks.create')}}" class="btn btn-success mb-4 ml-3 btn-md">Add Stocks</a>
        @endcan
        @if($stocks->count() > 0)
        <table class="table" id="table">
          <thead>
              <tr>
                  <th>FROM</th>
                  <th>STOCKED BY</th>
                  <th>ITEM NAME</th>
                  <th class="text-center">QUANTITY</th>
                  <th class="text-center">ACTION</th>
              </tr>
          </thead>
          <tbody>
              @foreach($stocks as $stock)
              <tr>
                <td class="text-center">{{ $stock->from }}</td>
                <td class="text-center">{{ $stock->stocker->name }}</td>
                <td>{{$stock->item->item_name}}</td>
                <td class="text-center font-weight-bold">{{ $stock->quantity }}</td>
                <td class="text-center">
                  @can('view', $stock)
                  <a href="{{route('stocks.show',['stock' => $stock->id])}}" class="btn btn-sm btn-primary">View</a>
                 @else
                 <button class="btn btn-sm btn-primary btn-primary" disabled>View</button>
                  @endcan
                  &nbsp;

                  @can('update',$stock)
                  <a href="{{route('stocks.edit',['stock' => $stock->id])}}" class="btn btn-sm btn-success">Edit</a>
                  @else
                  <button class="btn btn-sm btn-success" disabled>Edit</button>
                  @endcan
                  &nbsp;

                  @can('delete', $stock)
                  <label>
                  <form method="POST" action="{{route('stocks.destroy',['stock' => $stock->id])}}">
                    @csrf  
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                  </label>
                  @endcan
              </td>
              </tr>
              @endforeach
          </tbody>
      </table>

        @else
        <div class="alert alert-danger">
        <strong>Oops!</strong> It appears no stockings have been made yet. <a href="{{route('stocks.create')}}">create</a>
        </div>
        @endif
       </div>
    </div>
</div>
@endsection

@section('footer')
<div class="mt-3">
@include('includes.footer') 
</div>
@endsection
