<?php
include_once 'Controlador/CPrincipal.php';

$cp = new CPrincipal();
?>
<?php if($cp->showLayout) include $cp->getLayout();?>