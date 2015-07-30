<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>


        <link href="//fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link href="{{ URL::asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('assets/css/material.min.css') }}" rel="stylesheet">

    </head>
    <body>

        <div class="container">
            <h1 class="header">Navbar</h1>

            <div class="navbar navbar-default">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="javascript:void(0)">Brand</a>
                </div>
                <div class="navbar-collapse collapse navbar-responsive-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="javascript:void(0)">Active</a></li>
                        <li><a href="javascript:void(0)">Link</a></li>
                        <li class="dropdown">
                            <a href="http://fezvrasta.github.io/bootstrap-material-design/bootstrap-elements.html" data-target="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="javascript:void(0)">Action</a></li>
                                <li><a href="javascript:void(0)">Another action</a></li>
                                <li><a href="javascript:void(0)">Something else here</a></li>
                                <li class="divider"></li>
                                <li class="dropdown-header">Dropdown header</li>
                                <li><a href="javascript:void(0)">Separated link</a></li>
                                <li><a href="javascript:void(0)">One more separated link</a></li>
                            </ul>
                        </li>
                    </ul>
                    <form class="navbar-form navbar-left">
                        <input type="text" class="form-control col-lg-8" placeholder="Search">
                    </form>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="javascript:void(0)">Link</a></li>
                        <li class="dropdown">
                            <a href="http://fezvrasta.github.io/bootstrap-material-design/bootstrap-elements.html" data-target="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="javascript:void(0)">Action</a></li>
                                <li><a href="javascript:void(0)">Another action</a></li>
                                <li><a href="javascript:void(0)">Something else here</a></li>
                                <li class="divider"></li>
                                <li><a href="javascript:void(0)">Separated link</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <h1 class="header">Checkbox</h1>
            <h2>Keep Wi-Fi on during sleep</h2>
            <div class="sample1">
                <div class="radio radio-success">
                    <label>
                        <input type="radio" name="sample1" value="option1" checked="">
                        Always
                    </label>
                </div>
                <div class="radio radio-success">
                    <label>
                        <input type="radio" name="sample1" value="option1">
                        Only when plugged in
                    </label>
                </div>
                <div class="radio radio-success">
                    <label>
                        <input type="radio" name="sample1" value="option1">
                        Never
                    </label>
                </div>
            </div>


            <h2>Wi-Fi frequency band</h2>
            <div class="sample2">
                <div class="radio radio-primary">
                    <label>
                        <input type="radio" name="sample2" value="option1" checked="">
                        Auto
                    </label>
                </div>
                <div class="radio radio-primary">
                    <label>
                        <input type="radio" name="sample2" value="option1">
                        5 GHz only
                    </label>
                </div>
                <div class="radio radio-primary">
                    <label>
                        <input type="radio" name="sample2" value="option1">
                        2.4 GHz only
                    </label>
                </div>
            </div>

        </div>
    </body>
    <script src="{{ URL::asset('assets/js/jquery-2.1.4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/material.js') }}"></script>
    <script src="{{ URL::asset('assets/js/material.js') }}"></script>
    <script src="{{ URL::asset('assets/js/ripples.js') }}"></script>


    <script type="text/javascript">
        $.material.init();
    </script>


</html>
