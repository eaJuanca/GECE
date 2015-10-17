
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 alert-material-teal">
        <a href="{{ URL::route('home')}}" style="text-decoration: none; margin-top:3px" ><span class="gc_header" style="font-size: 23px"><i class="fa fa-home"></i>
            Gestión Cementerio</span></a>

        <a href="{{URL::route('auth/logout')}}"> <button  class="btn btn-danger btn-xs pull-right"> <i class="fa fa-user-times"></i>
                Desconectar </button></a>



    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 well-material-amber gc_h_serparator"> @yield('title')</div>
</div>