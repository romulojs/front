<!Doctype html>
<html>
    <head>
        <title>Menu</title>

        <!-- CSS -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/fontawesome.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/geral.css') }}" rel="stylesheet">
        
        <!-- JS -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/fontawesome.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="{{ asset('js/geral.js') }}"></script>
    </head>

    <body>
        <div class="w-100 vh-100 d-flex align-items-center">
            <div class="container vh-100" style="max-height: 600px;">
                <div class="row position-relative h-100 align-items-center">
                    <!-- STATUS DO PERSONAGEM -->
                    <div class="col-12 col-sm-4 border rounded border-secondary py-3" style="height: 100%">
                        <div class="row">
                            <!-- STATUS VITAIS -->
                            <div class="col-4 user-photo overflow-hidden d-flex align-items-center justify-content-center pr-0">
                                <img id="JogadorImagem" class="img-fluid" src="">
                            </div>
    
                            <div class="col-8">
                                <p class="mb-0 status-description"><strong>Nome: </strong> <span id="NomePersonagem"></span></p>
                                <p class="mb-2 status-description small"><strong>Usuário: </strong> <span id="NomeUsuario"></span></p>
                                
                                <div class="bar bar-life bar-status border border-success w-100 mb-1 d-flex align-items-center justify-content-center">
                                    <p class="life-description mb-0">
                                        <span id="VidaAtual" class="life-current">0</span>
                                        /
                                        <span id="VidaTotal" class="life-total">100</span>
                                        <div class="bar bar-status-background bar-life-background"></div>
                                    </p>
                                </div>
    
                                <div class="bar bar-mana bar-status border border-primary w-100 d-flex align-items-center justify-content-center">
                                    <p class="life-description mb-0">
                                        <span id="ManaAtual" class="mana-current">0</span>
                                        /
                                        <span id="ManaTotal" class="mana-total">100</span>
                                        <div class="bar bar-status-background bar-mana-background"></div>
                                    </p>
                                </div>
                            </div><!-- FIM STATUS VITAIS -->
    
                            <!-- STATUS GERAIS -->
                            <div class="col-12 my-2">
                                <hr>
                            </div>
            
                            <!-- STATUS GERAIS -->
                            <div class="col-12">
                                <p class="mb-1">
                                    <b>STR:</b> <span id="Str"></span><br>
                                    <small>Define a força de ataque.</small>
                                </p>
                                <p class="mb-1">
                                    <b>DEF:</b> <span id="Def">0</span><br>
                                    <small>Define a resistência à ataques e magias.</small>
                                </p>
                                <p class="mb-1">
                                    <b>AGL:</b> <span id="Agl">0</span><br>
                                    <small>Define a chance de esquiva e velocidade.</small>
                                </p>
                                <p class="mb-1">
                                    <b>DEX:</b> <span id="Dex">0</span><br>
                                    <small>Define a quantidade de peso a ser carregado e itens.</small>
                                </p>
                                <p class="mb-1">
                                    <b>VIT:</b> <span id="Vit">0</span><br>
                                    <small>Define a vitalidade e resistência.</small>
                                </p>
                            </div><!-- FIM STATUS GERAIS -->
                        </div>
                    </div><!-- FIM STATUS -->
    
                    <!-- ITENS -->
                    <div class="col-12 col-sm-8 h-100">
                        <!-- ITENS CONSUMIVEIS -->
                        <div class="position-relative col-12 border rounded border-secondary pt-3 px-2" style="height: 49%">
                        <div class="titulo-div-item"><h3>consumiveis</h3></div>
                            <div class="col-12 h-100" style="overflow-y: auto">
                                <div id="ListaConsumivel" class="row"></div>
                            </div>
                        </div><!-- ITENS CONSUMIVEIS -->
    
                        <div style="margin: 2% 0 2% 0"></div>
    
                        <!-- CRIAÇÃO DE ITENS -->
                        <div class="position-relative col-12 border rounded border-secondary pt-3 px-2" style="height: 49%">
                            <div class="titulo-div-item"><h3>criacões</h3></div>
                            <div class="col-12 h-100" style="overflow-y: auto">
                                <div id="ListaCriacao" class="row"></div>
                            </div>
                        </div><!-- CRIAÇÃO DE ITENS-->
                    </div><!-- FIM ITENS -->
                </div>
            </div>    
        </div>

        <input type="hidden" id="apiToken" value="{{ Session::get('_apiToken') }}">
    </body>
</html>