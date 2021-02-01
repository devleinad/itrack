@extends("layouts.base")
@section('navbar')
@include('includes.navbar')
@endsection('navbar')

@section('main-content')
<div class="row justify-content-center mt-3">
    <div class="col-lg-3 col-md-3 col-sm-3">
        @include('includes.left_sidenav')
    </div>

    <div class="col-lg-9 col-md-9 col-sm-9 pb-5">
        <div class="title">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb bg-white">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                </ol>
            </nav>
        </div>

        <div class="mt-3 bg-white p-2 inner">
            @can('view',\App\Models\ActivityLog::class)
            <h4 class="mb-4 ml-3">Activity Logs</h4>
            @if($activity_logs->count() > 0)
            <table class="table table-hover" id="table">
                <thead>
                    <tr>
                        <th>ACTIVITY</th>
                        <th>USER</th>
                        <th>MODEL</th>
                        <th>DESCRIPTION</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($activity_logs as $activity_log)
                    <tr>
                        <td>{{ $activity_log->activity }}</td>
                        <td>{{ $activity_log->user->name }}</td>
                        <td>{{ $activity_log->model }}</td>
                        <td>{{ $activity_log->description }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="alert alert-danger">
                <strong>Oops!</strong> It appears no activity_logs have been made yet. <a href="{{route('users.create')}}">create</a>
            </div>
            @endif
            @endcan
        </div>
    </div>
</div>
@endsection