<?php 
include("../connect/liga.php");
session_start();  
$stmt = $pdo->prepare("select * from users where username=:username;");
        $stmt->execute(["username"=>$username]);
        $cliente = $stmt->fetch(PDO::FETCH_ASSOC); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="css/css.css" />
    <link rel="stylesheet" href="jquerypicker/jquery-ui.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <title>Regist</title>
</head>

<body>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-success" id="trigger_regist_btn" data-bs-toggle="modal"
        data-bs-target="#regist">
        Regist
    </button>
    <!-- Modal -->
    <div class="modal fade" id="regist" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <center>
                        <img src="../imagens/avatar.jpg" alt="avatar" sizes="50px" srcset="">
                    </center>
                    <form class="col-12" method="POST" enctype="multipart/form-data" action="../func/func.php">
                        <div class="form-group">
                            <!-- username -->
                            <label for="username">Nome:</label>
                            <input type="text" class="form-control" name="username" placeholder="Nome" id="username"
                                required>
                            <!-- lastname -->
                            <label for="id_familia">Ultimo name</label>
                            <input type="text" class="form-control" name="id_familia" id="id_familia"
                                placeholder="Last name" required>
                            <!-- nif -->
                            <label for="nif">NIF</label>
                            <input type="number" class="form-control" id="nif" placeholder="Digite o seu nif" name="nif"
                                required>
                            <!-- email -->
                            <label for="form-control">Email</label>
                            <input class="form-control" type="email" name="email" id="email"
                                placeholder="email@hotmail.com" require>
                        </div>

                        <!-- Password -->
                        <div class="form-group">
                            <label for="pass">Password</label>
                            <input class="form-control" type="password" id="pass" placeholder="Digite o seu password"
                                name="pass" required>
                            <label for="pass">Confirme password</label>
                            <input class="form-control" type="password" id="c_pass"
                                placeholder=" Confirme a sua password" name="c_pass" required>
                        </div>
                        <!-- terms and conditions -->
                        <div class="form-group">
                            <label for=""><b>Foto de perfil</b></label>
                            <input type="file" name="fileToUpload" id="fileToUpload">
                            <input type="submit" value="Upload Image" name="submit">
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                                <label class="form-check-label" for="invalidCheck">
                                    Agree to terms and conditions
                                </label>
                                <div class="invalid-feedback">
                                    You must agree before submitting.
                                </div>
                            </div>
                        </div>
                        <!-- submit -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="register_btn" id="register_btn"
                                class="btn btn-primary">Registar</button>
                        </div>

                    </form>
                </div>
            </div>


        </div>
    </div>
    </div>
    </div>

    <!-- imports -->
    <script src="js/jquery-3.6.0.js"></script>
    <script src="js/bootstrap.js.map"></script>
    <script src="js/bootstrap.js"></script>
    <script src="jquerypicker/jquery-ui.js"></script>
    <script src="js/main.js"></script>

    <script>
    $("#modalregist").load("ControlAcess/regist.php")
    </script>
</body>

</html>