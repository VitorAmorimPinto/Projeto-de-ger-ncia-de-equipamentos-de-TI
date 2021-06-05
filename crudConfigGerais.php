<?php
include('conexao.php');
@$act = $_POST['act'];
@$emailGestor = $_POST['emailGestor'];
@$emailFuncionario = $_POST['emailFuncionario'];
@$senhaFuncionario = $_POST['senhaFuncionario'];
@$delEmailFuncionario = $_POST['delEmailFuncionario'];
@$nomeSetor = $_POST['nomeSetor'];
@$nomeEstabelecimento = $_POST['nomeEstabelecimento'];
@$telefoneEstabelecimento = $_POST['telefoneEstabelecimento'];
@$enderecoEstabelecimento = $_POST['enderecoEstabelecimento'];

switch($act){
    case "cadGestor":
        $emailGestor = trim($emailGestor);

        $sql = "SELECT * FROM tb_usuario WHERE cargo = 'Gestor'";
        $res = mysqli_query($con, $sql) or die(mysqli_error($con));

        if (mysqli_num_rows($res) > 0) {
            $sql = "UPDATE tb_usuario SET email = '" . $emailGestor . "', WHERE cargo = 'Gestor'";
            $res = mysqli_query($con, $sql) or die(mysqli_error($con));

            if ($res == true) {
                $resposta = array("title" => "E-mail atualizado com sucesso!", "icon" => "success");
                echo json_encode($resposta);
            } else {
                $resposta = array("title" => "Erro ao atualizar e-mail", "icon" => "warning");
                echo json_encode($resposta);
            }
        } else {
            $sql = "INSERT INTO tb_usuario(email, senha, cargo) VALUES ('" . $emailGestor . "', 'UNIS4L3S', 'Gestor')";
            $res = mysqli_query($con, $sql) or die(mysqli_error($con));

            if ($res == true) {
                $resposta = array("title" => "E-mail cadastrado com sucesso", "icon" => "success");
                echo json_encode($resposta);
            } else {
                $resposta = array("title" => "Erro ao cadastrar e-mail", "icon" => "error");
                echo json_encode($resposta);
            }
        }
        break;

    case "cadFuncionario":
        $emailFuncionario = trim($emailFuncionario);
        $senhaFuncionario = trim($senhaFuncionario);

        $sql = "SELECT * FROM tb_usuario WHERE email = '" . $emailFuncionario . "'";
        $res = mysqli_query($con, $sql) or die(mysqli_error($con));

        if (mysqli_num_rows($res) > 0) {
            $resposta = array("title" => "Esse funcionário já está cadastrado no sistema", "icon" => "warning");
            echo json_encode($resposta);
        } else {

            $sql = "INSERT INTO tb_usuario(email, senha, cargo) VALUES ('" . $emailFuncionario . "', '".$senhaFuncionario."', 'Funcionario')";
            $res = mysqli_query($con, $sql) or die(mysqli_error($con));

            if ($res == true) {
                $resposta = array("title" => "Funcionário cadastrado com sucesso", "icon" => "success");
                echo json_encode($resposta);
            } else {
                $resposta = array("title" => "Erro ao cadastrar funcionário", "icon" => "error");
                echo json_encode($resposta);
            }
        }
        break;

    case "delFuncionario":
        $sql = "DELETE FROM tb_usuario WHERE email = '" . $delEmailFuncionario . "'";
        $res = mysqli_query($con, $sql) or die(mysqli_error($con));

        if ($res == true) {
            $resposta = array("title" => "E-mail removido com sucesso!", "icon" => "success");
            echo json_encode($resposta);
        } else {
            $resposta = array("title" => "Erro ao remover e-mail", "icon" => "error");
            echo json_encode($resposta);
        }
        break;

    case "cadSetor":
        $nomeSetor = trim($nomeSetor);

        $sql = "SELECT * FROM tb_requerente WHERE tb_tipo_requerente_id  = 3 AND nome = '" . $nomeSetor . "'";
        $res = mysqli_query($con, $sql) or die(mysqli_error($con));

        if (mysqli_num_rows($res) > 0) {
            $resposta = array("title" => "Esse setor já está cadastrado no sistema", "icon" => "warning");
            echo json_encode($resposta);
        } else {
            $sql = "INSERT INTO tb_requerente (tb_tipo_requerente_id, nome) VALUES (3, '" . $nomeSetor . "')";
            $res = mysqli_query($con, $sql) or die(mysqli_error($con));
            if ($res == true) {
                $resposta = array("title" => "Setor cadastrado com sucesso", "icon" => "success");
                echo json_encode($resposta);
            } else {
                $resposta = array("title" => "Erro ao cadastrar setor", "icon" => "error");
                echo json_encode($resposta);
            }
        }
        break;

    case "cadInfoEstabelecimento":
        if ($act == "cadInfoEstabelecimento") {
            $nomeEstabelecimento = trim($nomeEstabelecimento);
            $enderecoEstabelecimento = trim($enderecoEstabelecimento);

            $sql = "SELECT * FROM tb_estabelecimento";
            $res = mysqli_query($con, $sql) or die(mysqli_error($con));

            if (mysqli_num_rows($res) > 0) {
                $sql = "UPDATE tb_estabelecimento
                            SET nome = '" . $nomeEstabelecimento . "',  telefone = '" . $telefoneEstabelecimento . "', endereco = '" . $enderecoEstabelecimento . "'";
                $res = mysqli_query($con, $sql) or die(mysqli_error($con));

                if ($res == true) {
                    $resposta = array("title" => "Informações atualizadas com sucesso", "icon" => "success");
                    echo json_encode($resposta);
                } else {
                    $resposta = array("title" => "Erro ao atualizar as informações", "icon" => "error");
                    echo json_encode($resposta);
                }
            } else {
                $sql = "INSERT INTO tb_estabelecimento (nome, telefone, endereco)
                            VALUES ('" . $nomeEstabelecimento . "', '" . $telefoneEstabelecimento . "', '" . $enderecoEstabelecimento . "')";
                $res = mysqli_query($con, $sql) or die(mysqli_error($con));

                if ($res == true) {
                    $resposta = array("title" => "Informações cadastradas com sucesso", "icon" => "success");
                    echo json_encode($resposta);
                } else {
                    $resposta = array("title" => "Erro ao cadastrar as informações", "icon" => "error");
                    echo json_encode($resposta);
                }
            }
        }
        break;
}
