<?php
    session_start();
    if (!isset($_SESSION["usuario"])){
        header("Location:index.php");       
        }
    include("conexao.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Equipamentos - TI</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-menu">
        <div class="container-fluid">
            <a class="navbar-brand text-logo" href="#">Equipamentos - T.I</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Equipamentos
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <li><a class="dropdown-item" href="tela-inicial.php">Equipamentos disponíveis</a></li>
                      <li><a class="dropdown-item" href="cadastro.php">Cadastrar Equipamentos</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Empréstimos
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <li><a class="dropdown-item" href="gerencia-emprestimos.php">Gerenciar empréstimos</a></li>
                      <li><a class="dropdown-item disabled" href="">Histórico de Empréstimos</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link " href="configuracoes-gerais.php" >
                        Configurações gerais
                    </a>
                    </li>
                <li class="nav-item dropdown">
                    <a class="nav-link " href="#"  data-bs-toggle="modal" data-bs-target="#modalSobre">
                        Sobre
                      </a>
                </li>
            </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="container">

            <!--Título e barra de pesquisa-->
            <div class="row border-bottom mt-5" id="historico-top-content">

                <div class="col-lg-6" id="historico-title">
                    <h1>Histórico de empréstimos</h1>
                </div>

                <div class="col-lg-6" id="historico-search-form">
                    <form class="form-inline">

                        <select name="historico-search-type" id="historico-search-type">
                            <option value="tipo-equipamento">Tipo do equipamento</option>
                            <option value="patrimonio">Patrimônio</option>
                            <option value="requerente">Requerente</option>
                            <option value="data-emprestimo">Data de empréstimo</option>
                            <option value="data-devolucao">Data de devolução</option>
                        </select>

                        <input class="form-control ml-auto" type="search" placeholder="Digite aqui..."
                            aria-label="Search">
                        <input type="submit" value="Pesquisar" class="btn btn-danger">
                    </form>
                </div>
            </div>

            <div id="historico-content">

                <!--Item do histórico-->
                <div class="row border-bottom historico-items">
                    <!--Imagem-->
                    <div class="col-md-2 historico-img">
                        <img src="./img/fone-de-ouvido.jpg" alt="">
                    </div>

                    <!--Conteúdo-->
                    <div class="col-md-10">

                        <div class="row">
                            <div class="col-md-6 historico-type">
                                <h5>Fone de ouvido</h5>
                            </div>
                            <div class="col-md-6 historico-emprestimo-date">
                                <h5>Data de empréstimo: 26/03/2021 10:05</h5>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">Patrimônio: 123456</div>
                            <div class="col-md-4">Nome do requerente: Huguinho</div>
                            <div class="col-md-4">Data de devolução: 26/03/2020 11:32</div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">Tipo do requerente: Aluno</div>
                            <div class="col-md-4">RA: 6920100456</div>
                        </div>
                    </div>

                </div>

                <!--Item do histórico-->
                <div class="row border-bottom historico-items">
                    <!--Imagem-->
                    <div class="col-md-2 historico-img">
                        <img src="./img/notebook.jpg" alt="">
                    </div>

                    <!--Conteúdo-->
                    <div class="col-md-10">

                        <div class="row">
                            <div class="col-md-6 historico-type">
                                <h5>Notebook</h5>
                            </div>
                            <div class="col-md-6 historico-emprestimo-date">
                                <h5>Data de empréstimo: 26/03/2021 09:25</h5>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">Patrimônio: 753159</div>
                            <div class="col-md-4">Nome do requerente: Zézinho</div>
                            <div class="col-md-4">Data de devolução: 26/03/2020 10:40</div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">Tipo do requerente: Funcionário</div>
                            <div class="col-md-4">RA: 6920100123</div>
                        </div>
                    </div>

                </div>

                <!--Item do histórico-->
                <div class="row border-bottom historico-items">
                    <!--Imagem-->
                    <div class="col-md-2 historico-img">
                        <img src="./img/fone-de-ouvido.jpg" alt="">
                    </div>

                    <!--Conteúdo-->
                    <div class="col-md-10">

                        <div class="row">
                            <div class="col-md-6 historico-type">
                                <h5>Fone de ouvido</h5>
                            </div>
                            <div class="col-md-6 historico-emprestimo-date">
                                <h5>Data de empréstimo: 25/03/2021 16:26</h5>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">Patrimônio: 789456</div>
                            <div class="col-md-4">Nome do requerente: Luisinho</div>
                            <div class="col-md-4">Data de devolução: 26/03/2020 18:54</div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">Tipo do requerente: Aluno</div>
                            <div class="col-md-4">RA: 6920100789</div>
                        </div>
                    </div>

                </div>

                <!--Item do histórico-->
                <div class="row border-bottom historico-items">
                    <!--Imagem-->
                    <div class="col-md-2 historico-img">
                        <img src="./img/tablet.jpg" alt="">
                    </div>

                    <!--Conteúdo-->
                    <div class="col-md-10">

                        <div class="row">
                            <div class="col-md-6 historico-type">
                                <h5>Tablet</h5>
                            </div>
                            <div class="col-md-6 historico-emprestimo-date">
                                <h5>Data de empréstimo: 25/03/2020 14:02</h5>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">Patrimônio: 123456</div>
                            <div class="col-md-4">Nome do requerente: Marketing</div>
                            <div class="col-md-4">Data de devolução: 26/03/2020 15:48</div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">Tipo do requerente: Setor</div>
                            <div class="col-md-4">RA: -</div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalSobre" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sobre o Sistema</h5>
                    <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal"
                        aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">Esse é um sistema de controle e gerenciamento de estoque de
                                equipamentos
                                tecnológicos disponibilizados para empréstimo dentro de uma instituição de ensino
                                superior.</div>
                            <div class="col-md-6 ms-auto">Esse sistema surgiu por conta de uma demanda real que nossa
                                instituição de
                                ensino possuía, em um cenário aonde não havia um gerenciamento efetivo dos equipamentos
                                emprestados a
                                alunos e funcionários. </div>
                        </div>

                    </div>
                </div>
                <!--Aqui termina o modal-->


</body>
<!-- <script src="js/bootstrap.bundle.min.js"></script> -->
<!-- <script src="js/bootstrap.js"></script> -->
<script src="./js/bootstrap.bundle.min.js"></script>

</html>