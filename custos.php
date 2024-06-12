<!-- CHECK SESSION -->
<?php
    include("connect/liga.php");
    session_start();
    $user = $_SESSION["username"];
    if(!isset($_SESSION['username'])){ //verifica se existe sessão
        
        echo   "<div class='container'>
                   <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                       <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                           <span aria-hidden='true'>&times;</span>
                       </button>
                       <strong>Precisa de fazer primeiro o login <a href='login.html'>Login</a> </strong>
                   </div>
                </div> ";
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
    <div class='container'>
        <div id="mensagens" class="alert alert-<?=$_SESSION['msg_type']?>">
            <?php 
                                echo $_SESSION['message'];
                                unset ($_SESSION['message']);    
                            ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
        </div>
    </div>
    <?php endif ?>
    <div id="menu"></div>
    <?php if(isset($_SESSION['username'])){?>
    <div class="container">
        <h3 style="text-align: center; margin-bottom: 20px;">Custos totais</h3>
        <table class="table table-dark" style="text-align: center;" id="table">
            <thead class="thead-inverse">
                <tr>
                    <th>Ingrediente</th>
                    <th>Data de aquisição</th>
                    <th>Custo total</th>
                    <th>Flag</th>
                    <th>Actualizar</th>
                </tr>
            </thead>
            <a class='"btn btn-warning"' href='"emfalta.php"'>Veja o que falta</a>
            <tbody id=tb>
                <?php
                        $user = $_SESSION["username"];
                        json_encode($user);     
                        // Imprimir os ingredientes na tabela
                        $sql = "SELECT * FROM lista where username = '".$user."'";
                        $result = $pdo->query($sql);
                        while($row = $result->fetch()) {
                            echo 
                                "<tr class=".existe($row["quantidade"]).">".
                                    "<td>".$row["ingredientes"]."</td>" .
                                    "<td>".$row["data"]."</td>" .
                                    "<td>".total($row["quantidade"],$row["custo"])."</td>"
                                    ."<td>".verified($row["quantidade"])."</td>" .
                                    "<td>"."<button type='button' class='btn btn-primary'
                            name='change'>
                            Actualizar Ingredientes</button>"."</td>".
                                "</tr>";
                        }
                        // Imprimir os ingredientes na tabela
                        $sql = "SELECT count(ingredientes) as Tingredientes, quantidade, sum(custo * quantidade) as Custototal FROM lista where username = '".$user."'";
                        $total = $pdo->query($sql);
                        $row = $total->fetch();
                       // execute the stored procedure
                            $sql = 'CALL MediaGastos(1);';
                            // call the stored procedure
                            $q = $pdo->query($sql);
                            $q->setFetchMode(PDO::FETCH_ASSOC);
                            $media = $q->fetch();
                        echo
                        "<tr>
                            <th>Total de ingredientes</th>
                            <th>Data</th>
                            <th>Despesa Total</th>
                            <th>Media de gastos</th>
                            <th>Ingredientes em falta</th>
                        </tr>    
                        <tr class='table-info' >".
                            "<td>".$row["Tingredientes"]."</td>" .
                            "<td>".date("Y-m-d")."</td>" .
                            "<td>".$row["Custototal"]."€"."</td>".
                            "<td>".$media["media"]."</td>".
                            "<td><a class='btn btn-warning' href='emfalta.php'>Veja o que falta</a> </td>".
                        "</tr>";
                        
                    ?>

            </tbody>
        </table>
        <div id="alterar"></div>
        <?php } ?>
        <!--Functions php-->
        <?php 
        function existe($stock){
            
            if($stock != 0 && $stock != NULL){ return "table-success";}else{ return "table-danger";}
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
        <script src="jquerypicker/jquery-ui.js"></script>
        <script src="js/main.js"></script>
        <script>
        $("#menu").load("divs/menu.php");
        $("#inserir").load("divs/inserir.php");
        $("#alterar").load("divs/alterar.php");
        $(document).ready(function() {
            $("[name='change']").click(function(evt) { //botão modificar
                evt = evt ? evt : window.event;
                window.document.getElementById('change').style.display = 'block';
                $("[name='change']").click(function(evt) { //botão modificar
                    evt = evt ? evt : window.event;
                    window.document.getElementById('change').style.display = 'block';

                    $.ajax({
                        url: "func/changeingre.php",
                        type: 'post',
                        dataType: json,
                        data: {
                            ingredientes: evt.target.id
                        }, //Aqui vai receber o id da função delete
                        success: function(dados) {
                            window.alert(evt.target.id);
                            console.log(dados);
                            console.log(dados.msg);
                        },
                        error: function() {
                            json_encode("Erro");
                        }
                    });
                });
            });
        });
        </script>
</body>

</html>