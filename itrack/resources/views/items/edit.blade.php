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
              <li class="breadcrumb-item"><a href="/items">Items</a></li>
              <li class="breadcrumb-item active" aria-current="page">Edit Item</li>

            </ol>
          </nav>
       </div>

       <div class="mt-3">
        <div class="bg-white p-3 inner">
        <form method="POST" action="{{route('items.update',['item' => $item->id])}}">
            @csrf
            @method('PATCH')
              <div class="form-group">
                  <label class="label form-label font-weight-bold">
                      WHAT WOULD YOU LIKE TO CALL THE NEW ITEM?
                  </label>
                  <input
                      type="text"
                      name="item_name"
                     class="form-control @error('item_name') is-invalid @enderror"
                     value="{{$item->item_name}}"
                  />
                  @error('item_name')
                <span class="invalid-feedback text-danger">{{$message}}</span>
                  @enderror
              </div>

              <div class="form-group">
                <label class="label form-label font-weight-bold">
                UNIT <b>current: {{$item->unit}}</b>
                </label>
                <select
                    name="unit"
                   class="form-control @error('unit') is-invalid @enderror"
                >
                <option value="">SELECT UNIT</option>
                <option value="box(es)">BOX(ES)</option>
                <option value="carton(s)">CARTON(S)</option>
                <option value="piece(s)">PIECE(S)</option>
                <option value="rim(s)">RIM(S)</option>
                </select>
                </select>
                @error('unit')
              <span class="invalid-feedback text-danger">{{$message}}</span>
                @enderror
            </div>

              <div class="form-group">
                  <button
                      type="submit"
                      class="btn btn-lg btn-success"
                  >
                      UPDATE
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