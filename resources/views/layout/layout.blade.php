<!DOCTYPE html>
<html lang="en">
@include("head.head")
<body>
    <header class="w-100">
        <div class="navbar navbar-expand-lg navbar-dark bg-danger">
            <span class="navbar-brand">
                <i class="fa fa-tooth"></i>
                Laboratorio Pinto
            </span>
            <button  class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link" href="#">Inicio</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Administrar
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Usuarios</a>
                        </div>
                    </li>
                </ul>
            </div>
            <span class="navbar-brand">
                <i class="fa fa-user"></i>
                Bienvenido
            </span>
        </div>
    </header>
    <div class="container">
        @yield("content_page")
    </div>
    @include('footer.footer')
    <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/scriptReceipt.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/scriptProducts.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/scriptLaboratory.js')}}"></script>
    </body>
    </html>