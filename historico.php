<?php
session_start();
if (!isset($_SESSION["usuario"])) {
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
                            <div class="dropdown-divider"></div>
                            <li><a class="dropdown-item" href="gerencia-reservas">Gerenciar reservas</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Empréstimos
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="gerencia-emprestimos.php">Gerenciar empréstimos</a></li>
                            <li><a class="dropdown-item disabled" href="">Histórico de Empréstimos</a></li>
                            <div class="dropdown-divider"></div>
                            <li><a class="dropdown-item" href="gerencia-reservas.php">Gerenciar reservas</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link " href="configuracoes-gerais.php">
                            Configurações gerais
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link " href="#" data-bs-toggle="modal" data-bs-target="#modalSobre">
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

                        <input class="form-control ml-auto" type="search" placeholder="Digite aqui..." aria-label="Search">
                        <input type="submit" value="Pesquisar" class="btn btn-danger">
                    </form>
                </div>
            </div>

            <div id="historico-content">

                <?php
                $sqlEmprestimo = "  SELECT ee.id as idAssoc, e.id as idEmp, tipoE.tipo as tipoE, tipoE.imagem, e.data_emprestimo, e.data_devolucao, eq.identificador, r.nome, r.ra, tipoR.tipo
                                    FROM equipamento_emprestimo AS ee
                                    INNER JOIN tb_emprestimo as e
                                    ON ee.emprestimo_id = e.id
                                    INNER JOIN tb_requerente AS r
                                    ON e.tb_requerente_id = r.id
                                    INNER JOIN tb_tipo_requerente AS tipoR
                                    ON r.tb_tipo_requerente_id = tipoR.id
                                    INNER JOIN tb_equipamento AS eq
                                    ON ee.tb_equipamento_identificador = eq.identificador
                                    INNER JOIN tb_tipoequipamento AS tipoE
                                    ON eq.tb_tipoEquipamento_id = tipoE.id
                                    WHERE e.ativo = 0
                                    ORDER BY e.data_devolucao DESC
                ";
                $resEmprestimo = mysqli_query($con, $sqlEmprestimo);

                while ($emprestimo = mysqli_fetch_array($resEmprestimo)) {
                    //Formata a data
                    $dataEmprestimo = date_create($emprestimo['data_emprestimo']);
                    $dataDevolucao = date_create($emprestimo['data_devolucao']);
                    $dataEmprestimoFormatada = date_format($dataEmprestimo, 'd/m/Y H:i');
                    $dataDevolucaoFormatada = date_format($dataDevolucao, 'd/m/Y H:i');

                    echo "
                            <div class='row border-bottom historico-items'>
                            <input type='text' name='idEmprestimo' value='" . $emprestimo['idEmp'] . "' style='display:none'>
                                <div class='col-md-2 historico-img'>
                                    <img src='./img/" . $emprestimo['imagem'] . "' alt=''>
                                </div>
            
                                <div class='col-md-10'>
                                    <div class='row'>
                                        <div class='col-md-6 historico-type'>
                                            <h5>" . $emprestimo['tipoE'] . "</h5>
                                        </div>
                                        <div class='col-md-6 historico-emprestimo-date'>
                                            <h5>Data de empréstimo: " . $dataEmprestimoFormatada . "</h5>
                                        </div>
                                    </div>
            
                                    <div class='row'>
                                        <div class='col-md-4'>Identificador: " . $emprestimo['identificador'] . "</div>
                                        <div class='col-md-4'>Nome do requerente: " . $emprestimo['nome'] . "</div>
                                        <div class='col-md-4'>Data de devolução: " . $dataDevolucaoFormatada . "</div>
                                    </div>
            
                                    <div class='row'>
                                        <div class='col-md-4'>Tipo do requerente: " . $emprestimo['tipo'] . "</div>
                                        <div class='col-md-4'>RA: " . $emprestimo['ra'] . "</div>
                                    </div>
                                </div>
                            </div>
                        ";
                }
                ?>

            </div>

        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalSobre" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sobre o Sistema</h5>
                    <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal" aria-label="Close">X</button>
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
            </div>
        </div>
    </div>
    <!--Aqui termina o modal-->

    <!-- Modal -->
    <div class="modal fade" id="modalInfoEquip" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sobre o Sistema</h5>
                    <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Aqui termina o modal-->


</body>
<!-- <script src="js/bootstrap.bundle.min.js"></script> -->
<!-- <script src="js/bootstrap.js"></script> -->
<script src="./js/bootstrap.bundle.min.js"></script>
<script src="js/jquery.min.js"></script>
<script>
   $('.historico-items').on('click', function (event) {
    var idEmp = $(this).children('input[name="idEmprestimo"]').val();

    var modal = $('#modalInfoEquip')
    console.log(idEmp)
    modal.find('.row').text(idEmp)
    modal.modal('show')
})
</script>

</html>