<?php
include("conexao.php");

@$act = $_GET['act'];
@$cadTipo = $_POST['cadTipo'];
@$imgCadTipo = $_FILES['imgCadTipo']['name'];
@$identificadorCadEquip = $_POST['identificadorCadEquip'];
@$tipoCadEquip = $_POST['tipoCadEquip'];

if ($act == "cadTipo") {
    
    $cadTipo = trim($cadTipo);

    $sql = "SELECT * FROM tb_tipoequipamento WHERE tipo = '" . $cadTipo . "'";
    $res = mysqli_query($con, $sql) or die(mysqli_error($con));

    if (mysqli_num_rows($res) == 1) {
        echo "
            <script>
                alert('Esse tipo já existe!');
                window.location='cadastro.php';
            </script>
        ";
    } else {
        //Pasta onde o arquivo vai ser salvo
        $_UP['pasta'] = './img/';

        //Tamanho máximo do arquivo em Bytes
        $_UP['tamanho'] = 1024 * 1024 * 100; //5mb

        //Array com a extensões permitidas
        $_UP['extensoes'] = array('png', 'jpg', 'jpeg', 'gif');

        //Renomeiar
        $_UP['renomeia'] = true;

        //Array com os tipos de erros de upload do PHP
        $_UP['erros'][0] = 'Não houve erro';
        $_UP['erros'][1] = 'O arquivo no upload é maior que o limite do PHP';
        $_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especificado no HTML';
        $_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
        $_UP['erros'][4] = 'Não foi feito o upload do arquivo';

        //Verifica se houve algum erro com o upload. Sem sim, exibe a mensagem do erro
        if ($_FILES['imgCadTipo']['error'] != 0) {
            die("Não foi possivel fazer o upload, erro: <br />" . $_UP['erros'][$_FILES['imgCadTipo']['error']]);
            exit; //Para a execução do script
        }

        //Faz a verificação da extensao do arquivo
        $temp = explode('.', $_FILES['imgCadTipo']['name']);
        $extensao = strtolower(end($temp));
        if (array_search($extensao, $_UP['extensoes']) === false) {
            echo "
                <script>
                    alert('A imagem não foi cadastrada: Extensão inválida.');
                </script>
                ";
        }

        //Faz a verificação do tamanho do arquivo
        else if ($_UP['tamanho'] < $_FILES['imgCadTipo']['size']) {
            echo "
                <script>
                    alert('Arquivo maior que o limite (5mb)');
                </script>
                ";
        }

        //O arquivo passou em todas as verificações, hora de tentar move-lo para a pasta foto
        else {
            //Primeiro verifica se deve trocar o nome do arquivo
            if ($_UP['renomeia'] == true) {
                //Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
                $nome_final = $cadTipo . '.jpg';
            } else {
                //mantem o nome original do arquivo
                $nome_final = $_FILES['imgCadTipo']['name'];
            }
            //Verificar se é possivel mover o arquivo para a pasta escolhida
            if (move_uploaded_file($_FILES['imgCadTipo']['tmp_name'], $_UP['pasta'] . $nome_final)) {

                //Upload efetuado com sucesso, exibe a mensagem
                $sql = "INSERT INTO tb_tipoequipamento (tipo, imagem) VALUES ('" . $cadTipo . "','" . $nome_final . "')";
                mysqli_query($con, $sql);

                echo "<script>
                            window.location='cadastro.php';
                            alert('Tipo cadastrado com sucesso!');
                        </script>
                        ";
            } else {
                //Upload não efetuado com sucesso, exibe a mensagem
                echo "<script>
                            alert('Erro ao cadastrar equipamento');
                            window.location='cadastro.php';
                        </script>
                        ";
            }
        }
    }
} else {
    if ($act == "cadEquip") {

        $identificadorCadEquip = trim($identificadorCadEquip);

        $sqlSelectEquip = "SELECT * FROM tb_equipamento WHERE identificador = '" . $identificadorCadEquip . "'";
        $resSelectEquip = mysqli_query($con, $sqlSelectEquip) or die(mysqli_error($con));

        if (mysqli_num_rows($resSelectEquip) == 1) {
            echo "
            <script>
                window.location='cadastro.php';
                alert('Já existe um equipamento com esse identificador');
            </script>
            ";
        } else {

            $sqlSelectTipo = "SELECT id FROM tb_tipoequipamento WHERE tipo = '" . $tipoCadEquip . "'";
            $resSelectTipo = mysqli_query($con, $sqlSelectTipo) or die(mysqli_error($con));
            $dados = mysqli_fetch_array($resSelectTipo);

            $sqlInsertEquip = "INSERT INTO tb_equipamento(identificador, estado, tb_tipoEquipamento_id)
                                             VALUES ('" . $identificadorCadEquip . "', 'Disponivel', " . $dados['id'] . ")";
            $resInsertEquip = mysqli_query($con, $sqlInsertEquip) or die(mysqli_error($con));

            if ($resInsertEquip == true) {
                echo "
                    <script>
                        window.location='cadastro.php';
                        alert('Equipamento cadastrado com sucesso');
                    </script>
                    ";
            } else {
                echo "
                    <script>
                        window.location='cadastro.php';
                        alert('Erro');
                    </script>";
            }
        }
    }
}
