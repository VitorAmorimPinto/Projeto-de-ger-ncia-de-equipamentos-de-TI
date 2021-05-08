<?php
    include('conexao.php');
    @$act = $_GET['act'];
    @$emailGestor = $_POST['emailGestor'];
    @$emailFuncionario = $_POST['emailFuncionario'];
    @$delEmailFuncionario = $_POST['delEmailFuncionario'];

    if($act == "cadGestor"){
        $emailGestor = trim($emailGestor);

        $sql = "SELECT * FROM tb_funcionario WHERE cargo = 'Gestor'";
        $res = mysqli_query($con, $sql);

        if(mysqli_num_rows($res) == 1){
            $sql = "UPDATE tb_funcionario SET email = '".$emailGestor."' WHERE cargo = 'Gestor'";
            $res = mysqli_query($con, $sql);

            if($res == true){
                echo "
                    <script>
                        alert('E-mail atualizado com sucesso!');
                        window.location='configuracoes-gerais.php';
                    </script>
                    ";
            }else{
                echo "
                    <script>
                        alert('Erro ao atualizar e-mail');
                        window.location='configuracoes-gerais.php';
                    </script>
                    ";
            }
        }else{
            $sql = "INSERT INTO tb_funcionario(email, cargo) VALUES ('".$emailGestor."', 'Gestor')";
            $res = mysqli_query($con, $sql);

            if($res == true){
                echo "
                    <script>
                        alert('E-mail cadastrado com sucesso!');
                        window.location='configuracoes-gerais.php';
                    </script>
                    ";
            }else{
                echo "
                    <script>
                        alert('Erro ao cadastrar e-mail');
                        window.location='configuracoes-gerais.php';
                    </script>
                    ";
            }
        }    
    }else{
        if($act == "cadFuncionario"){
            $emailFuncionario = trim($emailFuncionario);
            
            $sql = "SELECT * FROM tb_funcionario WHERE email = '".$emailFuncionario."'";
            $res = mysqli_query($con, $sql);

            if(mysqli_num_rows($res) == 1){
                echo "
                    <script>
                        alert('Esse e-mail já está cadastrado no sistema');
                        window.location='configuracoes-gerais.php';
                    </script>
                    ";
            }else{
                
                $sql = "INSERT INTO tb_funcionario(email, cargo) VALUES ('".$emailFuncionario."', 'Funcionário')";
                $res = mysqli_query($con, $sql);

                if($res == true){
                    echo "
                        <script>
                            alert('E-mail cadastrado com sucesso!');
                            window.location='configuracoes-gerais.php';
                        </script>
                        ";
                }else{
                    echo "
                        <script>
                            alert('Erro ao cadastrar e-mail');
                            window.location='configuracoes-gerais.php';
                        </script>
                        ";
                }
            }

        }else{

            if($act == "delFuncionario"){
                $sql = "DELETE FROM tb_funcionario WHERE email = '".$delEmailFuncionario."'";
                $res = mysqli_query($con, $sql);

                if($res == true){
                    echo "
                        <script>
                            alert('E-mail removido com sucesso!');
                            window.location='configuracoes-gerais.php';
                        </script>
                        ";
                }else{
                    echo "
                        <script>
                            alert('Erro ao remover e-mail');
                            window.location='configuracoes-gerais.php';
                        </script>
                        ";
                }
            }
        }
    }
