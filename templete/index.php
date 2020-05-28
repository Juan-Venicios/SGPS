<?php
ob_start(); //Inicia o cache para a sessão
session_start(); //Inicia a sessão da página(login)
if (isset($_SESSION['loginUser']) && (isset($_SESSION['senhaUser']) && (isset($_SESSION['status'])))) {
	header("Location: home.php");
	exit; //Oculta todo o código abaixo quando existe erro
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png"> 
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
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
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/datatables.min.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body data-image="assets/img/a.jpg">
	<div class="content"  style="margin-top: 10%;">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-4"></div>
					<div class="col-md-4">
						<div class="card">
							<div class="card-header card-header-primary">
								<h3 class="card-title">InforTec</h3>
								<p class="card-category">Projeto Social</p>
							</div>
							<div class="card-body">
								<form role="form" method="post">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="bmd-label-floating" for="exampleInputEmail1">E-mail:</label>
												<input type="email" class="form-control" id="email" name="email" >
											</div>
											<div class="form-group">
												<label for="senha" class="bmd-label-floating">Senha: </label>
												<input type="password" class="form-control" id="senha" name="senha">
											</div>
											<input type="hidden" name="status" value="1">
											<button type="submit" class="btn btn-success btn-lg" name="login">Logar no Sistema</button> 
											<a type="button" href="paginas/cadastro.php" class="btn btn-danger btn-lg" name="castrar">Cadastrar-se</a>
										</div>
									</div>
								</form>
								<?php
									include_once('config/conexao.php');
									if (isset($_GET['acao'])) {
										if (!isset($_POST['login'])){
											$acao = $_GET['acao'];
											if ($acao == 'negado') {
											echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button><strong>Erro ao Acessar o sistema!</strong> Efetue o login ;(</div>';
										}elseif ($acao == 'sair') {
											echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><strong>Volte sempre!</strong> esperamos o seu login ;(</div>';
										}
										}
									}
										if (isset($_POST['login'])){
										$login = filter_input(INPUT_POST, 'email', FILTER_DEFAULT);
										$senha = base64_encode(filter_input(INPUT_POST, 'senha', FILTER_DEFAULT));
										$status = filter_input(INPUT_POST, 'status', FILTER_DEFAULT);
										$select = "SELECT * FROM tb_admin WHERE email=:emailLogin AND senha=:senhaLogin AND status=:status";

										try {
										$resultLogin = $conect->prepare($select);
										$resultLogin->bindParam(':emailLogin',$login, PDO::PARAM_STR);
										$resultLogin->bindParam(':senhaLogin',$senha, PDO::PARAM_STR);
										$resultLogin->bindParam(':status',$status, PDO::PARAM_INT);
										$resultLogin->execute();

										$verificar = $resultLogin->rowCount();
										if ($verificar > 0) {
											$login = $_POST['email'];
											$senha = base64_encode($_POST['senha']);
											$status = $_POST['status'];
											//CRIANDO A SESSÃO DE LOGIN E SENHA
											$_SESSION['loginUser'] = $login;
											$_SESSION['senhaUser'] = $senha;
											$_SESSION['status'] = $status;

											echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><strong>Logado com sucesso!</strong> Redirecionando para o sistema :)</div>';
										
													header("Refresh: 3, home.php?acao=bemvindo");
											
										}else{
											echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button><strong>Erro!</strong> login ou senha incorretos, digite outro login ou consulte o administrador :(</div>';
										}
										} catch (PDOException $e){
										echo "ERRO DE LOGIN DO PDO : ".$e->getMessage();
										}
									}
								?>
							</div>
						</div>
					</div>
				</div>
		    </div>
	    </div>
	</div>
<!-- LOGIN -->

<!-- ARQUIVOS JS-->
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/datatables.min.js"></script>
	<script>
		$(document).ready( function () {
		    $('#table_id').DataTable();
		} );
	</script>
	<!-- https://datatables.net/ -->
	<!-- https://datatables.net/manual/installation -->
</body>
</html>
