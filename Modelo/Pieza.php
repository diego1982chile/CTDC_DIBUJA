<?

/**
 * Description of Pieza
 * Pieza basica
 * @author Alvaro
 */
class Pieza {

    private $w;
    private $h;
    private $x;
    private $y;
    private $area;
    private $tipo;

    function __construct($x, $y, $w, $h) {
        $this->x = $x;
        $this->y = $y;
        $this->w = $w;
        $this->h = $h;
        $this->area = $w * $h;
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

}

?>