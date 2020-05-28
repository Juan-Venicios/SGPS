<?php
  ob_start();//Inicia o cache para a sessão
  session_start();//Inicia a sessão da página(login)
  if (!isset($_SESSION['loginUser']) && (!isset($_SESSION['senhaUser']) && (isset($_SESSION['status'])))){
      header("Location: index.php?acao=negado");
      exit;//Oculta todo o código abaixo quando existe erro
  }
 /* include_once('sair.php');*/
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Material Dashboard by Creative Tim
  </title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="assets/demo/demo.css" rel="stylesheet" />
  <link href="assets/css/bootstrap-toggle.min.css" rel="stylesheet">
</head>

<body class="">
  <?php
        include_once('config/conexao.php');
        $userEmail = $_SESSION['loginUser'];
        $senhaUser = $_SESSION['senhaUser'];
        $select = "SELECT * FROM tb_admin WHERE email=:emailUser AND senha=:senhaUser";
        try {
            $resultado = $conect->prepare($select);
            $resultado->bindParam(':emailUser',$userEmail,PDO::PARAM_STR);
            $resultado->bindParam(':senhaUser',$senhaUser,PDO::PARAM_STR);
            $resultado->execute();
            //conta registro
            $contar = $resultado->rowCount();
            if($contar > 0){
                while ($show = $resultado->FETCH(PDO::FETCH_OBJ)) {
                    $id_admin = $show->id_admin;
                    $nome = $show->nome;
                    $email = $show->email;
                    $senha = $show->senha;
                    $turma = $show->turma;
                    $status = $show->status;
                }
            }else{
                header("Location: ?sair");
            }    
        }catch(PDOException $e){
            echo "<b>ERRO DE PDO NO SELECT: </b>".$e->getMessage();
        }
    ?>
  <div class="wrapper ">
    <div class="sidebar" data-color="green" data-background-color="white" data-image="assets/img/img-1.jfif">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
      <div class="logo"><a href="http://www.creative-tim.com" class="simple-text logo-normal">
      <img src="assets/img/Projeto.png" alt="">
        </a></div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item ">
            <a class="nav-link" href="home.php?acao=frequencia">
              <i class="material-icons">person</i>
              <p>Frequência</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="home.php?acao=turmas">
              <i class="material-icons">content_paste</i>
              <p>Turmas</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="home.php?acao=conteudo">
            <i class="material-icons">library_books</i>
              <p>Tarefas</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="home.php?acao=calendar">
              <i class="material-icons">location_ons</i>
              <p>Calendário</p>
            </a>
          </li>
        </ul>
      </div>
    </div>