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
            $username = $_SESSION["username"];
            $stmt = $pdo->prepare("SELECT foto FROM users WHERE username=?");
            $stmt->execute([$username]); 
            $foto = $stmt->fetch();
            if($foto){$fotoUser = $foto["foto"];}
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
    <title>ListaDeIngredientes</title>
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

    <div class="container" style="margin-top: -55px;">
        <div class="row">
            <!-- Verificação de conect -->
            <?php if(isset($_SESSION['username'])){?>
            <!-- Id card utilizador -->
            <div class="col col-xs-12 col-md-4">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="imagens/<?php validaFoto($fotoUser);?>" alt="User image">
                    <div class="card-body">
                        <h5 class="card-title" style="text-align: center;color:#fcaa1a;"><b><?php echo $username;?></b>
                        </h5>
                        <p class="card-text">Esta é a sua lista de compras aqui poderar partilhar com os seus familiares
                            de forma a ter uma lista de ingredientes partilhada por todos</p>
                        <a href="mercado.php" class="btn btn-primary">Adicionar
                            ingredientes</a>
                    </div>
                </div>
            </div>
            <div class="col col-xs-12 col-md-8">
                <!-- Tabela de ingredientes -->
                <table class="table table-dark" id="table">
                    <thead>
                        <tr>
                            <th>Nome Usuario</th>
                            <th>Ingredientes</th>
                            <th>Quantidade</th>
                            <th>Custo total</th>
                            <th>Data de aquisição</th>
                            <th>Flag Stock</th>
                            <th>Comandos</th>
                        </tr>
                    </thead>
                    <tbody" id="tb">
                        <?php
                            $user = $_SESSION["username"];
                            json_encode($user);     
                            // Imprimir os ingredientes na tabela
                            $sql = "SELECT * FROM lista where username = '".$user."'";
                            $result = $pdo->query($sql);
                            while($row = $result->fetch()) {
                                echo 
                                    "<tr>
                                        <td>".$row["username"]."</td>".
                                        "<td>".$row["ingredientes"]."</td>" .
                                        "<td>".$quantidade = $row["quantidade"]."</td>" .
                                        "<td>".total($row["quantidade"],$row["custo"])."</td>" .
                                        "<td>".$row["data"]."</td>".
                                        "<td>".verified($row["quantidade"]). "</td>".
                                        "<td>".del($row["id_compra"])
                                            .change($row["ingredientes"])."</td>".
                                    "</tr>";
                            }
                        ?>
                        </tbody>
                </table>
                <!-- Butões CRUD -->
                <div class="container" id="CRUD" method="post">
                    <!-- //Botão de adicionar  -->
                    <button type="button" onclick="document.getElementById('insert').style.display='block'"
                        class="btn btn-success"> Adicionar</button>
                    <!-- inserrir html -->
                    <div id="insert" class="modal">
                        <form class="modal-content animate" enctype="application/x-www-form-urlencoded" id="frm"
                            name="form_insert" method="post">
                            <div class="imgcontainer">
                                <span onclick="document.getElementById('insert').style.display='none'" class="close"
                                    title="Close Modal">&times;</span>
                                <img src="imagens/avatar.jpg" alt="Avatar" class="avatar">
                            </div>

                            <div class="container">
                                <label for="ingrediente"><b>Ingrediente</b><br></label>
                                <input type="text" placeholder="ingrediente" name="ingrediente" required>
                                <label for="quantidade"><b>Quantidade</b><br></label>
                                <input type="number" required name="quantidade">
                                <label for="custo"><b>Custo:</b></label>
                                <input type="number" required name="custo" placeholder="Preço unitario">€

                                <button type="submit" id="insert_btn">Inserir</button>
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
        <?php } ?>
    </div>
    <!-- <h3 style="text-align: center; margin-bottom: 20px;">
            <?php echo " <b>Lista de ingredientes do ".$username." </b>"  ;?>
        </h3> -->
    <!--Functions php-->
    <?php 
        //função para foto default
        function validaFoto($fotoUser){
            if(isset($fotoUser)){
                echo $fotoUser;
            }else{
                echo "avatar.jpg";
            }
        }
        function del($id){
            return "<a name='del' 
            data-id_compra='".$id."'
            style='margin-right:5px;'
            class='btn btn-danger'
            id='".$id."'>Delete</a>";
                    }
        function verified($check){ //verifica se existe ou não stcok 
            if( $check > 0 && $check != null ){   
                return $flag = "&#10004;";
            }else{
                return $flag = "&#x2717;";
            }
         }
         function total($quantidade, $custo){ // criar o total mas tentar fazer trigger para sql
                $total = $quantidade*$custo;
                return $total."€";
         }
        function change($id){ //Criação de botão para alterar nos comandos
            return 
                "<a 
                data-ingredientes='".$id."' 
                name='change'
                method='POST'
                class= 'btn btn-warning'
                id='".$id."'
                >Alterar</a>";
           }
    ?>

    <!-- imports -->
    <script src="js/jquery-3.6.0.js"></script>
    <script src="jquerypicker/jquery-ui.js"></script>
    <script src="js/main.js"></script>
    <script>
    $(document).ready(function() {
        $("#menu").load("divs/menu.php");
        $("#inserir").load("divs/inserir.php");
        $("#alterar").load("divs/alterar.php");
        //Eliminar ingrediente com confirmação
        function change(id) {
            return "<a data-ingredientes='" + id +
                "' name='change' method='POST'class= 'btn btn-warning'id='" +
                id +
                "'>Alterar</a>";
        }
        $("#insert_btn").click(function(evt) { //botão adicionar ingrediente
            evt = evt ? evt : window.event;
            event.preventDefault();
            var frm = document.getElementById("frm");
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
                    console.log("conseguiste");
                    var linha = "<tr> <td>" + data.user +
                        "</td> <td>" + data.ingrediente +
                        "</td><td>" + data.quantidade +
                        "</td><td>" + data.custo + "€" +
                        "</td><td>" + data.data +
                        "</td><td>" + data.Stock +
                        "</td><td> <a name='del' data-id_compra=" + data
                        .id_compra +
                        " style='margin-right:5px;'class='btn btn-danger'id='" + data
                        .id_compra + "'>Delete</a> <a data-ingredientes='" + data
                        .id_compra +
                        "' name='change' method='POST'class= 'btn btn-warning'id='" +
                        data
                        .id_compra +
                        "'>Alterar</a>" +
                        "</td></tr>";
                    $("#table").append(linha);
                    init();
                    // chamar a função para que sempre que seja criada uma nova linha seja possivel apagar
                    modal.style.display = "none";
                    document.getElementById("mensagens").innerHTML = content;
                },
                error: function(err) {
                    alert("esse ingrediente já existe");
                    console.log("Não conseguiste");
                    console.log(err);
                }
            });
        });
        init();


        function init() { //Função a agregar a cada linha criada
            $("[name='del']").click(function(evt) {
                evt = evt ? evt : window.event;
                id_compra_q = evt.target.id
                if (!confirm("Quer Apagar " + id_compra_q + "?")) return;
                $.ajax({
                    url: 'func/deleteingre.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id_compra: id_compra_q
                    },
                    success: function() {
                        console.log("conseguiste - delete")
                        $(evt.target).closest("tr").remove();
                    },
                    error: function(dados) {
                        console.log("não conseguiste - delete")
                        $(evt.target).closest("tr").remove();
                        //falta resolver erro no php
                        console.log(dados);
                    }

                });
            });
        }
    });
    </script>
</body>

</html>