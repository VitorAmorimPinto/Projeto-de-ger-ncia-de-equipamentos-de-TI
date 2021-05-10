<?php
    session_start();
    if (!isset($_SESSION["usuario"])){
        header("Location:index.php");       
        }
?>

<!DOCTYPE html>
<html lang="pt-br">

<?php
include("conexao.php");
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="fontawesome/css/all.css">
    <title>Configurações gerais</title>
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
                        <a class="nav-link dropdown-toggle" href="index.html" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Equipamentos
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="index.html">Equipamentos disponíveis</a></li>
                            <li><a class="dropdown-item" href="cadastro.html">Cadastrar Equipamentos</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="index.html" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Empréstimos
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="gerencia-emprestimos.html">Gerenciar empréstimos</a></li>
                            <li><a class="dropdown-item" href="historico.html">Histórico de Empréstimos</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link " href="configuracoes-gerais.html">
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
    <div class="container ">

        <div class="row border-bottom mt-5" id="gerencia-emprestimos-top-content">

            <div class="col-lg-6" id="configuracoes-gerais-title h1">
                <h1>Configurações gerais</h1><br><br>
            </div>

        </div> <br><br>

        <!-- Email's cadastrados-->
        <div>
            <h3>Email's cadastrados</h3>
        </div><br>

        <div class="row">
            <div class="col-md-4">
                <div>
                    <form class="form-group">
                        <label>Gestor de T.I</label>
                        <span><button type="button" class="btn btn-outline-dark btn-sm btn-add" data-bs-toggle="modal" data-bs-target="#modalCadastroEmailGestor">+</button></span>

                        <?php
                        $sql = "SELECT * FROM tb_funcionario WHERE cargo = 'Gestor'";
                        $res = mysqli_query($con, $sql);

                        if (mysqli_num_rows($res) == 1) {
                            $dados = mysqli_fetch_array($res);
                            echo "
                                    <input type='text' name='gestor' class='form-control' value='" . $dados['email'] . "' disabled>
                                ";
                        } else {
                            echo "
                                    <input type='text' name='gestor' class='form-control' disabled>
                                ";
                        }
                        ?>

                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <div>
                    <form class="form-group">
                        <label>Funcionários de T.I</label>
                        <span><button type="button" class="btn btn-outline-dark btn-sm btn-add" data-bs-toggle="modal" data-bs-target="#modalCadastroEmailFuncionario">+</button></span>
                        <span><button type="button" class="btn btn-outline-dark btn-sm " id="btn-remove" data-bs-toggle="modal" data-bs-target="#modalRemoverEmailFuncionario">x</button></span>
                        <select class="form-control">
                            <?php
                            $sql = "SELECT * FROM tb_funcionario WHERE cargo = 'Funcionário'";
                            $res = mysqli_query($con, $sql);

                            while ($linha = mysqli_fetch_array($res)) {
                                echo "
                                        <option>" . $linha['email'] . "</option>
                                    ";
                            }
                            ?>
                        </select>
                    </form>
                </div>
            </div>
        </div>

        <!-- Cadastrar novos setores-->
        <div>
            <h3>Cadastrar novos setores</h3>
        </div><br>

        <div class="row">
            <div class="col-md-4">
                <div>
                    <form class="">
                        <label>Nome </label>
                        <input type="text" name="Nome" class="form-control">
                        <input type="submit" value="Cadastrar setor" class="btn mt-4 bg-menu text-white">
                    </form>
                </div>
            </div>
        </div><br><br>

        <!-- Cadastrar informações da faculdade-->
        <div>
            <h3>Cadastrar informações da faculdade</h3>
        </div><br>

        <div class="row">
            <div class="col-md-4">
                <div>
                    <form class="">
                        <label>Nome</label>
                        <input type="text" name="nome" class="form-control">
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <div>
                    <form class="">
                        <label>Telefone</label>
                        <input type="text" name="telefone" class="form-control">

                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-5">
                <div>
                    <form class="">
                        <label>Endereço</label>
                        <input type="text" name="gestor" class="form-control">
                        <input type="submit" value="Cadastrar" class="btn mt-4 bg-menu text-white">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Gestor-->
    <div class="modal" tabindex="-1" role="dialog" id="modalCadastroEmailGestor">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Novo email do gestor</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                    </button>
                </div>

                <form method="POST" action="crudFuncionarios.php?act=cadGestor">
                    <div class="modal-body">
                        <label>E-mail</label>
                        <input type="email" name="emailGestor" class="form-control" required>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" value="Salvar" class="btn bg-menu text-white">
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!--Aqui termina o modal-->

    <!-- Modal Funcionario-->
    <div class="modal" tabindex="-1" role="dialog" id="modalCadastroEmailFuncionario">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Novo email do funcionário</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                    </button>
                </div>

                <form method="POST" action="crudFuncionarios.php?act=cadFuncionario">
                    <div class="modal-body">
                        <label>Cadastrar e-mail</label>
                        <input type="email" name="emailFuncionario" class="form-control" required>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" value="Salvar" class="btn bg-menu text-white">
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!--Aqui termina o modal-->

    <!-- Modal Remover Funcionario-->
    <div class="modal" tabindex="-1" role="dialog" id="modalRemoverEmailFuncionario">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Remover e-mail</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                    </button>
                </div>

                <form method="POST" action="crudFuncionarios.php?act=delFuncionario">
                    <div class="modal-body">
                        <label>Selecione o e-mail a ser removido</label>
                        <select class="form-control" name="delEmailFuncionario">
                            <?php
                            $sql = "SELECT * FROM tb_funcionario WHERE cargo = 'Funcionário'";
                            $res = mysqli_query($con, $sql);

                            while ($linha = mysqli_fetch_array($res)) {
                                echo "
                                        <option value='".$linha['email']."'>" . $linha['email'] . "</option>
                                    ";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" value="Remover" class="btn bg-menu text-white">
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!--Aqui termina o modal-->

</body>
<script src="js/bootstrap.bundle.min.js"></script>

</html>