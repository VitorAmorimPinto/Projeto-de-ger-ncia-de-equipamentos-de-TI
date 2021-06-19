<?php
include("conexao.php");

session_start();

//Pega o fuso horário do Brasil para a data
date_default_timezone_set('America/Sao_Paulo');

@$idAssociacao = $_POST['idAssociacao'];
@$idReserva = $_POST['idReserva'];
@$act = $_POST['act'];
@$dataAtual = date("Y-m-d H:i:s");

switch($act)
{
    case "emprestar":
        $sqlSelect = "SELECT tb_requerente_id as requerente_id, equipamento_reserva.tb_equipamento_identificador as equipamento_identificador, tb_usuario.id as idUsuario
                        FROM reserva
                        JOIN equipamento_reserva ON equipamento_reserva.reserva_id = reserva.id
                        JOIN tb_usuario 
                        WHERE equipamento_reserva.id = ".$idAssociacao."
                        AND tb_usuario.email = '".$_SESSION['usuario']."'
                    ";
        $resSelect = mysqli_query($con, $sqlSelect) or die(mysqli_error($con));
        $dados = mysqli_fetch_array($resSelect);


        $sqlInsertE = "INSERT INTO tb_emprestimo(data_emprestimo, ativo, tb_requerente_id, tb_usuario_id)
                        VALUES ('".$dataAtual."', 1, ".$dados['requerente_id'].", ".$dados['idUsuario'].")";
        $resInsertE = mysqli_query($con, $sqlInsertE) or die(mysqli_error($con));

        if($resInsertE == true)
        {
            $sqlSelectId = "SELECT id FROM tb_emprestimo ORDER BY data_emprestimo DESC LIMIT 1";
            $resSelectId  = mysqli_query($con, $sqlSelectId) or die(mysqli_error($con));
            $idEmprestimo = mysqli_fetch_array($resSelectId);

            $sqlInsertEE = "INSERT INTO equipamento_emprestimo(emprestimo_id, tb_equipamento_identificador, ativo) VALUES
            (".$idEmprestimo['id'].", '".$dados['equipamento_identificador']."', 1)";
            $resInsertEE = mysqli_query($con, $sqlInsertEE) or die(mysqli_error($con));

            $sqlUpdateR = "UPDATE equipamento_reserva SET ativo = 0 WHERE id = ".$idAssociacao."";
            $resUpdateR = mysqli_query($con, $sqlUpdateR) or die(mysqli_error($con));
            if($resUpdateR == true)
            {
                $resposta = array("title" => "Reserva finalizada com sucesso", "icon" => "success");
                echo json_encode($resposta);
            }
            else
            {
                $resposta = array("title" => "Erro ao finalizar reserva", "icon" => "error");
                echo json_encode($resposta);
            }
        }       
        else
        {
            $resposta = array("title" => "Erro ao finalizar reserva", "icon" => "error");
            echo json_encode($resposta);
        }
        break;

    case "cancelarReserva":

        $sqlSelect = "SELECT tb_equipamento_identificador FROM equipamento_reserva WHERE id = ".$idAssociacao."";
        $resSelect = mysqli_query($con, $sqlSelect) or die(mysqli_error($con));
        $identificadorEquipamento = mysqli_fetch_array($resSelect);

        $sql = "DELETE FROM equipamento_reserva WHERE id = ".$idAssociacao."";
        $res = mysqli_query($con, $sql) or die(mysqli_error($con));

        if($res == true)
        {
            $sql = "UPDATE tb_equipamento SET estado = 'Disponivel' WHERE identificador = ".$identificadorEquipamento['tb_equipamento_identificador']."";
            $res = mysqli_query($con, $sql) or die(mysqli_error($con));
            
            if($res == true)
            {
                $resposta = array("title" => "Reserva cancelada com sucesso", "icon" => "success");
                echo json_encode($resposta);
            }
            
        }
        else
        {
            $resposta = array("title" => "Erro ao cancelar reserva", "icon" => "error");
            echo json_encode($resposta);
        }
    break;
}

?>