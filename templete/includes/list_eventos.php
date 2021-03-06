<?php
/*
 * @author Cesar Szpak - Celke - cesar@celke.com.br
 * @pagina desenvolvida usando FullCalendar,
 * o código é aberto e o uso é free,
 * porém lembre-se de conceder os créditos ao desenvolvedor.
 */

include '../config/conexao.php';
$select = "SELECT id, title, color, start, end FROM eventos";
try{
    $result = $conect->prepare($select);
    $result->execute();
    $contar = $result-> rowCount();
    $eventos = [];
    if($contar>0){
        while($row_events = $result->fetch(PDO::FETCH_ASSOC)){
            $id = $row_events['id'];
            $title = $row_events['title'];
            $color = $row_events['color'];
            $start = $row_events['start'];
            $end = $row_events['end'];
            
            $eventos[] = [
                'id' => $id, 
                'title' => $title, 
                'color' => $color, 
                'start' => $start, 
                'end' => $end, 
                ];
        }
    }else{
        echo '<div class="alert alert-danger" role="alert">Não há dados!</div>';
    }
}catch(PDOException $e){
    echo "<b>ERRO DE PDO = </b>".$e->getMessage();
}

echo json_encode($eventos);