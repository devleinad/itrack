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
              <li class="breadcrumb-item active" aria-current="page">Add Stocks</li>

            </ol>
          </nav>
       </div>

       <div class="mt-3">
        <div class="bg-white p-3 inner">
          <form method="POST" action="{{route('stocks.store')}}">
            @csrf
            <div class="form-group">
                <label class="label form-label font-weight-bold">
                    WHERE ITEMS CAME FROM
                </label>
                <input
                    type="text"
                    name="from"
                   class="form-control @error('from') is-invalid @enderror"
                   value="{{old('from') ?? 'Stores'}}"
                />
                @error('from')
              <span class="invalid-feedback text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="label form-label font-weight-bold">
                    WHICH ITEM ARE YOU STOCKING?
                </label>
                <select name="item_id" class="form-control @error('item_id') is-invalid @enderror">
                    <option value="">SELECT ITEM</option>
                    @foreach($items as $item)
                <option value={{$item->id}}>{{$item->item_name}}</option>
                    @endforeach
                </select>
                @error('item_id')
              <span class="invalid-feedback text-danger">{{$message}}</span>
                @enderror
            </div>

              <div class="form-group">
                  <label class="label form-label font-weight-bolder">
                      STOCK QUANTITY
                  </label>
                  <input
                      type="number"
                      name="quantity"
                     class="form-control @error('quantity') is-invalid @enderror"
                     value={{old('quantity')}}
                  />
                  @error('quantity')
                <span class="invalid-feedback text-danger">{{$message}}</span>
                  @enderror
              </div>

              <div class="form-group">
                <label class="label form-label font-weight-bolder">
                    ANY REPORT?
                </label>
                <textarea
                    name="report"
                   class="form-control @error('report') is-invalid @enderror"
                   value="{{old('report') ?? 'No report'}}"
                >
                </textarea>
                @error('report')
              <span class="invalid-feedback text-danger">{{$message}}</span>
                @enderror
            </div>

              <div class="form-group">
                  <button
                      type="submit"
                      class="btn btn-lg btn-success"
                  >
                      SAVE
                  </button>
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