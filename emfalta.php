<?php
    include("connect/liga.php");
    session_start();

    if(!isset($_SESSION['username'])){ //verifica se existe sessão
        echo   "
            <div class='container'>
                <div class='alert alert-warning' role='alert'>
                <strong>Precisa de fazer primeiro o login <a href='ControlAcess/login.html'>Login</a> </strong>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
                </div>
                </div> ";
        }else{ 
            $user = $_SESSION["username"];
            $userImg = "avatar.jpg";
            $estex = ".jpg";
        }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="jquerypicker/jquery-ui.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/css.css" />
    <link rel="stylesheet" href="css/css1.css" />
    <link rel="stylesheet" href="css/bootstrap.css" />
    <style>
    body {
        background-image: url('imagens/fundo.jpeg');
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: 100% 100%;
    }
    </style>
    <title>Custos</title>
</head>

<body>
    <!-- Mensagens -->

    <?php if(isset($_SESSION['message'])):?>
    <div id="mensagens" class="alert alert-<?=$_SESSION['msg_type']?>">
        <?php 
                        echo $_SESSION['message'];
                        unset ($_SESSION['message']);    
                    ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
    </div>
    <?php endif ?>
    <div id="menu"></div>
    <div class="container">
        <!-- Verificação de conect -->
        <?php if(isset($_SESSION['username'])){?>
        <table class="table table-dark" id="table">
            <thead class="thead-inverse">
                <tr>
                    <th>Ingrediente em falta</th>
                    <th>Data de aquisição</th>
                    <th>Custo total</th>
                </tr>
            </thead>
            <tbody id=tb>
                <?php
                        $user = $_SESSION["username"];
                        json_encode($user);     
                        // Imprimir os ingredientes na tabela
                        $sql = "SELECT * FROM lista where username = '".$user."'";
                        $result = $pdo->query($sql);
                        
                        while($row = $result->fetch()) {
                            if($row["quantidade"] == 0 || $row["quantidade"] == NULL){
                            echo 
                                "<tr class=".existe($row["quantidade"]).">".
                                    "<td>".$row["ingredientes"]."</td>" .
                                    "<td>".$row["data"]."</td>" .
                                    "<td>".total($row["quantidade"],$row["custo"]).
                                    "<td>"
                                    .verified($row["quantidade"])."</td>" .
                                "</tr>";
                            }
                        }
                    ?>
            </tbody>
        </table>
        <!-- Verificação de conect -->
        <?php } ?>
        <!--Functions php-->
        <?php 
        function existe($stock){
            
            if($stock != 0 && $stock != NULL){ return "table-success"; }else{return "table-danger"; }
        }
        function verified($check){ //verifica se existe ou não stcok 
            if( $check > 0 ){   
                return $flag = "&#10004;" ;
            }else{

                return $flag = "&#x2717;";
                
            }
         }
         function total($quantidade, $custo){
                $total = $quantidade*$custo;
                return $total."€";
         }
    ?>




        <!-- imports -->
        <script src="js/jquery-3.6.0.js"></script>
        <script>
        $(document).ready(function() {
            $("#menu").load("divs/menu.php");
            $("#inserir").load("divs/inserir.php");
            $("#alterar").load("divs/alterar.php");
        });
        </script>
</body>

</html>