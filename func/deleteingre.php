<?php
include("../connect/liga.php");
try {
    if(isset($_POST['id_compra'])){
        $id_compra = $_POST['id_compra'];
        $sql = "DELETE FROM lista WHERE id_compra=:id_compra;";
        $stmt = $pdo->prepare($sql);
        $stmt ->execute([$id_compra]);
        if ($stmt) {
          $_SESSION['message'] = "O seu ingrediente foi eliminado";
          $_SESSION['msg_type'] = 'danger';
          echo json_encode("Error deleting record: ");
        }else{
          echo json_encode("Error deleting record: ");
         }
     }else  echo json_encode("Error deleting record: ");

    } catch (PDOException $e) {
      echo json_encode("Error deleting record: ");}
   ?>