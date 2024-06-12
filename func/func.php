<?php
        $msg;
        require("../connect/liga.php"); 
        function CheckConection(){
            switch (connection_status())
            {
            case CONNECTION_NORMAL:
            $txt = 'Connection is in a normal state';
            break;
            case CONNECTION_ABORTED:
            $txt = 'Connection aborted';
            break;
            case CONNECTION_TIMEOUT:
            $txt = 'Connection timed out';
            break;
            case (CONNECTION_ABORTED & CONNECTION_TIMEOUT):
            $txt = 'Connection aborted and timed out';
            break;
            default:
            $txt = 'Unknown';
            break;
        } echo $txt;
        }      
        
        if (isset($_POST["register_btn"])) {// Registo
            if (validaDadosRegisto()) {
                // confirmação de passwoards 
                if ($_POST["pass"] == $_POST["c_pass"]) {

                    $username = $_POST["username"];
                    $email = $_POST["email"];
                    $nif = $_POST["nif"];
                    $pass = password_hash($_POST["pass"], PASSWORD_BCRYPT);
                    $parentesco = $_POST["id_familia"];

                    //verificar se o user existe
                    $stmt = $pdo->prepare("SELECT * FROM users WHERE username=?");
                    $stmt->execute([$username]); 
                    $user = $stmt->fetch();

                    //Parte de carregar imagem
                    $target_dir = "C:\\Users\\alexa\\Desktop\\Lucas\\xamp\\htdocs\\treino\\imagens\\";
                    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                    // Check if image file is a actual image or fake image
                    if(isset($_POST["submit"])) {
                    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                    if($check !== false) {
                        echo "File is an image - " . $check["mime"] . ".";
                        $uploadOk = 1;
                    } else {
                        echo "File is not an image.";
                        $uploadOk = 0;
                    }
                    }

                    // Check if file already exists
                    if (file_exists($target_file)) {
                    echo "Sorry, file already exists.";
                    $uploadOk = 0;
                    }

                    // Check file size
                    if ($_FILES["fileToUpload"]["size"] > 500000) {
                    echo "Sorry, your file is too large.";
                    $uploadOk = 0;
                    }

                    // Allow certain file formats
                    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif" ) {
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                    }

                    // Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == 0) {
                    echo "Sorry, your file was not uploaded.";
                    // if everything is ok, try to upload file
                    } else {
                        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                            $foto = htmlspecialchars( basename( $_FILES["fileToUpload"]["name"]));
                            echo "The file ". $foto. " has been uploaded.";
                        } else {
                            echo "Sorry, there was an error uploading your file.";
                        }
                    }
                    if($user){
                        echo " O seu username já se encontra registado, faça um registo diferente <br><a href='regist.php'>Registo </a>";
                    }else{
                        $new_user = " INSERT INTO `users`(`username`,`email`,`nif`,`passwoard`,`id_familia`,`foto`)  values (?,?,?,?,?,?)" ;
                        $stmt = $pdo->prepare($new_user)-> execute([ $username, $email, $nif, $pass, $parentesco,$foto]); 

                        if ($stmt) {
                            echo $username." foi registado com susesso! <br><a href='../ControlAcess/login.html'>Login</a>";
                                                        
                        } else {
                            echo "O registo falhou <br><a href='../ControlAcess/regist.php'>Registo </a>";
                        }
                    }
  
                } else {
                    echo "Passwords Mismatch <br><a href='../ControlAcess/regist.php'>Registo </a>";
                 } 
            }else{
                echo "Falhou algo na validação de registo   <br><a href='../ControlAcess/regist.php'>Registo </a>";
            } 
}


// Validação dos registos
function validaDadosRegisto(){
if (

isset($_POST["username"])
&& isset($_POST["pass"])
&& isset($_POST["email"])
&& isset($_POST["nif"])
&& isset($_POST["c_pass"])
&& isset($_POST["id_familia"])
) {
return true;
} else {
echo ("falho algo na validação de registo");
}
}
if(isset($_POST["login_btn"])){// Login
if (isset($_POST["username"]) && isset($_POST["pass"])) {
$username = $_POST['username'];
//Procurar se o user exite
$login_user = "SELECT * FROM `users` WHERE `username`=?;";
$result = $pdo->prepare($login_user);
$result -> execute([$username]);
if ($result){
$row = $result->fetch();
if (isset($row)) {
$hash_pass = $row["passwoard"];
if (password_verify($_POST["pass"], $hash_pass)) {
$_SESSION["username"] = $row["username"];
session_start();
$_SESSION['username'] = $username;
$_SESSION['message'] = "Bem vindo de volta '".$username."' ";
$_SESSION['msg_type'] = 'success';
header("location: ../index.php");
} else
echo "1) Username/passwoard errados <br><a href='../ControlAcess/login.html'><img src='../imagens/back.jpg' /></a>" ;
} else {
echo "2) Username/passwoard errados <br><a href='../ControlAcess/login.html'> <img src='../imagens/back.jpg' /> </a>";
}
}else{
echo "3) Username/passwoard errados <br><a href='../ControlAcess/login.html'> <img src='../imagens/back.jpg' /> </a>";
}
} else {
echo "4) An error occured.<a href='../login.html'> <img src='../ControlAcess//imagens/back.jpg' /> </a>";
}
}


?>