<?php require_once("conexao.php"); ?>
<?php
    $produtos = "SELECT produtoID, nomeproduto, tempoentrega, precounitario, imagempequena FROM produtos";
    if ( isset($_GET["produto"])) {
        $nome_produto = $_GET["produto"];
        $produtos .= " WHERE nomeproduto LIKE '%{$nome_produto}%' ";
    }
    
    $resultado = mysqli_query($conecta, $produtos);
    if (!$resultado){
        die("Falha na consulta ao banco de dados");
    }
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SESI / SENAI</title>
        
        <!-- estilo -->
        <link href="estilo.css" rel="stylesheet">
        <link href="produtos.css" rel="stylesheet">
        <link href="produtos_pesquisa.css" rel="stylesheet">
    </head>

    <body>
        <?php include_once("topo.php"); ?>
        <?php include_once("funcoes.php"); ?>
        
        <main>  

        <div id="janela_pesquisa">
            <form action="listagem.php" method="get">
                <input type="text" name="produto" placeholder="Nome do Produto">
                <input type="image" name="pesquisa" src="../_assets/botao_Search.png">

            </form>
        </div>

            <div id="listagem_produtos">
            <?php 
                while($linha = mysqli_fetch_assoc($resultado)){
            ?>
                <ul>
                    <li class="imagem">
                        <a href="detalhe.php?codigo=<?php echo $linha["produtoID"] ?> ">
                            <img src="<?php echo $linha["imagempequena"]?>"></a></li>
                    <li><h3><?php echo $linha["nomeproduto"]?></h3></li>
                    <li><bold>Codigo: <?php echo $linha["produtoID"]?></bold></li>
                    <li>Tempo entrega: <?php echo $linha["tempoentrega"]?></bold></li>
                    <li>Preço unitário: <?php echo "R$ " . number_format($linha["precounitario"],2,",",".")?></li>
                </ul>
                <br>
            <?php 
                }
            ?>
            </div>
        </main>

        <?php include_once("rodape.php"); ?> 
    </body>
</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>