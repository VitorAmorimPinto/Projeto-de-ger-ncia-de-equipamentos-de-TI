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
  <link rel="stylesheet" href="fontawesome/css/all.css">
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
              <li><a class="dropdown-item disabled" href="">Cadastrar Equipamentos</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="index.html" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
  <br>

  <div class="container">
    <div class="row border-bottom p-4">
      <div class="col-md-12">
        <h2>Cadastro de Equipamentos</h2>
      </div>
    </div>

    <form method="POST" id="cadEquip">
      <div class="row mt-5">
        <div class="col-md-4">
          <div class="border mx-auto" id="card-cadastro">

            <?php
            $sql = "SELECT * FROM tb_tipoequipamento ORDER BY tipo ASC LIMIT 1";
            $res = mysqli_query($con, $sql) or die(mysqli_error($con));
            $row = $res->fetch_assoc();
            if ($row) {
              echo "<img src='img/" . $row['imagem'] . "' class='card-img-top' id='img-card' alt='...'>";
            } else {
              echo "<img src='img/previa.png' class='card-img-top' id='img-card' alt='...'>";
            }
            ?>
          </div>
          <br>
        </div>
        <div class="col-md-4">

          <label> Tipo de equipamento <button type="button" class="btn btn-outline-dark btn-sm btn-add" id="" data-bs-toggle="modal" data-bs-target="#modalcadastro">+</button></label>
          <select class="form-control" id="selectTipoEquip" name="tipoCadEquip">
            <?php
            $sql = "SELECT * FROM tb_tipoequipamento ORDER BY tipo ASC";
            $res = mysqli_query($con, $sql) or die(mysqli_error($con));
            while ($linha = mysqli_fetch_array($res)) {
              echo "<option value='" . $linha['tipo'] . "'>" . $linha['tipo'] . "</option>";
            }
            ?>

          </select>
          <label>Identificador do equipamento</label>
          <input type="text" name="identificadorCadEquip" class="form-control" required> <br>
          <input type="submit" value="Cadastro Equipamento" class="btn bg-menu text-white" id="btn-cad-equipamento">

        </div>
      </div>
    </form>

  </div>
</body>


<footer class="footer">
  <div class="container-fluid">
    <div class="col">
      <span class="text-muted">Copyright © 2021. Todos os direitos reservados a Unisales ®. </span>
    </div>
  </div>
</footer>

<!--modal-cadastro-->
<div class="modal" tabindex="-1" role="dialog" id="modalcadastro">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Novo Tipo de Equipamento</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fas fa-times"></i></span>
        </button>
      </div>

      <form method="POST" id="cadTipo" enctype="multipart/form-data">

        <div class="modal-body">
          <label>Novo tipo</label>
          <input type="text" name="cadTipo" class="form-control" required>
          <label> Nova Imagem </label>
          <div class="form-group">
            <input type="file" class="form-control-file" id="imgCadTipo" name="imgCadTipo" required>
          </div>
        </div>

        <div class="modal-footer">
          <input class="btn" id="btn-cad" type="submit" value="Cadastrar">
        </div>

      </form>

    </div>
  </div>
</div>

<!-- <script src="js/bootstrap.bundle.min.js"></script> -->
<!-- <script src="js/bootstrap.js"></script> -->
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/script.js" type="text/javascript"></script>
<!--Sweet Alert-->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
  $("#cadTipo").submit(function(e) {
    e.preventDefault();
    
    var cadTipo = $("input[name='cadTipo']").val();
    //Seleciona o arquivo
    var imgCadTipo = document.forms['cadTipo']['imgCadTipo'].files[0];

    //Dados para serem enviados para o back
    var fd = new FormData()
    fd.append('imgCadTipo', imgCadTipo)
    fd.append('cadTipo', cadTipo)
    fd.append('act', 'cadTipo')

    $.ajax({
        url : 'crudEquipamento.php',
        type: 'POST',
        data: fd,
        contentType: false,
        processData: false,
        success: async function(retorno) {
          console.log(retorno)
          let resultado = JSON.parse(retorno);

          await swal({
            title: resultado.title,
            icon: resultado.icon
          });

          location.reload();
        }
    })
  });


  $("#cadEquip").submit(function(e) {
        e.preventDefault();
        $("#modalRemoverEmailFuncionario").modal('hide');
        var identificadorCadEquip = $("input[name='identificadorCadEquip']").val();
        var tipoCadEquip = $("select[name='tipoCadEquip']").val();

        var dados = {
            identificadorCadEquip: identificadorCadEquip,
            tipoCadEquip: tipoCadEquip,
            act: "cadEquip"
        }

        console.log(dados)

        $.post('crudEquipamento.php', dados)
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



</script>

</html>