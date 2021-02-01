@extends('layouts.base')
@section('main-content')

<div class="row justify-content-center">
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-4 pt-2 pb-3 pl-3 pr-3" style="margin-top: 90px;">
        <div>
            @if(session('logged_out'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{session('logged_out')}}</strong>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>
            @endif
        </div>
        <div class="card border-0 bg-white p-3">
                <h4>Login</h4>

                <form class="form mt-3" action="/login" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-label font-weight-bold">Email Address</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                        placeholder="Your email address" />
                        @error('email')
                            <span class="invalid-feedback text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label font-weight-bold">Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                        placeholder="Your password" />
                        @error('password')
                            <span class="invalid-feedback text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-success float-right">Login</button>
                    </div>
                </form>
        </div>
    </div>
</div>

@endsection('main-content')