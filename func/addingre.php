<?php
    include("../connect/liga.php");
    session_start();
    // if(isset($_SESSION['username'])) {
    // echo "Your session is running <br>" . $_SESSION['username'];
    // }else{ echo "Não foi possivel obter a sua sessão.";}
$msg;
try {
    if(isset($_POST["ingrediente"]) && isset($_POST["quantidade"])){
        $user = $_SESSION["username"];
        $ingre = $_POST['ingrediente'];
        $quantidade = $_POST["quantidade"];
        $custo = $_POST["custo"];
        if($quantidade>0 && $quantidade !== ""){
            $checkQuantidade = 1;
         }else{
            $checkQuantidade = 0;
         }
        $new_ingre_query = "INSERT INTO 
                        `lista`(`ingredientes`, `quantidade`, `data`, `username`, `FlagStock`,`custo`) 
                        VALUES ( ?, ?,DEFAULT,?,?,?);";
        // adaptação de variaveis
        $insert = $pdo-> prepare ($new_ingre_query);
        $insert -> execute([$ingre,$quantidade,$user,$checkQuantidade,$custo]);
            $_SESSION['message'] = "Os seu ingredientes foram adicionados";
            $_SESSION['msg_type'] = 'success';
            $sql= "select * from lista where username =:username order by id_compra desc;";
            $stmt= $pdo->prepare($sql);
            $stmt->execute(["username"=>$user]);
            $ingred = $stmt->fetch();
            $msg = array(
                "user"=>$user,
                 "ingrediente"=>$ingred['ingredientes'],
                 "quantidade"=>$ingred['quantidade'],
                  "custo"=>$ingred['custo'],
                  "Stock"=>$ingred['FlagStock'],
                  "id_compra"=>$ingred['id_compra'],
                   "data"=>$ingred['data']);
            echo json_encode($msg);

            }else  json_encode("erro");
} catch (PDOException $e) {
    $msg=array("msg"=>$e->getMessage());
}

?>