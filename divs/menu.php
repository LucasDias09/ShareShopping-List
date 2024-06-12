<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="jquerypicker/jquery-ui.css" />
    <link rel="stylesheet" href="../css/css.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>menu</title>
    <!-- <style>
    .carousel {
        display: block;
        width: 30%;
        width: 1140px;
        height: 616px;
    }
    </style> -->
</head>

<body>
    <div class="container" style="border: 3px solid;">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel" style="opacity: 90%;">
            <div class="carousel-inner ">
                <div class="carousel-item active">
                    <img src="imagens/mercado1.jpeg" class="d-block w-100" alt="1">
                </div>
                <div class="carousel-item">
                    <img src="imagens/mercado2.jpeg" class="d-block w-100" alt="2">
                </div>
                <div class="carousel-item">
                    <img src="imagens/mercado3.jpeg" class="d-block w-100" alt="3">
                </div>
                <div class="carousel-item">
                    <img src="imagens/mercado4.jpeg" class="d-block w-100" alt="4">
                </div>
                <div class="carousel-item">
                    <img src="imagens/mercado5.jpeg" class="d-block w-100" alt="4">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="index.php">Home</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="listaingredientes.php">Lista de
                                    ingredientes</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="custos.php">Custos</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Dropdown
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="emfalta.php">Ingredientes em
                                            falta</a></li>
                                    <li><a class="dropdown-item" href="mercado.php">Mercado</a></li>

                                    <li><a class="dropdown-item" href="contactos.php">Contactos</a></li>
                                </ul>
                            </li>
                            <li>
                                <ul>
                                    <form class="d-flex" method="GET"
                                        action="https://www.google.pt/search?q=<?php if(isset($_GET["search"])){echo($_GET["search"]);}?>">
                                        <input class="form-control me-2" type="search" id="search_input"
                                            placeholder="Search" aria-label="Search" require>
                                        <button class="btn btn-primary" id="search" type="submit">Search</button>
                                    </form>
                                </ul>
                            </li>
                            <li>
                                <ul>
                                    <button type="button" class="btn btn-danger" id="trigger_logout_btn"
                                        data-bs-toggle="modal" data-bs-target="#logout" style="margin-left:6px;"
                                        style="float: left;">
                                        Logout
                                    </button>
                                    <div id="modalLogout"></div>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
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
    $("#modalLogout").load("ControlAcess/logout.php")
    $(".alert").alert();
    var modallogut = document.getElementById('logout');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modallogut) {
            modal.style.display = "none";
        }
    }
    </script>
</body>

</html>