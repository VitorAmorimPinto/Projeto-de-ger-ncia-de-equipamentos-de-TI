<?php
include("conexao.php");

//Pega o fuso horário do Brasil para a data
date_default_timezone_set('America/Sao_Paulo');

@$idEmprestimo = $_POST['idEmprestimo'];
@$act = $_GET['act'];
@$dataDevolucao = date("Y-m-d H:i:s");


if($act == "finalizarEmprestimo")
{
    $sqlSelect = "SELECT tb_equipamento_identificador FROM emprestimo WHERE id = ".$idEmprestimo."";
    $resSelect = mysqli_query($con, $sqlSelect) or die(mysqli_error($con));
    $identificadorEquipamento = mysqli_fetch_array($resSelect);

    $sql = "UPDATE emprestimo SET data_devolucao = '".$dataDevolucao."',  estado = 'Finalzado' WHERE id = ".$idEmprestimo."";
    $res = mysqli_query($con, $sql) or die(mysqli_error($con));

    if($res == true)
    {
        $sql = "UPDATE tb_equipamento SET estado = 'Disponivel' WHERE identificador = ".$identificadorEquipamento['tb_equipamento_identificador']."";
        $res = mysqli_query($con, $sql) or die(mysqli_error($con));
        
        if($res == true)
        {
             echo "
                <script>
                    alert('Empréstimo finalizado com sucesso');
                    window.location = 'gerencia-emprestimos.php';
                </script>
            ";
        }  
    }
    else
    {
        echo "
            <script>
                alert('Erro ao finalizar empréstimo');
                window.location = 'gerencia-emprestimos.php';
            </script>
        ";
    }

}
else
{
    if($act == "cancelarEmprestimo" )
    {

        $sqlSelect = "SELECT tb_equipamento_identificador FROM emprestimo WHERE id = ".$idEmprestimo."";
        $resSelect = mysqli_query($con, $sqlSelect) or die(mysqli_error($con));
        $identificadorEquipamento = mysqli_fetch_array($resSelect);

        $sql = "DELETE FROM emprestimo WHERE id = ".$idEmprestimo."";
        $res = mysqli_query($con, $sql) or die(mysqli_error($con));

        if($res == true)
        {
            $sql = "UPDATE tb_equipamento SET estado = 'Disponivel' WHERE identificador = ".$identificadorEquipamento['tb_equipamento_identificador']."";
            $res = mysqli_query($con, $sql) or die(mysqli_error($con));
            
            if($res == true)
            {
                echo "
                    <script>
                        alert('Empréstimo cancelado com sucesso');
                        window.location = 'gerencia-emprestimos.php';
                    </script>
                ";
            }
            
        }
        else
        {
            echo "
                <script>
                    alert('Erro ao cancelar empréstimo');
                    window.location = 'gerencia-emprestimos.php';
                </script>
            ";
        }
    }
}

?>
