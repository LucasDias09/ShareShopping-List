</html>

<?php
 session_start();
   if(isset($_SESSION['username'])){
$user_session_php = true; echo $user_session_php;
}else{
    $user_session_php = 0 ; echo $user_session_php;
} 

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
    <title>Index</title>
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
    <!-- Menu -->
    <div id="menu"></div>
    <div class="container">
        <form action=" mailto:emailid@example.com" method="post" enctype="text/plain">

            <label for=" fname">First Name</label>
            <input type="text" id="fname" name="firstname" placeholder="Your name..">

            <label for="lname">Last Name</label>
            <input type="text" id="lname" name="lastname" placeholder="Your last name..">

            <label for="country">Country</label>
            <select id="country" name="country">
                <option value="australia">Australia</option>
                <option value="canada">Canada</option>
                <option value="usa">USA</option>
            </select>

            <label for="subject">Subject</label>
            <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>

            <input type="submit" value="Submit">

        </form>
    </div>
    <!-- imports -->
    <script src="js/jquery-3.6.0.js"></script>
    <script src="jquerypicker/jquery-ui.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.js.map"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="js/main.js"></script>
    <script>
    $("#menu").load("divs/menu.php")
    </script>
</body>

</html>