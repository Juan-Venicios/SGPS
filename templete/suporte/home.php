<?php
include_once('includes/header.php');
if(isset($_GET['acao'])){
    $acao = $_GET['acao'];
    if($acao == 'bemvindo'){
        //include da pagina principal
        include_once('../paginas/cad_aluno.php');
    }elseif ($acao == 'calendar'){
        //include da pagina evento
        include_once('../paginas/calendar.php');       
    }elseif ($acao == 'turmas'){
        //include da pagina evento
        include_once('../paginas/turmas.php');
    }elseif ($acao == 'documentacao'){
        //include da pagina evento
        include_once('../paginas/documentacao.php');        
    }elseif ($acao == 'update'){
        //include da pagina evento
        include_once('../paginas/editar.php');
    }elseif ($acao == 'perfil'){
        //include da pagina evento
        include_once('../paginas/perfil.php');
    }
}else{
    include_once('../paginas/cad_aluno.php');
}

//include_once('paginas/principal.php');