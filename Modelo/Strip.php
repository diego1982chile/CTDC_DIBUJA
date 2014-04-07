<?php
include_once 'Modelo/Dibuja.php';
include_once 'Modelo/Pieza.php';
/**
 * Description of Strip
 * Tira para Strip Packing
 * @author Alvaro
 */
class Strip {
    private $w;
    private $h;
    private $op;
    private $z;
    private $piezas;
    private $nPiezas;
    private $layout;
    private $di;
    private $areaMayor;
    private $areaMenor;
    public $src;
            
    function __construct($w, $h, $op = 0) {
        $this->w = $w;
        $this->h = $h;
        $this->op = $op;
        $this->di = new Dibuja();        
    }
    
    public function dropLayout() {
        $this->src = "SP_".Date("U")."_".$this->w."_".$this->op."_".$this->h.".png";
        imagepng($this->layout, "/home/dev/www/Dibuja/Layout/".$this->src);
        return "Layout/".$this->src;
    }

    public function generateLayout() {
        if($this->h > $this->op)
            $this->layout = $this->di->createCanvas(($this->w*1.05)*$this->z, ($this->h*1.05)*$this->z);
        else 
            $this->layout = $this->di->createCanvas(($this->w*1.05)*$this->z, ($this->op*1.05)*$this->z);

        for($i=0; $i<$this->nPiezas; $i++) {
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

            $this->layout = $this->di->rectangulo($this->layout, $p->getX() * $this->z, $p->getY() * $this->z, $p->getW() * $this->z, $p->getH() * $this->z, 2);
        }

        if($this->op > 0) {
            $this->di->imagelinedotted($this->layout, 0, $this->op * $this->z, ($this->w*1.05) * $this->z, $this->op * $this->z, 6, 4, "negro");
            if($this->h > $this->op) $line = "rojo";
            else $line = "verde";
        } else $line = "verde";
        
        $this->di->imagelinedotted($this->layout, 0, $this->h * $this->z, ($this->w*1.05) * $this->z, $this->h * $this->z, 6, 4, $line);
        imagerectangle($this->layout, 0, 0, $this->w * $this->z, ($this->h*1.05) * $this->z, imagecolorallocate($this->layout, 0, 0, 0));
        if($this->layout = $this->di->flipVertical($this->layout))
            return true;
        else return false;
    }

    public function parsePiezas($s) {
        $pie = explode(";", $s);
        $piezas = array();
        $nPie = count($pie);
        $this->nPiezas = $nPie;
        for($i=0; $i<$nPie; $i++) {
            $pie[$i] = explode(",", $pie[$i]);
            $p = new Pieza($pie[$i][0], $pie[$i][1], $pie[$i][2], $pie[$i][3]);
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

    public function getOp() {
        return $this->op;
    }

    public function setOp($op) {
        $this->op = $op;
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

}

?>
