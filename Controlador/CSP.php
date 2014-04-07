<?php
include_once 'Modelo/Strip.php';
/**
 * Description of CSP
 * Controlador de Strip Packing
 * @author Alvaro
 */

class CSP {
    protected $cp;
    
    function __construct($cp) {
        $this->cp = $cp;
        $this->setDo();
    }
    
    function getLayout() {
        return $this->layout;
    }
    
    function setDo() {
        if(isset($_GET["do"])) {
            $this->cp->showLayout = false;
            $do = $_GET["do"];
            switch($do) {
                case 'genera':
                    $sp = new Strip($_POST["ancho"], $_POST["alto"], $_POST["optimo"]);
                    $sp->parsePiezas($_POST["piezas"]);
                    $sp->setZ($_POST["zoom"]);
                    $data = new stdClass();
                    if($sp->generateLayout()) {
                        $data->src = $sp->dropLayout();
                        $data->error = 0;
                    } else {
                        $data->error = 1;
                        $data->msg = "No se pudo generar el layout :(";
                    }
                    
                    echo json_encode($data);
                    break;
            }
        }
    }

}

?>
