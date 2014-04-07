<?php
/**
 * Description of CPrincipal
 * Controlador Principal
 * @author Alvaro
 */
class CPrincipal {
    public $layout = "Vista/layout.phtml";
    public $showLayout = true;
    public $thisLayout = true;

    function __construct() {
        $this->setSec();
    }

    public function getLayout() {
        if($this->thisLayout) return $this->layout;
        else return $this->_CSec->getLayout();
    }

    function getCSec() {
        return $this->_CSec;
    }

    function setSec() {
        if(isset($_GET["sec"])) {
            $this->sec = $_GET["sec"];
            $this->showLayout = true;
            $this->thisLayout = true;
            switch($this->sec) {
                case "SP": //Strip Packing
                    include_once 'CSP.php';
                    $this->_CSec = new CSP($this);
                    break;
                case "CP": //Cutting problem
                    include_once 'CCP.php';
                    $this->_CSec = new CCP($this);
                    break;
            }
        }
    }
}
?>