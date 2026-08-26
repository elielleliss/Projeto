<?php
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $banco = "andes2";
    $conecta = mysqli_connect($servidor,$usuario,$senha,$banco);

    if (mysqli_connect_errno() ) {
        die("Conexão falhou: " . mysqli_connect_errno());
    }

    $consulta_produtos  = "SELECT nomeproduto, precounitario, tempoentrega ";
    $consulta_produtos .= " FROM produtos";
    $produtos = mysqli_query($conecta, $consulta_produtos);

    if(!$produtos){
        die("Falha na consulta");
    }
?>