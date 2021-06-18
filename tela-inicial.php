<?php
    include("conexao.php");
    session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location:index.php");
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/loader.css">
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
                      <li><a class="dropdown-item disabled" href="">Equipamentos disponíveis</a></li>
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
                      <li><a class="dropdown-item" href="gerencia-reservas.php">Gerenciar reservas</a></li>
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
    
    <div class="resultado">
        
    </div>
    <div class="container">
        <div class="row border-bottom mt-5 p-4">
            <div class="col-md-7">
                <h2>Equipamentos disponíveis</h2>
            </div>
            <div class="col-md-4">
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search">
                </form>
            </div>
            <div class="col-md-1">
                <a href="" id="carrinho" data-bs-toggle="modal" data-bs-target="#modalRealizarEmprestimo" class="btn bg-menu rounded-circle text-light"><i class="fas fa-shopping-cart"></i></a>
            </div>
        </div>
        <!-- <div class="row mt-4"> -->
            <?php
                $sql="SELECT id,imagem,tipo FROM `tb_tipoequipamento`";
                $count = 3;
                $count2 = 0;
                $res= mysqli_query($con,$sql);
                    while ($linha = mysqli_fetch_assoc($res))
                    {   
                        $id = $linha['id'];
                        $sql2 = "SELECT * FROM `tb_equipamento` WHERE tb_tipoEquipamento_id = '$id'";
                        $res2= mysqli_query($con,$sql2);
                        $total = mysqli_num_rows($res2);
                         
                        $sql2 = "SELECT * FROM tb_equipamento WHERE identificador NOT IN (
                            SELECT identificador FROM tb_equipamento eq
                            JOIN equipamento_reserva er
                            WHERE eq.identificador = er.tb_equipamento_identificador
                            AND er.ativo = 1)
                            AND identificador NOT IN (
                            SELECT identificador FROM tb_equipamento eq
                            JOIN equipamento_emprestimo ee
                            WHERE eq.identificador = ee.tb_equipamento_identificador
                            AND ee.ativo = 1
                            )";
                        $res2= mysqli_query($con,$sql2);
                        $disponiveis = mysqli_num_rows($res2);

                        $sql2 = "SELECT * FROM `tb_equipamento` te join equipamento_emprestimo ee on ee.tb_equipamento_identificador = te.identificador WHERE te.tb_tipoEquipamento_id = '$id' and ee.ativo = 1";
                        $res2= mysqli_query($con,$sql2);
                        $emprestados = mysqli_num_rows($res2);
                        
                        $sql2 = "SELECT * FROM `tb_equipamento` te join equipamento_reserva ee on ee.tb_equipamento_identificador = te.identificador WHERE te.tb_tipoEquipamento_id = '$id' and ee.ativo = 1";
                        $res2= mysqli_query($con,$sql2);
                        $reservados = mysqli_num_rows($res2);
                        if ($count == 3) 
                        {
                            echo "<div class='row mt-4'>";
                            $count = 0;
                        }   
                
                        echo    "<div class='col-md-4'>
                                    <a href='#' id='' class='link-produtos teste' data-tipo='".$linha['tipo']."' data-id='".$linha['id']."' data-bs-toggle='modal' data-bs-target='#modalEquipamentos'>
                                        
                                        <div class='effect-card back-card mx-auto card' style='width: 15rem;'>
                                            <div class='text-center top-card border-bottom'><h5>".$linha['tipo']."</h5></div>
                                            <img src='img/".$linha['imagem']."' height='150px' class='card-img-top border-bottom' alt='...'>
                                            <div class='card-body'>
                                                <h5 class='card-title'>Total: $total</h5>
                                            </div>
                                            <div class='row'>
                                                <div class='col-md-12'>
                                                    <p class='pl-4' ><i class='far fa-circle icon-succ'></i> Disponíveis: $disponiveis</p>
                                                </div>
                                            </div>
                                            <div class='row'>
                                                <div class='col-md-12'>
                                                    <p class='pl-4' ><i class='far fa-circle icon-dang'></i> Emprestados: $emprestados</p>
                                                </div>
                                            </div>
                                            <div class='row'>
                                                <div class='col-md-12'>
                                                    <p class='pl-4' ><i class='far fa-circle icon-war'></i> Reservados: $reservados</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>";
                        if ($count2 == 2)
                        {
                            echo "</div>";
                            $count2 = -1;
                        }
                        $count++; 
                        $count2++;
                    }   
            ?>
        <!-- </div> -->
        
    </div>
