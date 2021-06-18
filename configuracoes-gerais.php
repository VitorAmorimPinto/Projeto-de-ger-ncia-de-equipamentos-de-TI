<?php
session_start();
if (!isset($_SESSION["usuario"])) {
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
                        <a class="nav-link dropdown-toggle" href="tela-inicial.php" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Equipamentos
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="tela-inicial.php">Equipamentos disponíveis</a></li>
                            <li><a class="dropdown-item" href="cadastro.php">Cadastrar Equipamentos</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="index.php" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Empréstimos
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="gerencia-emprestimos.php">Gerenciar empréstimos</a></li>
                            <li><a class="dropdown-item" href="historico.php">Histórico de Empréstimos</a></li>
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
                    <li class="nav-item dropdown">
                        <a class="nav-link " href="sair.php" data-bs-toggle="modal" data-bs-target="#modalSobre">
                            Sair
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
                        $sql = "SELECT * FROM tb_usuario WHERE cargo = 'Gestor'";
                        $res = mysqli_query($con, $sql);

                        if (mysqli_num_rows($res) > 0) {
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
                            $sql = "SELECT * FROM tb_usuario WHERE cargo = 'Funcionario'";
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
                    <form class="" method="POST" id="cadSetor">
                        <label>Nome </label>
                        <input type="text" name="nomeSetor" class="form-control">
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
                    <?php
                    $sql = "SELECT * FROM tb_estabelecimento";
                    $res = mysqli_query($con, $sql);
                    $dadosEstabelecimento = mysqli_fetch_array($res);
                    ?>

                    <form class="" method="POST" id="cadInfoEstabelecimento">
                        <label>Nome</label>
                        <?php
                        echo "<input type='text' name='nomeEstabelecimento' class='form-control' value='" . @$dadosEstabelecimento['nome'] . "'>";
                        ?>
                </div>
            </div>
            <div class="col-md-4">
                <div>
                    <label>Telefone</label>
                    <?php
                    echo "<input type='text' name='telefoneEstabelecimento' class='form-control' value='" . @$dadosEstabelecimento['telefone'] . "'>";
                    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div>
                    <label>Endereço</label>
                    <?php
                    echo "<input type='text' name='enderecoEstabelecimento' class='form-control' value='" . @$dadosEstabelecimento['endereco'] . "'>";
                    ?>
                    <input type="submit" value="Salvar informações" class="btn mt-4 bg-menu text-white">
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

                <form method="POST" id="cadGestor">
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
                    <h5 class="modal-title">Novo funcionário</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                    </button>
                </div>

                <form method="POST" id="cadFuncionario">
                    <div class="modal-body">
                        <label>E-mail</label>
                        <input type="email" name="emailFuncionario" class="form-control" required>
                        <label>Senha</label>
                        <input type="password" name="senhaFuncionario" id="senhaFuncionario" class="form-control" required>
                        <input type="checkbox" onclick="mostrarSenha()"> Mostrar senha
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

                <form method="POST" id="delFuncionario">
                    <div class="modal-body">
                        <label>Selecione o e-mail do funcionário a ser removido</label>
                        <select class="form-control" name="delEmailFuncionario">
                            <?php
                            $sql = "SELECT * FROM tb_usuario WHERE cargo = 'Funcionario'";
                            $res = mysqli_query($con, $sql);

                            while ($linha = mysqli_fetch_array($res)) {
                                echo "
                                        <option value='" . $linha['email'] . "'>" . $linha['email'] . "</option>
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

    <!-- Modal -->
 <div class="modal fade" id="modalSobre" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
 aria-hidden="true">
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
           <div class="col-md-6">Esse é um sistema de controle e gerenciamento de estoque de equipamentos
             tecnológicos disponibilizados para empréstimo dentro de uma instituição de ensino superior.</div>
           <div class="col-md-6 ms-auto">Esse sistema surgiu por conta de uma demanda real que nossa instituição de
             ensino possuía, em um cenário onde não havia o gerenciamento efetivo dos equipamentos emprestados a
             alunos e funcionários. </div>
         </div>

       </div>
     </div>
     <div class="modal-footer">
       <p class="text-muted">Projeto desenvolvido pelos alunos do "Grupo do Grupo", do 3º Período do curso de
         Sistemas de Informação da Unisales.</p>
     </div>
     <!--Aqui termina o modal-->


</body>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/jquery.min.js"></script>

<!--Para aplicar máscara de formatação ao campo de telefone-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
<!--Sweet Alert-->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    //Máscara do telefone
    $("input[name='telefoneEstabelecimento']").mask("(99) 99999-9999");

    //Mostrar a senha do funcionário
    function mostrarSenha() {
        var x = document.getElementById("senhaFuncionario");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }

    $("#cadFuncionario").submit(function(e) {
        e.preventDefault();
        $("#modalCadastroEmailFuncionario").modal('hide');
        var emailFuncionario = $("input[name='emailFuncionario']").val();
        var senhaFuncionario = $("input[name='senhaFuncionario']").val();
        console.log("aqui")
        var dados = {
            emailFuncionario: emailFuncionario,
            senhaFuncionario: senhaFuncionario,
            act: "cadFuncionario"
        }

        $.post('crudConfigGerais.php', dados)
            .done(
                async function(retorno) {
                    console.log(retorno)
                    let resultado = JSON.parse(retorno);
                    await swal({
                        title: resultado.title,
                        icon: resultado.icon,
                    });

                    $("input[name='emailFuncionario']").val("");
                    location.reload()
                }
            )
    });

    $("#cadGestor").submit(function(e) {
        e.preventDefault();
        $("#modalCadastroEmailGestor").modal('hide');
        var emailGestor = $("input[name='emailGestor']").val();

        var dados = {
            emailGestor: emailGestor,
            act: "cadGestor"
        }

        $.post('crudConfigGerais.php', dados)
            .done(
                //Função assíncrona que espera o alerta ser fechado para dar refresh na página
                async function(retorno) {
                    console.log(retorno)
                    let resultado = JSON.parse(retorno);
                    await swal({
                        title: resultado.title,
                        icon: resultado.icon,
                    });

                    $("input[name='emailGestor']").val("");
                    location.reload()
                }
            )
    });

    $("#delFuncionario").submit(function(e) {
        e.preventDefault();
        $("#modalRemoverEmailFuncionario").modal('hide');
        var delEmailFuncionario = $("select[name='delEmailFuncionario']").val();

        var dados = {
            delEmailFuncionario: delEmailFuncionario,
            act: "delFuncionario"
        }

        $.post('crudConfigGerais.php', dados)
            .done(
                async function(retorno) {
                    let resultado = JSON.parse(retorno);
                    await swal({
                        title: resultado.title,
                        icon: resultado.icon,
                    });

                    location.reload()
                }
            )
    });

    $("#cadSetor").submit(function(e) {
        e.preventDefault();
        var nomeSetor = $("input[name='nomeSetor']").val();

        var dados = {
            nomeSetor: nomeSetor,
            act: "cadSetor"
        }

        $.post('crudConfigGerais.php', dados)
            .done(
                async function(retorno) {
                    let resultado = JSON.parse(retorno);
                    await swal({
                        title: resultado.title,
                        icon: resultado.icon,
                    });

                    $("input[name='nomeSetor']").val("");
                    location.reload()
                }
            )
    });

    $("#cadInfoEstabelecimento").submit(function(e) {
        e.preventDefault();
        var nomeEstabelecimento = $("input[name='nomeEstabelecimento']").val();
        var telefoneEstabelecimento = $("input[name='telefoneEstabelecimento']").val();
        var enderecoEstabelecimento = $("input[name='enderecoEstabelecimento']").val();

        var dados = {
            nomeEstabelecimento: nomeEstabelecimento,
            telefoneEstabelecimento: telefoneEstabelecimento,
            enderecoEstabelecimento,
            enderecoEstabelecimento,
            act: "cadInfoEstabelecimento"
        }

        $.post('crudConfigGerais.php', dados)
            .done(
                async function(retorno) {
                    let resultado = JSON.parse(retorno);
                    await swal({
                        title: resultado.title,
                        icon: resultado.icon,
                    });

                    $("input[name='nomeEstabelecimento']").val("");
                    $("input[name='telefoneEstabelecimento']").val("");
                    $("input[name='enderecoEstabelecimento']").val("");
                    location.reload()
                }
            )
    });
</script>

</html>