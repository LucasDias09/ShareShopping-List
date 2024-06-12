<?php
    include("connect/liga.php");
    session_start();
    $user = $_SESSION["username"];
    if(!isset($_SESSION['username'])){ 
        echo "Precisa de fazer primeiro o login <a href='login.html'>Login</a> ";

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
    <title>mercado</title>
</head>

<body>
    <div class="container">
        <div id="menu"></div>
        <table class="table">
            <thead>
                <tr>
                    <th>Ingrediente</th>
                    <th>Tipo de ingrediente</th>
                    <th>Localização</th>
                    <th>Mercado</th>
                    <th>Comandos</th>
                </tr>
            </thead>
            <tbody>
                <?php
                        function del($id){
                            return "<a name='del' data-idcompra='".$id."' class='btn btn-danger' id='".$id."'>Delete</a>";
                        }
                        $user = $_SESSION["username"];
                        json_encode($user);     
                        // Imprimir os ingredientes na tabela
                        $sql = "SELECT * FROM mercado";
                        $result = $pdo->query($sql);
                        while($row = $result->fetch()) {
                            $adicionar = $row["ingredMarket"];
                            echo 
                                "<tr class='table-success'>
                                    <td>".$row["ingredMarket"]."</td>".
                                    "<td>".$row["tipoingrediente"]."</td>" .
                                    "<td>". $row["localizacao"]."</td>" .
                                    "<td>".$row["tipeMarket"]."</td>".
                                    "<td>". 
                                    adicionar($adicionar)."</td>".
                                "</tr>";
                        }
                    ?>

            </tbody>
        </table>
        <!-- Butões CRUD -->
        <div class="container" id="CRUD" method="post">
            <!-- inserrir html -->
            <div id="insert" class="modal">
                <form class="modal-content animate" enctype="application/x-www-form-urlencoded" id="frm_mercado"
                    name="frm_mercado" method="post">
                    <div class="imgcontainer">
                        <span onclick="document.getElementById('insert').style.display='none'" class="close"
                            title="Close Modal">&times;</span>
                        <img src="imagens/avatar.jpg" alt="Avatar" class="avatar">
                    </div>

                    <div class="container">
                        <label for="ingrediente"><b>Ingrediente</b><br></label>
                        <input type="text" placeholder="ingrediente" name="ingrediente"
                            value="<?php echo $adicionar; ?>" required>
                        <label for="quantidade"><b>Quantidade</b><br></label>
                        <input type="number" required name="quantidade">
                        <label for="custo"><b>Custo:</b></label>
                        <input type="number" required name="custo" placeholder="Preço unitario">€

                        <button type="submit" id="mercado_btn">Adicionar</button>
                    </div>
                    <div class="container" style="background-color:#f1f1f1">
                        <button type="button" onclick="document.getElementById('insert').style.display='none'"
                            class="cancelbtn">Cancel</button>
                    </div>
                </form>
            </div>
            <!-- Get Modal -->
            <div id="inserir"></div>
            <!-- // botão info -->
            <button id="Info" type="button" class="btn btn-info"
                style="float: right; width:auto; margin:0.5%;">Info</button>
            <div id="informacao"></div>
            <div id="alterar"></div>
        </div>
    </div>
    </div>
    </div>
    <?php
    function adicionar($adicionar){ //Criação de botão para alterar nos comandos
            return 
            "<a 
            data-add='".$adicionar."' 
            name='adcionar'
            method='POST'
            class= 'btn btn-success'
            id='".$adicionar."'
            >Adicionar a sua lista</a>";
           }
    ?>
</body>
<!-- imports -->
<script src="js/jquery-3.6.0.js"></script>
<script src="jquerypicker/jquery-ui.js"></script>
<script src="js/main.js"></script>
<script>
$("#menu").load("divs/menu.php");
$("#inserir").load("divs/inserir.php");
$(document).ready(function() {
    //Eliminar ingrediente com confirmação
    function adicionar(id) {
        return "<a data-adicionar='" + id + "' name='change' method='POST'class= 'btn btn-warning'id='" +
            id +
            "'>Alterar</a>";
    }
});
$("[name='adcionar']").click(function(evt) {
    evt = evt ? evt : window.event;
    event.preventDefault();
    document.getElementById('insert').style.display = 'block';
    $("#mercado_btn").click(function(evt) {
        evt = evt ? evt : window.event;
        event.preventDefault();
        var frm = document.getElementById("frm_mercado");
        var formdata = new FormData(frm);
        for (var item of formdata) console.log(item);
        $.ajax({
            url: 'func/addingre.php',
            method: 'post',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: formdata,
            success: function(data) {
                alert("conseguiste adicionar a tua lista");
                modal.style.display = "none";
            },
            error: function(err) {
                alert("esse ingrediente já existe");
                console.log("Não conseguiste");
                console.log(err);
            }
        });
    });
});
</script>

</html>