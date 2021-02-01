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
              <li class="breadcrumb-item active" aria-current="page">Activity Logs</li>
            </ol>
          </nav>
          @can('delete', Auth::user())
            <label>
            <form method="POST" action="{{route('logs.clear_all')}}" id="clear_activity_logs_form">
                @csrf  
                <input type="hidden" name="clearing_agreement" id="clearing_agreement"/>
                <button type="submit" class="btn btn-sm btn-danger clear-logs">Clear Logs</button>
                </form>
           </label>
          @endcan
       </div>

       <div class="mt-3 p-2 inner">
        @if($logs->count() > 0)
        @foreach($logs as $log)
            <div class="panel bg-white mb-2 pl-3 pt-2 pb-1 pr-2">
                <div class="panel-body">
                    <div class="top">
                    <span class="h5">{{$log->model}} --- {{$log->activity}}</span> &nbsp; --- <span class="h6"> by {{$log->user->name}}</span>
                    <p>{{$log->description}}</p>
                    </div>
                </div>
            </div>

        @endforeach

        <div class="text-center mt-4">
            {!! $logs->links() !!}
        </div>

        @else
        <div class="alert alert-danger">
        <strong>Oops!</strong> It appears no activities have been made yet.
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

@push('scripts')
    <script>
        let form = document.getElementById('clear_activity_logs_form');
        form.addEventListener('submit', function(e){
            e.preventDefault();
            let clearing_agreement = document.getElementById('clearing_agreement');
            let agree = confirm('Are you sure you want to clear all the activity logs?');
            if(agree){
                clearing_agreement.value = true;
                this.submit()
            }
           

        })
    </script>
@endpush