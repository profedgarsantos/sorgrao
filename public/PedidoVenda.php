<?php
// always load alternative config file for examples
require_once('tcpdf/config/tcpdf_config.php');

// Include the main TCPDF library (search the library on the following directories).
$tcpdf_include_dirs = array(
	realpath('tcpdf/tcpdf.php'),
	'/usr/share/php/tcpdf/tcpdf.php',
	'/usr/share/tcpdf/tcpdf.php',
	'/usr/share/php-tcpdf/tcpdf.php',
	'/var/www/tcpdf/tcpdf.php',
	'/var/www/html/tcpdf/tcpdf.php',
	'/usr/local/apache2/htdocs/tcpdf/tcpdf.php'
);
foreach ($tcpdf_include_dirs as $tcpdf_include_path) {
	if (@file_exists($tcpdf_include_path)) {
		require_once($tcpdf_include_path);
		break;
	}
}



// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator("Sorgrao");
$pdf->SetAuthor('Sorgrao');
$pdf->SetTitle('Pedido de Venda');
//$pdf->SetSubject('TCPDF Tutorial');
//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}


//$pdf->setPrintHeader(false);
// ---------------------------------------------------------

// set font
//$pdf->SetFont('helvetica', 'B', 20);

// add a page
$pdf->AddPage();

//$pdf->Write(0, 'PEDIDO DE COMPRA', '', 0, 'L', true, 0, false, false, 0);

//$pdf->SetFont('helvetica', '', 8);
$servidor = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'sorgrao';
// Conecta-se ao banco de dados MySQL
$con = mysqli_connect($servidor, $usuario, $senha, $banco);
// Caso algo tenha dado errado, exibe uma mensagem de erro
if (mysqli_connect_errno()) trigger_error(mysqli_connect_error());


// Executa uma consulta que pega cinco notícias
$sql = "SELECT * FROM vwpedidosvenda where id=" . $_GET['fechamento'];
$query = mysqli_query($con,$sql);


$pdf->SetFont('times', '', 13);

while ($fechamento = $query->fetch_array())
{
	
$estado=utf8_encode($fechamento["compradorestado"]);
$cidade=utf8_encode($fechamento["compradorcidade"]);
$compradornome=utf8_encode($fechamento["compradornome"]);
$vendedornome=utf8_encode($fechamento["vendedornomesorgrao"]);
$compradorlogradouro=utf8_encode($fechamento["compradorlogradouro"]);
$compradorbairro=utf8_encode($fechamento["compradorbairro"]);

$valorunitario='R$ ' . number_format($fechamento["valorunitario"], 2, ',', '.');
$valortotal='R$ ' . number_format($fechamento["valorfinal"], 2, ',', '.');

$dateinicial = new DateTime($fechamento["inicioentrega"]);
$entregainicial=$dateinicial-> format('d/m/Y');


$datefinal = new DateTime($fechamento["fimentrega"]);
$entregafinal=$datefinal-> format('d/m/Y');


$tbl = <<<EOD
<table style="border:1px solid black">
<tr>
<td style='height: 21px; text-align: justify;'>
<b>Nome/Razão Social:</b>{$compradornome}
<br /><b>CPF/CNPJ: </b>{$fechamento["compradorcpfcnpj"]}
<br /><b>I.E: </b>{$fechamento["compradorinscricaoestadual"]} 
<br /><b>E-mail: </b>{$fechamento["compradoremail"]}
<br /><b>Endereço: </b>{$compradorlogradouro}
<br /><b>Bairro: </b>{$compradorbairro}
 <br /><b>Cep: </b>{$fechamento["compradorcep"]}
 <br /><b>Cidade: </b>{$cidade}
 <br /><b>Estado: </b>{$estado}
 <br /><b>Tel.Fixo: </b> {$fechamento["compradortelefone"]}
 <br /><b>Celular: </b> {$fechamento["compradorcelular"]}
 </td>
</tr>
</table>
<p>
<table style="border:1px solid black">
<tbody>
<tr>
<td style='height: 21px; text-align: justify;'><b>Quantidade: </b>  {$fechamento["quantidade"]} - <b>Unidade: </b> {$fechamento["produtotipo"]}
<br><b>Preço: </b> {$valorunitario}
<br><b>Valor Total R$: </b> {$valortotal}
<br><b>Entrega Inicial: </b> {$entregainicial}
<br><b>Entrega Final: </b> {$entregafinal}
<br><b>Favorecido: </b>  {$vendedornome}
<br><b>CPF/CNPJ: </b>  {$fechamento["vendedorcpfcnpjsorgrao"]}
<br><b>Banco: </b> {$fechamento["numerobanco"]} - {$fechamento["nomebanco"]} <b>Agência: </b> {$fechamento["agencia"]} <b>Conta Corrente: </b> {$fechamento["contacorrente"]}
<br><b>FUNRURAL: </b> {$fechamento["funruraldescricao"]}
</td>
</tr>
</tbody>
</table>
<p>
<table style="border:1px solid black">
<tbody>
<tr>
<td style='height: 21px; text-align: justify;'>Qualidade da Mat&eacute;ria Prima/Classifica&ccedil;&atilde;o Padr&atilde;o:( ) SIM( ) N&Atilde;O &ndash; INFORMAR CLASSIFICA&Ccedil;&Atilde;O ABAIXO:
<br>Umidade: _____% Impureza: _____% Ardidos e Brotados: _____% Quebrados: _____% Avariados: _____%
</td>
</tr>
</tbody>
</table>
<br>&nbsp;
<br>Rio Verde - GO, _________&nbsp;&nbsp;
<p>
<table border='1' width='100%' cellspacing='0' cellpadding='0'>
<tbody>
<tr>
<td style='width: 50%'>
<br><br>________________________________
<br>Assinatura do Comprador/Vendedor
</td>
<td style='width: 50%;'>
<br><br>_________________________________
<br>Assinatura do Cliente/Fornecedor
</td>
</tr>
</tbody>
</table>
EOD;
}

$pdf->writeHTML($tbl, true, false, false, false, '');

$pdf->Output('pedidocompra.pdf', 'I');