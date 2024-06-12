<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="jquerypicker/jquery-ui.css" />
    <link rel="stylesheet" href="css/css.css" />
    <title>Alterar</title>
</head>

<body>
    <div id="change_modal" class="modal">
        <form class="modal-content animate" method="post" id="frmchange">
            <div class="imgcontainer">
                <span onclick="document.getElementById('change_modal').style.display='none'" class="close"
                    title="Close Modal">&times;</span>
                <img src="imagens/avatar.jpg" alt="Avatar" class="Avatar">
            </div>

            <div class="container">
                <?php
                            include("../connect/liga.php");
                            session_start();
                            $user = $_SESSION["username"];
                            // Imprimir os ingredientes na tabela
                            $sql = "SELECT ingredientes FROM lista WHERE username=  '".$user."' ;";
                            $result = $pdo->query($sql);
                                // output data of each row
                                
                             ?>
                <!-- TENTATIVA-->
                <label for="OldIngredint"><b>Ingrediente a mudar:</b></label>
                <select class="form-select" aria-label="Default select example" method="post" name="OldIngredint"
                    required>
                    <?php
                    
                    while($row = $result->fetch()) {
                                // Mostrar os valores existentes na tabela
                                echo  " <option 
                                        data-ingredientes='".$row["igrendientes"].
                                        "' name='".$row["igrendientes"].
                                        "'>".$row["ingredientes"].
                                        "</option>";
                                }

                            function AddSelecet($selected){
                                return $selected["igrendientes"];
                            }
                        ?>
                </select>
                <br>
                <br>
                <label for="Newingredientes"><b>Ingrediente Novo</b></label>
                <input type="text" placeholder="Escreva aqui o seu ingrediente" name="Newingredientes" required>

                <label for="quantidade"><b>Quantidade<br></b></label>
                <input type="number" require name="quantidade" id="quantidade">
                <label for="quantidade"><b>Preço Unitario<br></b></label>
                <input type="number" require name="custo" id="custo">€
            </div>
            <div class="container" style="background-color:#f1f1f1">
                <button type="submit" name="change_btn_sumbit" id="change_btn_sumbit">alterar</button>
                <button type="button" onclick="document.getElementById('change_modal').style.display='none'"
                    class="cancelbtn">Cancel</button>

            </div>
        </form>

    </div>

    <!--Imports-->
    <!-- imports -->
    <script src="js/jquery-3.6.0.js"></script>
    <script>
    $(function() {
        var modalchange = document.getElementById('change_modal');

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
        //Alterar Ingrediente
        $("[name='change']").click(function(evt) { //botão modificar
            evt = evt ? evt : window.event;
            window.document.getElementById('change_modal').style.display = 'block';
        });
        //       $alteracao = array(["NewIngred"]=> $Newingre,["data"]=> $data,["flagstock"] => $flagstock, ["quandidade"] => $quantidade);

        $("#change_btn_sumbit").click(function(evt) { //botão adicionar
            evt = evt ? evt : window.event;
            event.preventDefault();
            var frm = document.getElementById("frmchange");
            var formdata = new FormData(frm);
            for (var item of formdata) console.log(item);
            $.ajax({
                url: 'func/changeingre.php',
                method: 'post',
                dataType: 'json',
                processData: false,
                contentType: false,
                data: formdata,
                success: function(data) {
                    $(evt.frm).closest("tr").remove();
                    console.log("conseguiste alterar o ingrediente");
                    document.getElementById('change_modal').style.display = 'none';
                    var linha = "<tr> <td>" +
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
                },
                error: function(err) {
                    console.log("Não conseguiste");
                    console.log(err);
                    window.location = document.referrer;
                }
            });
            modal.style.display = "none";
            document.getElementById("mensagens").innerHTML =
                content;
        });
    });
    </script>
</body>

</html>