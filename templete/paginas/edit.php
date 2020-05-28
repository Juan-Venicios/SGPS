<?php

    include_once '../config/conexao.php';
    if(isset($_POST['EditEvent'])){
        $title = trim(strip_tags($_POST['title']));
        $color = trim(strip_tags($_POST['color']));
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $data_start = str_replace('/', '-', $dados['start']);
        $data_start_conv = date("Y-m-d H:i:s", strtotime($data_start));
        $data_end = str_replace('/', '-', $dados['end']);
        $data_end_conv = date("Y-m-d H:i:s", strtotime($data_end));
        $update = "UPDATE eventos SET title=:title, color=:color, start=:start, end=:end WHERE id=:id";
        try{
            $result = $conect->prepare($update);
            $result-> bindParam(':id',$id,PDO::PARAM_INT);
            $result-> bindParam(':title',$title,PDO::PARAM_STR);
            $result-> bindParam(':color',$color,PDO::PARAM_STR);
            $result-> bindParam(':start', $data_start_conv);
            $result-> bindParam(':end', $data_end_conv);
            $result-> execute();
            $contar = $result-> rowCount();

      if ($contar > 0) {
          echo '<div class="alert alert-success" role="alert">Evento cadastrado com sucesso!</div>';
      } else {
          echo '<div class="alert alert-success" role="alert">Erro: Evento não cadastrado com sucesso!</div>';
      }
        }catch(PDOException $e){
            echo "<b>ERRO DE PDO = </b>".$e->getMessage();
        }
    }
?>