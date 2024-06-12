<?php
$erro = "Ocorreu um erro";
//include("../connect/liga.php");
   // session_start();
    // if(isset($_SESSION['username'])) {
    // echo "Your session is running <br>" . $_SESSION['username'];
    // }

    $msg;
if(isset($_POST['Newingredientes']) && isset($_POST['quantidade']) && isset($_POST['custo']) && isset($_POST['OldIngredint'])){
  if((is_numeric($_POST['quantidade']) && is_numeric($_POST['custo']))){
    include("../connect/liga.php");
    session_start();
    $ingre = $_POST['OldIngredint'];
    $Newingre = $_POST['Newingredientes'];
    $quantidade= $_POST['quantidade'];
    $sql = " UPDATE `lista` SET
        `ingredientes`= '".$Newingre."',
        `data`=DEFAULT,
        `FlagStock`= 1,
        `quantidade`='".$quantidade."' 
        WHERE ingredientes='".$ingre."'";
        $del = $pdo->query($sql);
      $_SESSION['message'] = "O seu ingrediente ".$ingre." foi alterado para ".$Newingre;
      $_SESSION['msg_type'] = 'warning';
      $sql ="SELECT LAST_INSERT_ID();";
      $stmt=$pdo->prepare($sql);
      $stmt->execute();
      $id= $stmt->fetchColumn();
      $sql= "select * from lista where ingredientes =:ingredientes;";
      $stmt= $pdo->prepare($sql);
      $stmt->execute(["ingredientes"=>$Newingre]);
      $ingrediente = $stmt->fetch();
      //Enviar os dados para o cliente do ultimo id
      $alteracao = array(
        "ingrediente"=>$ingrediente['ingredientes'],
        "quantidade"=>$ingrediente['quantidade'],
         "custo"=>$ingrediente['custo'],
         "Stock"=>$ingrediente['FlagStock'],
         "id_compra"=>$ingrediente['id_compra'],
          "data"=>$ingrediente['data']
      );
      echo json_encode($alteracao);
  }
      

} else {
echo json_encode($erro);
}

?>