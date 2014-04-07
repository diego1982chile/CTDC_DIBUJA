<?php
include_once 'Dibuja.php';
//include_once 'Pieza.php';
/**
 * Description of Bin
 * Lamina para Cutting Problem
 * @author Alvaro
 */
 class Pieza {

    private $w;
    private $h;
    private $x;
    private $y;
    private $area;
    private $tipo;
	private $id;

    function __construct($x, $y, $w, $h, $id) {
		$this->id = $id;
        $this->x = $x;
        $this->y = $y;
        $this->w = $w;
        $this->h = $h;
        $this->area = $w * $h;
		$this->id=$id;
    }

    public function getArea() {
        return $this->area;
    }

    public function getW() {
        return $this->w;
    }

    public function setW($w) {
        $this->w = $w;
    }

    public function getH() {
        return $this->h;
    }

    public function setH($h) {
        $this->h = $h;
    }

    public function getX() {
        return $this->x;
    }

    public function setX($x) {
        $this->x = $x;
    }

    public function setY($y) {
        $this->y = $y;
    }

    public function getY() {
        return $this->y;
    }
    
    public function getTipo() {
        return $this->tipo;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }
	
	public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }
}
 
class Bin {
    private $w;
    private $h;
    private $z;
    private $piezas;
    private $nPiezas;
    private $layout;
    private $di;
    private $areaMayor;
    private $areaMenor;
    public $src;

    function __construct($w, $h) {
        $this->w = $w;
        $this->h = $h;
        $this->di = new Dibuja();
    }
    
    public function dropLayout() {
        $this->src = "CP_".Date("U")."_".$this->w."_".$this->h.".png";
        imagepng($this->layout, "C:/xampp/htdocs/Dibuja/Layout/".$this->src);
        return "Layout/".$this->src;
    }

    public function generateLayout() {
        $this->layout = $this->di->createCanvas($this->w*$this->z, $this->h*$this->z);

        for($i=0; $i<$this->nPiezas-1; $i++) {
            $p = $this->piezas[$i];
            $color = floor(($p->getArea()/$this->areaMayor)*100);
        
            if($color <= 20) {
                $color = 0;
            } else if($color <= 40) {
                $color = 1;
            } else if($color <= 60) {
                $color = 2;
            } else if($color <= 80) {
                $color = 3;
            } else if($color <= 100) {
                $color = 4;
            }

            if($p->getTipo()=="G") $fill = 0;
            else $fill = 0;
            $this->layout = $this->di->rectangulo($this->layout, $p->getId(), $p->getX() * $this->z, $p->getY() * $this->z, $p->getW() * $this->z, $p->getH() * $this->z, 0, $fill, $p->getTipo());
        }
        
        imagerectangle($this->layout, 0, 0, $this->w * $this->z - 1, $this->h * $this->z - 1, imagecolorallocate($this->layout, 0, 0, 0));
        if($this->layout = $this->di->flipVertical($this->layout))
            return true;
        else return false;
    }

    public function parsePiezas($s) {
        $pie = explode(";", $s);
        $piezas = array();
        $nPie = count($pie);
        $this->nPiezas = $nPie;
        for($i=0; $i<$nPie-1; $i++) {			
            $pie[$i] = explode(",", $pie[$i]);
			// print_r($pie[$i]);			
			$p = new Pieza($pie[$i][1], $pie[$i][2], $pie[$i][3], $pie[$i][4], $pie[$i][5]);			
            $p->setTipo($pie[$i][0]);
            $are = $p->getArea();
            $piezas[] = $p;
            if($i == 0) {
                $areaMayor = $are;
                $areaMenor = $are;
            } else {
                if($are > $areaMayor) $areaMayor = $are;
                if($are < $areaMenor) $areaMenor = $are;
            }
        }
        $this->areaMayor = $areaMayor;
        $this->areaMenor = $areaMenor;
        $this->setPiezas($piezas);
    }
    
    public function getW() {
        return $this->w;
    }

    public function setW($w) {
        $this->w = $w;
    }

    public function getH() {
        return $this->h;
    }

    public function setH($h) {
        $this->h = $h;
    }

    public function getZ() {
        return $this->z;
    }

    public function setZ($z) {
        $this->z = $z;
    }

    public function getPiezas() {
        return $this->piezas;
    }

    public function setPiezas($piezas) {
        $this->piezas = $piezas;
    }

    public function getLayout() {
        return $this->layout;
    }

    public function setLayout($layout) {
        $this->layout = $layout;
    }
}

?>