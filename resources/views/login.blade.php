<!Doctype html>
<html>
    <head>
        <title>Seja Bem-vindo</title>

        <!-- CSS -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/geral.css') }}" rel="stylesheet">

        <!-- JS -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    </head>

    <body>
        <div class="container-fluid vh-100">
            <div class="row justify-content-center align-items-center vh-100">
                <div id="login-panel" class="col-12">
                    <img class="img-fluid mb-4" src="{{ asset('image/icon/logo.png') }}">

                    <form method="post" action="{{ route('CarregarUsuario') }}">
                        @csrf
                        @if($errorLogin)
                            <div class="col-12 px-0">
                                <div class="alert alert-danger" role="alert">
                                Login ou Senha inválidos!
                                </div>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="login">Login</label>
                            <input type="text" class="form-control" id="login" name="login" placeholder="warrior">
                        </div>

                        <div class="form-group">
                            <label for="password">Senha</label>
                            <input type="password" class="form-control" id="senha" name="senha" placeholder="***********">
                        </div>

                        <div class="form-group justify-content-center">
                            <button type="submit" class="btn btn-success font-weight-bold">acessar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>