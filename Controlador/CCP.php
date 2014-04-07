<?php
include_once 'Modelo/Bin.php';
/**
 * Description of CCP
 * Controlador de Cutting Problem
 * @author Alvaro
 */
class CCP {
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
                    $cp = new Bin($_POST["ancho"], $_POST["alto"]);
                    $cp->parsePiezas($_POST["piezas"]);
                    $cp->setZ($_POST["zoom"]);
                    $data = new stdClass();
                    if($cp->generateLayout()) {
                        $data->src = $cp->dropLayout();
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