<div class="modal fade" id="modalRealizarEmprestimo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Carrinho</h5>
                <button type="button" id="close" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                </button>
            </div>
            <div class="Resposta"></div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <h5>Dados do Requerente</h5>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Selecione o tipo de identificador</label>
                            <select class="form-control" name="tipo" aria-label="Default select example">
                                <option value="ra">RA</option>
                                <option value="cpf">CPF</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <form method="" action="">
                                <label>Identificador <a class="text-dark fas fa-plus-circle" href="#" data-bs-toggle="modal" data-bs-target="#modalCadastraRequerente"></a></label><br>
                                <div class="input-group ">
                                    <input type="text" name="pesquisar" class="form-control" required>
                                    <div class="input-group-append">
                                        <button type="button" id="buscar" class="btn bg-menu text-light"><i class="fas fa-search"></i></button>
                                    </div>  
                                </div>                                     
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Nome do Requerente</label>
                            <input type="text" name="nomeRequerente" id="nomeRequerente" class="form-control" disabled >
                        </div>
                        <div class="col-md-6">
                            <label>E-mail do requerente</label>
                            <input type="text" name="emailRequerente" id="emailRequerente" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Tipo de Requerimento</label>
                            <select class="form-control" name="tipoRequerimento" aria-label="Default select example">
                                <option value="Emprestimo">Empréstimo</option>
                                <option value="Reserva">Reserva</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <h5 class="p-3">Equipamentos do Carrinho</h5>
                    </div>
                    <div >
                        <table id="Equipamentos" class="table table-hover">
                            <tr>
                                <th>Tipo</th>
                                <th>Id</th>
                                <th></th>
                            </tr>

                        </table>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-6 mx-auto text-center">
                            <button class="btn bg-menu text-light mx-auto" id="CadEmprestimo" type="button">Registrar Empréstimo</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalEquipamentos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Equipamento</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                </button>
            </div>
            <div class="Resposta"></div>
            <div class="modal-body">
                    <div class="row mt-2">
                        <h5 class="p-3">Dados do Equipamento</h5>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Selecione o Patrimônio</label>
                                <select class="form-control patrimonio" name="patrimonio" id="" aria-label="Default select example">
                                    
                                </select>
                        </div>
                        <div class="col-md-6">
                            <label>Tipo</label>
                            <input type="text" name="tipoEquip" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-6 mx-auto text-center">
                            <button class="btn bg-menu text-light mx-auto" id="addCarrinho" type="button">Adicionar ao <i class="fas fa-cart-plus"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalCadastraRequerente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastrar Requerente</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                </button>
            </div>
            <div class="Resposta"></div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <h5>Dados</h5>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Nome do Requerente</label>
                            <input type="text" name="CadnomeRequerente" id="CadNomeRequerente" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>E-mail do requerente</label>
                            <input type="text" name="CadEmailRequerente" id="CadEmailRequerente" class="form-control">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label>CPF</label>
                            <input type="text" name="CadCpf" id="CadCpf" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>RA</label>
                            <input type="text" name="CadRa" id="CadRa" class="form-control">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label>Tipo de Requerente</label>
                            <select class="form-control" name="TipoRequerente" aria-label="Default select example">
                                <option value="1">Aluno</option>
                                <option value="2">Professor</option>
                                <option value="3">Setor</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Telefone</label>
                            <input type="tel" name="Telefone" id="Telefone" class="form-control">
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-6 mx-auto text-center">
                            <button class="btn bg-menu text-light mx-auto" id="CadRequerente" type="button">Cadastrar</button>
                        </div>
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
<!-- <script src="js/bootstrap.bundle.min.js"></script> -->
<!-- <script src="js/bootstrap.js"></script> -->
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="js/script.js"></script>
<script src="js/jquery.maskedinput-1.1.4.pack.js"></script>
<script>
        $(document).ready(function(){
		$("#Telefone").mask("(99) 9999-99999");
	});
    // $(document).ready(function(){
    //     $("#CadCpf").mask("999.999.999-99");
    // });
    </script>
</html>