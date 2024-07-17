<?php
$servidor = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'sorgrao';
// Conecta-se ao banco de dados MySQL
$con = mysqli_connect($servidor, $usuario, $senha, $banco);
// Caso algo tenha dado errado, exibe uma mensagem de erro
if (mysqli_connect_errno()) trigger_error(mysqli_connect_error());


// Executa uma consulta que pega cinco notícias
$sql = "SELECT * FROM vwpedidoscompra where id=" . $_GET['fechamento'];
$query = mysqli_query($con,$sql);



while ($fechamento = $query->fetch_array())
{
    echo $fechamento["compradornome"];
}
