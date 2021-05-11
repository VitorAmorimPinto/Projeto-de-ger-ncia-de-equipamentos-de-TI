<?php
include('conexao.php');
@$act = $_GET['act'];
@$emailGestor = $_POST['emailGestor'];
@$emailFuncionario = $_POST['emailFuncionario'];
@$delEmailFuncionario = $_POST['delEmailFuncionario'];
@$nomeSetor = $_POST['nomeSetor'];
@$nomeEstabelecimento = $_POST['nomeEstabelecimento'];
@$telefoneEstabelecimento = $_POST['telefoneEstabelecimento'];
@$enderecoEstabelecimento = $_POST['enderecoEstabelecimento'];

if ($act == "cadGestor") {
    $emailGestor = trim($emailGestor);

    $sql = "SELECT * FROM tb_funcionario WHERE cargo = 'Gestor'";
    $res = mysqli_query($con, $sql) or die(mysqli_error($con));

    if (mysqli_num_rows($res) > 0) {
        $sql = "UPDATE tb_funcionario SET email = '" . $emailGestor . "' WHERE cargo = 'Gestor'";
        $res = mysqli_query($con, $sql) or die(mysqli_error($con));

        if ($res == true) {
            echo "
                    <script>
                        alert('E-mail atualizado com sucesso!');
                        window.location='configuracoes-gerais.php';
                    </script>
                    ";
        } else {
            echo "
                    <script>
                        alert('Erro ao atualizar e-mail');
                        window.location='configuracoes-gerais.php';
                    </script>
                    ";
        }
    } else {
        $sql = "INSERT INTO tb_funcionario(email, cargo) VALUES ('" . $emailGestor . "', 'Gestor')";
        $res = mysqli_query($con, $sql) or die(mysqli_error($con));

        if ($res == true) {
            echo "
                    <script>
                        alert('E-mail cadastrado com sucesso!');
                        window.location='configuracoes-gerais.php';
                    </script>
                    ";
        } else {
            echo "
                    <script>
                        alert('Erro ao cadastrar e-mail');
                        window.location='configuracoes-gerais.php';
                    </script>
                    ";
        }
    }
} else {
    if ($act == "cadFuncionario") {
        $emailFuncionario = trim($emailFuncionario);

        $sql = "SELECT * FROM tb_funcionario WHERE email = '" . $emailFuncionario . "'";
        $res = mysqli_query($con, $sql) or die(mysqli_error($con));

        if (mysqli_num_rows($res) > 0) {
            echo "
                    <script>
                        alert('Esse e-mail já está cadastrado no sistema');
                        window.location='configuracoes-gerais.php';
                    </script>
                    ";
        } else {

            $sql = "INSERT INTO tb_funcionario(email, cargo) VALUES ('" . $emailFuncionario . "', 'Funcionário')";
            $res = mysqli_query($con, $sql) or die(mysqli_error($con));

            if ($res == true) {
                echo "
                        <script>
                            alert('E-mail cadastrado com sucesso!');
                            window.location='configuracoes-gerais.php';
                        </script>
                        ";
            } else {
                echo "
                        <script>
                            alert('Erro ao cadastrar e-mail');
                            window.location='configuracoes-gerais.php';
                        </script>
                        ";
            }
        }
    } else {
        if ($act == "delFuncionario") {
            $sql = "DELETE FROM tb_funcionario WHERE email = '" . $delEmailFuncionario . "'";
            $res = mysqli_query($con, $sql) or die(mysqli_error($con));

            if ($res == true) {
                echo "
                        <script>
                            alert('E-mail removido com sucesso!');
                            window.location='configuracoes-gerais.php';
                        </script>
                        ";
            } else {
                echo "
                        <script>
                            alert('Erro ao remover e-mail');
                            window.location='configuracoes-gerais.php';
                        </script>
                        ";
            }
        } else {
            if ($act == "cadSetor") {
                $nomeSetor = trim($nomeSetor);

                $sql = "SELECT * FROM tb_requerente WHERE tb_tipo_requerente_id  = 3 AND nome = '" . $nomeSetor . "'";
                $res = mysqli_query($con, $sql) or die(mysqli_error($con));

                if (mysqli_num_rows($res) > 0) {
                    echo "
                            <script>
                                alert('Esse setor já está cadastrado no sistema');
                                window.location = 'configuracoes-gerais.php';
                            </script>
                        ";
                } else {
                    $sql = "INSERT INTO tb_requerente (tb_tipo_requerente_id, nome) VALUES (3, '" . $nomeSetor . "')";
                    $res = mysqli_query($con, $sql) or die(mysqli_error($con));
                    if ($res == true) {
                        echo "
                                <script>
                                    alert('Setor cadastrado com sucesso!');
                                    window.location = 'configuracoes-gerais.php';
                                </script>
                            ";
                    } else {
                        echo "
                                <script>
                                    alert('Erro ao cadastrar setor!');
                                    window.location = 'configuracoes-gerais.php';
                                </script>
                            ";
                    }
                }
            } else {
                if ($act == "cadInfoEstabelecimento") {
                    $nomeEstabelecimento = trim($nomeEstabelecimento);
                    $enderecoEstabelecimento = trim($enderecoEstabelecimento);

                    $nomeConsulta = $nomeEstabelecimento;

                    $sql = "SELECT * FROM tb_estabelecimento";
                    $res = mysqli_query($con, $sql) or die(mysqli_error($con));

                    if (mysqli_num_rows($res) > 0) {
                        $sql = "UPDATE tb_estabelecimento
                                    SET nome = '" . $nomeEstabelecimento . "',  telefone = '" . $telefoneEstabelecimento . "', endereco = '" . $enderecoEstabelecimento . "'
                                    WHERE nome = '" . $nomeConsulta . "'";
                        $res = mysqli_query($con, $sql) or die(mysqli_error($con));

                        if ($res == true) {
                            echo "
                                    <script>
                                        alert('Informações atualizadas com sucesso!');
                                        window.location = 'configuracoes-gerais.php';
                                    </script>
                                ";
                        } else {
                            echo "
                                    <script>
                                        alert('Erro ao atualizar informações');
                                        window.location = 'configuracoes-gerais.php';
                                    </script>
                                ";
                        }
                    } else {
                        $sql = "INSERT INTO tb_estabelecimento (nome, telefone, endereco)
                                    VALUES ('" . $nomeEstabelecimento . "', '" . $telefoneEstabelecimento . "', '" . $enderecoEstabelecimento . "')";
                        $res = mysqli_query($con, $sql) or die(mysqli_error($con));

                        if ($res == true) {
                            echo "
                                    <script>
                                        alert('Estabelecimento cadastrado com sucesso!');
                                        window.location = 'configuracoes-gerais.php';
                                    </script>
                                ";
                        } else {
                            echo "
                                    <script>
                                        alert('Erro ao cadastrar informações');
                                        window.location = 'configuracoes-gerais.php';
                                    </script>
                                ";
                        }
                    }
                }
            }
        }
    }
}
