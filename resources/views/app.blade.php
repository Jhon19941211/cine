<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Cine</title>

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">  
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">  
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">  
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">  
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">   
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">   
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">   
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  {{-- CARUSEL --}}
  <link rel="stylesheet" type="text/css" href="slick/slick.css"/>
  <link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>

  {{-- DATATABLES --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">

  {{-- TOAST ALERTAS --}}
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <style>
    .slick-prev:before, .slick-next:before { 
        color:black;
        font-size: 25px;
    }
</style>
</head>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <header class="main-header">      
      <a class="logo bg-light">        
        <span class="logo-mini text-dark"><b>C</b>INE</span>        
        <span class="logo-lg text-dark" ><b>CINE</b>NARV</span>
      </a>      
      
      <nav class="navbar navbar-static-top bg-primary">        
        {{-- <a class="sidebar-toggle img-circle bg-primary" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a> --}}
        <a href=""></a>
        
        <div class="btn-group pull-right">
          <div class="btn-group dropleft" role="group">
            <button type="button" class="btn btn-light  dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">                
            </button>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="{{ route('logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
            Cerrar sesión</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
            <a class="dropdown-item" href="#">Configuración</a>
          </div>
        </div>
        <button type="button" class="btn btn-light ">
          <strong>{{ Auth::user()->name }}</strong>
        </button>
      </div>
    </nav>
  </header>  

  <aside class="main-sidebar bg-light">    
    <section class="sidebar">      
      <div class="user-panel">
        <div class="pull-left image">
          <img src="img/user.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info text-dark">
          <p>{{ Auth::user()->name }}</p>
          <a href="#" class="text-dark"><i class="fa fa-circle text-success"></i> Online</a>
        </div>            
      </div>            

      <ul class="sidebar-menu bg-light">
        <strong><li class="header bg-light text-dark">MENÚ CINE</li></strong>

        <li><a style="color: black; text-decoration: none;" href="{{ route('cartelera.index') }}"><i class="fas fa-video">&nbsp;&nbsp;</i>Cartelera</a></li>
        <li><a style="color: black; text-decoration: none;" href="#"><i class="fas fa-film">&nbsp;&nbsp;</i> Tus reservas</a></li>
        <li><a style="color: black; text-decoration: none;" href="{{ route('user.index') }}"><i class="fas fa-users-cog">&nbsp;&nbsp;</i> Perfil</a></li>  
        <li><a style="color: black; text-decoration: none;" href="{{ route('proyeccion.index') }}"><i class="fas fa-users-cog">&nbsp;&nbsp;</i> Administración</a></li>          
      </ul>
    </section>    
  </aside>
  
  <div class="content-wrapper">    
    <section class="content">
      @yield('content')
    </section>    
  </div>  
  <footer class="main-footer">
    <strong>Copyright &copy; 2019 <strong>CALVO STUDIOS.</strong></strong>
  </footer>
  <div class="control-sidebar-bg"></div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="dist/js/demo.js"></script>

{{-- CARUSEL --}}
<script type="text/javascript" src="slick/slick.min.js"></script>

{{-- DATATABLES --}}
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

{{-- TOAST ALERTAS --}}
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- SCRIPT CARTELERA -->
<script src="js/logica_cartelera.js"></script>
<script src="js/logica_pelicula.js"></script>
<script src="js/logica_proyeccion.js"></script>

</body>
</html>