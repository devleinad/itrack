<!Doctype html>
<head>
<title>{{$title ?? env('APP_NAME')}}</title>
<link rel="stylesheet" href="{{asset('/bundles/datatables/datatables.min.css')}}" />
<link rel="stylesheet" href="{{asset('/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}" />
<!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.23/datatables.min.css"/>-->
<link rel="stylesheet" href="{{asset('/font-awesome/css/font-awesome.css')}}" />
<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" />
<style>
   .list-group li{
     border-left: none;
     border-right: none;
     border-top: none;
   }

   .inner .table tr td{
     background: #fff;
   }

   .inner h6{
     margin-bottom: 20px;
   }

   .inner h6 b{
     margin-left: 20px;
   }

   .grid{
     display: grid;
     grid-template-columns: 25% 25% 25% 25%;
     grid-gap: 10px;

     margin-top: 50px;
   }

   .box{
     background-color: #fff;
     padding: 8px 3px;
   }
   .fa-users,.fa-list,.fa-check,.fa-minus{
     font-size: 35px;
   }

   .info p{
    font-size: 11px;
    color:#000;
   }

   #table{
     margin-bottom: 50px;
     border:none;
   }

   .panel{
     cursor: pointer;
   }
   .panel:hover{
     border-left: 3px solid green;
   }

   .welcome, .success{
     border-left: 3px solid green;
     background-color: #fff;
   }

   .error{
     border-left: 3px solid red;
     background-color: #fff;

   }

</style>
</head>
<body class="bg-light">
  <noscript>
    You need to enable javascript to be able to use certain functionalities!
  </noscript>
    @yield('navbar')
    <div class="container">
        <div class="mt-2">
            @if(session('success'))
              <div class="alert success alert-dismissible fade show" role="alert">
                <strong>{{session('success')}}</strong>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>
            @endif

       @if(session('error'))
       <div class="alert error alert-dismissible fade show" role="alert">
        <strong>{{session('error')}}</strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      @endif
        </div>
        @yield('main-content')

        @yield('footer')

    </div>
   
  
</body>
<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('bundles/datatables/datatables.min.js')}}"></script>
<script src="{{asset('bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('bundles/datatables/export-tables/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('bundles/datatables/export-tables/buttons.flash.min.js')}}"></script>
<script src="{{asset('bundles/datatables/export-tables/jszip.min.js')}}"></script>
<script src="{{asset('bundles/datatables/export-tables/pdfmake.min.js')}}"></script>
<script src="{{asset('bundles/datatables/export-tables/vfs_fonts.js')}}"></script>
<script src="{{asset('bundles/datatables/export-tables/buttons.print.min.js')}}"></script>
<script src="{{asset('js/page/datatables.js')}}"></script>

<script>
  $("#table").DataTable();
</script>

@stack('scripts')


<!--<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.23/datatables.min.js"></script>-->
</html>