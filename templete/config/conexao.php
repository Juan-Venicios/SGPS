<?php
	try{
		@DEFINE('HOST','127.0.0.1');
	    @DEFINE('DB','ps_bd');
	    @DEFINE('USER','root');
	    @DEFINE('PASS','qwe123');

	    $conect = new PDO('mysql:host='.HOST.
	    ';dbname='.DB,USER,PASS);
	    $conect -> setAttribute(PDO::ATTR_ERRMODE,
	    PDO::ERRMODE_EXCEPTION);

	}catch(PDOException $e){
	    echo "<b>ERRO DE PDO = </b>".$e->getMessage();
	}