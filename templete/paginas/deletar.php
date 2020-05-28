<?php
include_once('../config/conexao.php');
if(isset($_GET['deletar'])){
    $id= $_GET['deletar'];
    $delete = "DELETE FROM eventos WHERE id=:id";
    try{
        $result = $conect->prepare($delete);
        $result->bindParam(':id',$id,PDO::PARAM_INT);
        $result->execute();
        $contar=$result->rowCount();
        if ($contar>0){
            header("Location: ../home.php?acao=calendar");
        }else{
            header("Location: ../home.php?acao=calendar");
        }
    }catch(PDOException $e){
        echo "<b>ERRO DE DELETE: </b>".$e->getMessage();
    }
}