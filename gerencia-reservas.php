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
    <link rel="stylesheet" type="text/css" href="fontawesome/css/all.css">
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
                            <li><a class="dropdown-item" href="historico.php">Histórico de Empréstimos</a></li>
                            <div class="dropdown-divider"></div>
                            <li><a class="dropdown-item disabled" href="gerencia-reservas.php">Gerenciar reservas</a></li>
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
            <div class="row border-bottom mt-5" id="gerencia-emprestimos-top-content">

                <div class="col-lg-6" id="gerencia-emprestimos-title">
                    <h1>Gerência de reservas</h1>
                </div>

                <div class="col-lg-6" id="gerencia-emprestimos-search-form">
                    <form class="form-inline">

                        <select name="gerencia-emprestimos-search-type" id="gerencia-emprestimos-search-type">
                            <option value="tipo-equipamento">Tipo do equipamento</option>
                            <option value="patrimonio">Patrimônio</option>
                            <option value="requerente">Requerente</option>
                        </select>

                        <input class="form-control ml-auto" type="search" placeholder="Digite aqui..." aria-label="Search">
                        <input type="submit" value="Pesquisar" class="btn btn-danger">
                    </form>
                </div>
            </div>

            <div id="gerencia-emprestimos-content">

                <?php
                $sqlReserva = "  SELECT er.id as idAssoc, r.id as idRes, tipoE.tipo as tipoE, tipoE.imagem, r.data_reserva, eq.identificador, req.nome, req.ra, tipoR.tipo
                                    FROM equipamento_reserva AS er
                                    INNER JOIN reserva as r
                                    ON er.reserva_id = r.id
                                    INNER JOIN tb_requerente AS req
                                    ON r.tb_requerente_id = req.id
                                    INNER JOIN tb_tipo_requerente AS tipoR
                                    ON req.tb_tipo_requerente_id = tipoR.id
                                    INNER JOIN tb_equipamento AS eq
                                    ON er.tb_equipamento_identificador = eq.identificador
                                    INNER JOIN tb_tipoequipamento AS tipoE
                                    ON eq.tb_tipoEquipamento_id = tipoE.id
                                    WHERE er.ativo = 1
                ";
                $resReserva = mysqli_query($con, $sqlReserva);

                while ($reserva = mysqli_fetch_array($resReserva)) {
                    //Formata a data
                    $data = date_create($reserva['data_reserva']);
                    $dataReservaFormatada = date_format($data, 'd/m/Y H:i');

                    echo "
                            
                            <div class='row border-bottom gerencia-emprestimos-items'>
                                
                                <div class='col-md-2 gerencia-emprestimos-img'>
                                    <img src='./img/" . $reserva['imagem'] . "' alt=''>
                                </div>
            
                                
                                <div class='col-md-8'>
            
                                    <div class='row'>
                                        <div class='col-md-6 gerencia-emprestimos-type'>
                                            <h5>" . $reserva['tipoE'] . "</h5>
                                        </div>
                                        <div class='col-md-6 gerencia-emprestimos-emprestimo-date'>
                                            <h5>Data de reserva: " . $dataReservaFormatada . "</h5>
                                        </div>
                                    </div>
            
                                    <div class='row'>
                                        <div class='col-md-4'>Identificador: " . $reserva['identificador'] . "</div>
                                        <div class='col-md-4'>Nome do requerente: " . $reserva['nome'] . "</div>
                                    </div>
            
                                    <div class='row'>
                                        <div class='col-md-4'>Tipo do requerente: " . $reserva['tipo'] . "</div>
                                        <div class='col-md-4'>RA: " . $reserva['ra'] . "</div>
                                    </div>
                                </div>

                                <!--Botões-->
                                <div class='col-md-2'>
                                    <div class='row' style='height: 50%;'>
                                        <form method='POST' class='emprestar' style='width:100%'>
                                            <input type='text' name='idAssociacao' value='" . $reserva['idAssoc'] . "' style='display:none'>
                                            <input type='text' name='idReserva' value='" . $reserva['idRes'] . "' style='display:none'>
                                            <button type='submit' class='btn btn-labeled btn-success btn-emprestimo btn-finalizarEmprestimo'>
                                                <span class='btn-label'><i class='fa fa-check'></i></span> Emprestar
                                            </button>
                                        </form>
                                    </div>
                                    <div class='row' style='height: 50%;'>
                                        <form method='POST' class='cancelarReserva' style='width:100%'>
                                            <input type='text' name='idAssociacao' value='" . $reserva['idAssoc'] . "' style='display:none'>
                                            <input type='text' name='idReserva' value='" . $reserva['idRes'] . "' style='display:none'>
                                                <button type='submit' class='btn btn-labeled btn-danger btn-emprestimo btn-cancelarEmprestimo'>
                                                    <span class='btn-label'><i class='fa fa-times'></i></span> Cancelar
                                                </button>
                                        </form>
                                    </div>
                                </div>
            
                            </div>
                        ";
                }
                ?>

            </div>

        </div>

    </div>

    <!-- Modal sobre-->
    <div class="modal fade" id="modalSobre" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sobre o Sistema</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                    </button>
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

    <!--Aqui termina o modal sobre-->


</body>
<!-- <script src="js/bootstrap.bundle.min.js"></script> -->
<!-- <script src="js/bootstrap.js"></script> -->
<script src="./js/bootstrap.bundle.min.js"></script>
<script src="js/jquery.min.js"></script>
<!--Sweet Alert-->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    $(".emprestar").submit(function(e) {
        e.preventDefault();
        var idReserva = $(this).children("input[name='idReserva']").val();
        var idAssociacao = $(this).children("input[name='idAssociacao']").val();

        var dados = {
            idReserva: idReserva,
            idAssociacao: idAssociacao,
            act: "emprestar"
        }

        $.post("crudReserva.php", dados)
        .done(async function(retorno) {
            console.log(retorno)

            let resultado = JSON.parse(retorno);

            await swal({
                title: resultado.title,
                icon: resultado.icon
            });

            location.reload();
        });
    });

    $(".cancelarReserva").submit(function(e) {
        e.preventDefault();
        var idReserva = $(this).children("input[name='idReserva']").val();

        var dados = {
            idReserva: idReserva,
            act: "cancelarReserva"
        }

        swal({
                title: "Tem certeza que deseja cancelar esta reserva?",
                text: "Uma vez cancelada, você não será capaz de recuperá-la.",
                icon: "warning",
                buttons: ["Voltar", "Confirmar"],
                dangerMode: true,
            })
        .then((willDelete) => {
            if (willDelete) {
                $.post("crudReserva.php", dados)
                .done(async function(retorno) {

                    let resultado = JSON.parse(retorno);

                    await swal({
                        title: resultado.title,
                        icon: resultado.icon
                    });

                    location.reload();
                });
            }
        });

    });
</script>

</html>