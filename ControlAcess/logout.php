<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
</head>

<body>
    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="logout" name="logout tabindex" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Log Out</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="">Tem a certeza que dejesa sair?</label>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" onclick="location.href='ControlAcess/login.html'"
                            value="<?php session_unset() ;session_destroy(); ?>" data-bs-dismiss="modal">Sair</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- imports -->
    <script src="js/jquery-3.6.0.js"></script>
    <script>
    $(function() {
        var modallogut = document.getElementById('logout');

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modallogut) {
                modal.style.display = "none";
            }
        }

    });
    </script>
</body>

</html>