<?php


    session_start();

    if(!isset($_SESSION['logado'])){
        header("location: login.php");
    }

    if($_SESSION['permissao']==1){
        header("location: redirect.php");
    }
?>
<html lang="pt-br">
<!------BY BRUNO VASCONCELLOS - VIP DESENVOLVIMENTO------->
<head>
    <title>Importar</title>
    <meta charset="iso-8859-1">
    <script src="jquery-3.2.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="icon" type="icon" href="img/csv-logo.png">
</head>
<body>
    <table align="center" width="100%" style="background-color: #150a50" border="0">
        <tr>
            <td align="right" style="width: 46%">
                <a href="index2.php">
                    <img src="img/vip-white.png" width="100%" style="max-width: 200px">
                </a>
            </td>
            <td>
                <font style="font-weight: bold; font-size: 24px; font-family: Verdana; color: white">CSV</font>
            </td>
        </tr>
    </table>
    <div style="position: absolute; right: 2px; top: 2px;" onclick="sair()">
        <img src="img/sairr.png" width="60px" title='Sair'>
    </div>
    <script>
        function sair(){
            var op = confirm("Deseja realmente sair?");
            if(op){
                location.href = 'logout.php';
            }
        }
    </script>
<div class="container" style="margin-top: 50px; border: 1px solid black">
    <label>Formato do CSV:</label>
    <table class="table-hover table">
        <tr>
            <td>
                coluna 1
            </td>
            <td>
                coluna 2
            </td>
            <td>
                coluna 3
            </td>
            <td>
                coluna 4
            </td>
            <td>
                coluna 5
            </td>
            <td>
                coluna 6
            </td>
            <td>
                coluna 7
            </td>
        </tr>
        <tr>
            <td>
                CEP
            </td>
            <td>
                endereço
            </td>
            <td>
                Bairro
            </td>
            <td>
                Cidade
            </td>
            <td>
                Base
            </td>
            <td>
                Técnologia
            </td>
            <td>
                Velocidades
            </td>
        </tr>
        <tr>
            <td title="Caso a rua não tenha cep, no lugar coloque 'SEM CEP' ">
                09999-999 ou SEM CEP
            </td>
            <td>
                rua Matriz
            </td>
            <td>
                Matriz
            </td>
            <td>
                Mauá
            </td>
            <td>
                Mauá
            </td>
            <td>
                FTTC
            </td>
            <td title=" separar cada velocidade por '/' e a ultima velocidade colocar 'MB' ">
                8 / 12 / 20MB
            </td>
        </tr>
    </table>
    <label class="p-2 bd-highlight">Selecione o arquivo CSV</label> 
    <form action="" method="post" name="uploadCSV" enctype="multipart/form-data">
        <input type="file" name="file" id="file" class="form-control-file form-control-sm" accept=".csv .txt .stt">
        <br>
        <select name="tipo" class="form-control-sm" required>
            <option value="">--TIPO--</option>
            <option value="casa" >Casa</option>
            <option value="Predio">Predio</option>
        </select>
        <br>
        <br>
        <button type="submit" id="submit" name="import" class="btn btn-secondary">Importar</button>
    </form>

    <?php
        require 'connect.php';
        header("Content-type: text/html; charset=UTF-8");
        if(isset($_POST["import"])) {
            //////////////////////
            $tipo = $_POST['tipo'];
            $fileName = $_FILES["file"]["tmp_name"];
            echo $_FILES["file"]["tmp_name"];
            if ($_FILES["file"]["size"] > 0) {
                
                $handle = @fopen($fileName, "r");
                echo $handle;
                    if ($handle) {
                        while ($line = fgetcsv($handle, 5000, ";")) {
                            $column = array_map("utf8_encode", $line);
                            $linhas =0;
                            if($column[0] != "" and $column[1] != ""){
                                if($column[0] != "SEM CEP"){
                                    $query1 = "SELECT cep, logradouro FROM ".$tipo." where cep = '".$column[0]."' ";
                                    $outpt = mysqli_query($connection, $query1);
                                    $linhas = mysqli_num_rows($outpt);
                                }
                                if($linhas == 0){
                                    $query = "INSERT INTO ".$tipo ." (cep, logradouro, bairro, cidade, base, tecnologia, velocidade) values('".$column[0]."','".$column[1]."','".$column[2]."','".$column[3]."','".$column[4]."','".$column[5]."','".$column[6]."') ";
                                    $result = mysqli_query($connection, $query);
                                    echo $column[0]." Inserido! <br>";
                                }else{
                                    $outpt->data_seek(0);
                                    $row = $outpt->fetch_assoc();
                                    if($column[1] == $row['logradouro']){
                                        //echo $column[1]." = ".$row['logradouro']." <br>";
                                    }else{
                                        $query = "UPDATE ".$tipo." set logradouro ='".$column[1]."', bairro ='".$column[2]."', cidade ='".$column[3]."', base ='".$column[4]."', tecnologia ='".$column[5]."', velocidade ='".$column[6]."' where  cep = '".$column[0]."' ";
                                        $result = mysqli_query($connection, $query);
                                        echo $column[0]." Atualizado! <br>";
                                    }
                                }
                            }

                        

                        }
                        echo "<script>alert('Importação concluida');</script>";
                    }

        fclose($handle);
            }
        }
    ?>
</div>
</body>
</html>