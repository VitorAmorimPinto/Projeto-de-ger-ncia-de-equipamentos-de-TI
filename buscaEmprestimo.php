<?php
include("conexao.php");
session_start();
@$act = $_POST['act'];
if ($act == "BuscProd") {
$idProduto = $_POST['idProduto'];



$sql = "SELECT * FROM tb_equipamento WHERE tb_tipoEquipamento_id = '$idProduto' and identificador NOT IN (
    SELECT identificador FROM tb_equipamento eq
    JOIN equipamento_reserva er
    WHERE eq.identificador = er.tb_equipamento_identificador
    AND er.ativo = 1)
    AND tb_tipoEquipamento_id = '$idProduto' and identificador NOT IN (
    SELECT identificador FROM tb_equipamento eq
    JOIN equipamento_emprestimo ee
    WHERE eq.identificador = ee.tb_equipamento_identificador
    AND ee.ativo = 1
    )";
$exe = mysqli_query($con, $sql);

while($linha = mysqli_fetch_array($exe)){
        echo "<option value='".$linha['identificador']."'>".$linha['identificador']."</option>";
    }
        
    

    

}

else if($act == "BuscUser"){
    $identificador = $_POST['palavra'];
    $parametro = $_POST['parametro'];



    $sql = "select * from tb_requerente where $parametro = '$identificador'";
    $exe = mysqli_query($con, $sql) or die(mysqli_error($con)); 
    $cont = mysqli_num_rows($exe);
        if ($cont == 1) {
            @$resp = array("estado" => "sim");
            @$linha = mysqli_fetch_assoc($exe);
            @$teste = $linha + $resp;
            echo json_encode($teste);
        }else{
            $resposta = array("title" => "Usúario não encontrado", "icon" => "error","estado" => "nao");
            echo json_encode($resposta);
            
        }
    
    

}

else if($act == "CadEmprestimo"){
    date_default_timezone_set('America/Sao_Paulo');
    $dataEmprestimo = date('Y-m-d H:i:s', time());
    $idRequerente = $_POST["IdRequerente"];
    $idUsuario = $_SESSION["IdUser"];
    
    // Inserindo na tb_emprestimo
    $insert = "INSERT INTO `tb_emprestimo`(`id`, `data_emprestimo`, `data_devolucao`, `ativo`, `tb_requerente_id`, `tb_usuario_id`) VALUES (null,'$dataEmprestimo',null,1,'$idRequerente','$idUsuario')";
    $res = mysqli_query($con, $insert) or die(mysqli_error($con));
    //Pega id do insert
    $_SESSION["idEmprestimo"] = mysqli_insert_id($con);
    echo $res;
   
    

}

else if($act == "CadReserva"){
    date_default_timezone_set('America/Sao_Paulo');
    $dataReserva = date('Y-m-d H:i:s', time());
    // $idEquipamento = $_POST["idProduto"];
    $idRequerente = $_POST["IdR"];
    $idUsuario = $_SESSION["IdUser"];
    
    // Inserindo na reserva
    $insert = "INSERT INTO `reserva`(`id`, `data_reserva`, `ativo`, `tb_requerente_id`, `tb_usuario_id`) VALUES (null,'$dataReserva',1,'$idRequerente','$idUsuario')";
    $res = mysqli_query($con, $insert) or die(mysqli_error($con));
    //Pega id do insert
    $_SESSION["idReserva"] = mysqli_insert_id($con);
    echo $res;

}

else if ($act == "CadRequerente") {
        
        $nome = $_POST["nome"];;
        $email = $_POST["email"];;
        $cpf = $_POST["cpf"];;
        $ra = $_POST["ra"];;
        $TipoRequerente = $_POST["TipoRequerente"];;
        $telefone = $_POST["telefone"];
        
        $insert = "INSERT INTO `tb_requerente`(`id`, `tb_tipo_requerente_id`, `nome`, `cpf`, `ra`, `email`, `telefone1`, `telefone2`) VALUES (null,'$TipoRequerente','$nome','$cpf','$ra','$email','$telefone',null)";
        $res = mysqli_query($con, $insert) or die(mysqli_error($con));

        if ($res == 1) {
        
            $resposta = array("title" => "Cadastrado com sucesso", "icon" => "success");
            echo json_encode($resposta);
        
        }else{
            
            $resposta = array("title" => "Erro ao cadastrar", "icon" => "error");
            echo json_encode($resposta);
        }



}

else if ($act == "registrarProdutoEmprestimo") {

    $idEmprestimo = $_SESSION["idEmprestimo"];
    $idEquipamento = $_POST["idEquipamento"];
    
    $insert = "INSERT INTO `equipamento_emprestimo`(`id`, `emprestimo_id`, `tb_equipamento_identificador`, `ativo`) VALUES (null,$idEmprestimo,'$idEquipamento',1)";
    $res = mysqli_query($con, $insert) or die(mysqli_error($con));
    echo $res;

    // if ($res == 1) {
        
    //     $resposta = array("title" => "Cadastrado com sucesso", "icon" => "success");
    //     echo json_encode($resposta);
    
    // }
}

else if 
    ($act == "registrarProdutoReserva") {

    @$idReserva = $_SESSION["idReserva"];
    @$idEquipamento = $_POST["idEquipamento"];
    
    
    $insert = "INSERT INTO `equipamento_reserva`(`id`, `reserva_id`, `tb_equipamento_identificador`, `ativo`) VALUES (null,'$idReserva','$idEquipamento',1)";
    $res = mysqli_query($con, $insert) or die(mysqli_error($con));
    echo $res;

   
}


?>