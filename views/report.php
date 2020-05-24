<?php

use Mpdf\Mpdf;

ob_start(); ?>

<head>
    <meta charset="utf-8">
    <title>Histórico de mensagens</title>
    <link rel="stylesheet" type="text/css" href="<?php BASE_URL; ?>assets/css/mypdf.css">
</head>
<div class="maincontents">
    
        <h1 style="text-align: center">Relatório</h1>
        <hr>

        <table border="" width="100%">
            <tr>
                <th>Nome</th>
                <th>Username</th>
                <th>E-mail</th>
                <th>Data</th>
            </tr>
            <tr>
                <th><?php echo $name; ?></th>
                <th><?php echo $username; ?></th>
                <th><?php echo $email; ?></th>
                <th><?php echo  date('d/m/Y'); ?></th>
            </tr>
        </table>
        <br>
        <hr>
        <table border="" width=100%>
            <tr>
                <th>Mensagem</th>
                <th>Grupo</th>
                <th>Tipo</th>
                <th>Data</th>
            </tr>
            <!--Substituir id_group por group_name-->
            <?php foreach ($message as $item) : ?>
                <tr>
                    <td><?php echo $item['msg']; ?></td>
                    <td><?php echo $item['id_group']; ?></td>
                    <td><?php echo $item['msg_type']; ?></td>
                    <td><?php echo $item['date_msg']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

        
<footer class="reportFooter">
    Sua segurança, nossa garantia.
</footer>
</div>
<?php 
$html = ob_get_contents();
ob_end_clean();
require 'vendor/autoload.php';
 $mpdf = new Mpdf();
$mpdf->CSSselectMedia='assets/css/mypdf.css';
$mpdf ->WriteHTML($html);
$mpdf->Output('arquivo.pdf', 'I');
