<?php
include("conexao.php");

//Pega o fuso horário do Brasil para a data
date_default_timezone_set('America/Sao_Paulo');

@$idAssociacao = $_POST['idAssociacao'];
@$idEmprestimo = $_POST['idEmprestimo'];
@$act = $_POST['act'];
@$dataDevolucao = date("Y-m-d H:i:s");

switch($act)
{
    case "finalizarEmprestimo":
        $sqlSelect = "SELECT tb_equipamento_identificador FROM equipamento_emprestimo WHERE id = ".$idAssociacao."";
        $resSelect = mysqli_query($con, $sqlSelect) or die(mysqli_error($con));
        $identificadorEquipamento = mysqli_fetch_array($resSelect);

        $sql = "UPDATE equipamento_emprestimo SET ativo = 0 WHERE id = ".$idAssociacao."";
        $res = mysqli_query($con, $sql) or die(mysqli_error($con));

        if($res == true)
        {
            $sql = "UPDATE tb_equipamento SET estado = 'Disponivel' WHERE identificador = ".$identificadorEquipamento['tb_equipamento_identificador']."";
            $res = mysqli_query($con, $sql) or die(mysqli_error($con));
            
            if($res == true)
            {
                //Verifica se todos os equipamentos do empréstimo foram devolvidos para então mudar o status do empréstimo
                $sqlCountEmprestimos = "SELECT COUNT(*) Qtd FROM equipamento_emprestimo WHERE emprestimo_id = ".$idEmprestimo." AND ativo = 1";
                $resCountEmprestimos = mysqli_query($con, $sqlCountEmprestimos) or die(mysqli_error($con));     
                $countEmprestimos = mysqli_fetch_array($resCountEmprestimos);

                if($countEmprestimos["Qtd"] == 0){
                    $sql = "UPDATE tb_emprestimo SET data_devolucao = '".$dataDevolucao."', ativo = 0 WHERE id = ".$idEmprestimo."";
                    $res = mysqli_query($con, $sql) or die(mysqli_error($con));
                }

                $resposta = array("title" => "Empréstimo finalizado com sucesso", "icon" => "success");
                echo json_encode($resposta);
            }  

            
        }
        else
        {
            $resposta = array("title" => "Erro ao finalizar empréstimo", "icon" => "error");
            echo json_encode($resposta);
        }
        break;

    case "cancelarEmprestimo":
        if($act == "cancelarEmprestimo" )
        {

        $sqlSelect = "SELECT tb_equipamento_identificador FROM equipamento_emprestimo WHERE id = ".$idEmprestimo."";
        $resSelect = mysqli_query($con, $sqlSelect) or die(mysqli_error($con));
        $identificadorEquipamento = mysqli_fetch_array($resSelect);

        $sql = "DELETE FROM equipamento_emprestimo WHERE id = ".$idEmprestimo."";
        $res = mysqli_query($con, $sql) or die(mysqli_error($con));

        if($res == true)
        {
            $sql = "UPDATE tb_equipamento SET estado = 'Disponivel' WHERE identificador = ".$identificadorEquipamento['tb_equipamento_identificador']."";
            $res = mysqli_query($con, $sql) or die(mysqli_error($con));
            
            if($res == true)
            {
                $resposta = array("title" => "Empréstimo cancelado com sucesso", "icon" => "success");
                echo json_encode($resposta);
            }
            
        }
        else
        {
            $resposta = array("title" => "Erro ao cancelar empréstimo", "icon" => "error");
            echo json_encode($resposta);
        }
    }
    break;
}

?>