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
              <li class="breadcrumb-item active" aria-current="page">Items</li>
            </ol>
          </nav>
       </div>

       <div class="mt-3 p-2 inner">
        @can('create', \App\Models\Item::class)
        <a href="{{route('items.create')}}" class="btn btn-success btn-md mb-4 ml-3">Add Item</a>
        @endcan

        @if($items->count() > 0)
        <table class="table table-hover" id="table">
          <thead>
              <tr>
                  <th>ITEM</th>
                  <th class="text-center">QUANTITY</th>
                  <th class="text-center">ACTION</th>
              </tr>
          </thead>
          <tbody>
              @foreach($items as $item)
              <tr>
                <td>{{$item->item_name}}</td>
              <td class="text-center"><b>{{ $item->getTotalQuantity() }}</b> {{$item->unit}}</td>
                <td class="text-center"> 
                  @can('view', $item)               
                  <a href="{{route('items.show',['item' => $item->id])}}" class="btn btn-sm btn-primary">View</a>
                  @else
                  <button type="button" class="btn btn-sm btn-primary" disabled>View</button>
                  @endcan
                  &nbsp;

                  @can('update',$item)
                  <a href="{{route('items.edit',['item' => $item->id])}}" class="btn btn-sm btn-success">Edit</a>
                  @else
                  <button type="button" class="btn btn-sm btn-success" disabled>Edit</button>
                  @endcan
                  &nbsp;

                  @can('delete', $item)
                  <label>
                  <form method="POST" action="{{route('items.destroy',['item' => $item->id])}}">
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
        <strong>Oops!</strong> It appears no items have been created yet. <a href="{{route('items.create')}}">create</a>
        </div>
        @endif
       </div>
    </div>
</div>
@endsection

@section('footer')
<div class="mt-3 pb-3">
@include('includes.footer') 
</div>
@endsection
