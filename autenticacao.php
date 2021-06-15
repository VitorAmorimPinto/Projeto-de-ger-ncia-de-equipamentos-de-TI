<?php
include("conexao.php");

if($_GET["acao"] == "logar"){
// Pegando variáveis lá do login
$login = $_POST['login'];
$senha = $_POST['senha'];

// Consulta no banco
$sql = "SELECT * From tb_usuario WHERE email = '$login' and senha ='$senha'";
// Executa consulta
$exe = mysqli_query($con, $sql);

// Conta quantos registros a consulta trouxe 
$cont = mysqli_num_rows($exe);


if ($cont != 0) {
    session_start();
    // Pega os registros que a consulta trouxe
    while($linha = mysqli_fetch_array($exe)){
        $_SESSION["usuario"] = $linha["email"];
        $_SESSION["IdUser"] = $linha["id"];
    }
    // comando que redireciona para uma tela
    header("Location:tela-inicial.php");
}else{
    header("Location:index.php");
}

}




?>