<?php
include("conexao.php");

$identificador = $_POST['palavra'];
$parametro = $_POST['parametro'];



$sql = "select * from tb_requerente where $parametro = $identificador";
$exe = mysqli_query($con, $sql);
    //A SQl tem o intuito de buscar o email vinculado a esse login
$linha = mysqli_fetch_assoc($exe);
    
    echo json_encode($linha);
        
    

    


?>