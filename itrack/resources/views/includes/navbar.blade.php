<nav class="navbar navbar-expand-md navbar-static-top navbar-light bg-white
">
    <div class="container">
        <a class="navbar-brand font-weight-bold" href="{{ url('/') }}">
            {{ config('app.name', 'itrack') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" 
        aria-controls="navbarSupportedContent" 
        aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
             <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto ml-5">
                <li class="nav-item">
                    <a href="/" class="nav-link mt-1 text-dark">Dashboard</a>
                </li>
            </ul>

       
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                         data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    <img src="{{asset('/storage/images/user.jpg')}}" class="img rounded-circle" width="30px" /> {{Auth::user()->name}} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{route('logout')}}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                        <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
            </ul>
        </div>
    </div>
</nav>