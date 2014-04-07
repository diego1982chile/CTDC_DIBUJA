<?php

/**
 * Description of Dibuja
 * Funciones comunes de dibujo
 * @author Alvaro
 */
class Dibuja {
    public $colores;
    
    function __construct() {
    }
    
    public function createCanvas($w, $h) {
        $im = @imagecreatetruecolor($w, $h);
        $this->colores = new stdClass();
        $this->colores->blanco = imagecolorallocate($im, 255, 255, 255);
        $this->colores->negro = imagecolorallocate($im, 0, 0, 0);
        $this->colores->rojo = imagecolorallocate($im, 229,56,0);
        $this->colores->verde = imagecolorallocate($im, 136,196,37);
		$this->colores->azul = imagecolorallocate($im, 136,196,37);
        $c = array();
        $c[0] = imagecolorallocatealpha($im, 229,56,0, 84);
        $c[1] = imagecolorallocatealpha($im, 229,56,0, 63);
        $c[2] = imagecolorallocatealpha($im, 229,56,0, 42);
        $c[3] = imagecolorallocatealpha($im, 229,56,0, 21);
        $c[4] = imagecolorallocatealpha($im, 229,56,0, 5);
        $this->colores->pieza = $c;
        imagefilledrectangle($im, 0, 0, $w, $h, $this->colores->blanco);

        return $im;
    }

    public function getColor($col) {
        switch($col) {
            case "negro":
                $col = $this->colores->negro;
                break;
            case "rojo":
                $col = $this->colores->rojo;
                break;
            case "verde":
                $col = $this->colores->verde;
                break;
        }
        return $col;
    }
    
    public function imagelinedotted($im, $x1, $y1, $x2, $y2, $largo, $dist, $col) {
        $col = $this->getColor($col);
        $transp = imagecolortransparent($im);

        $style = array($col);

        for ($i = 0; $i < $largo; $i++) {
            array_push($style, $col);
        }

        for ($i = 0; $i < $dist; $i++) {
            array_push($style, $transp);        // Generate style array - loop needed for customisable distance between the dots
        }

        imagesetstyle($im, $style);
        return (integer) imageline($im, $x1, $y1, $x2, $y2, IMG_COLOR_STYLED);
        imagesetstyle($im, array($col));        // Reset style - just in case...
    }

    public function flipVertical($img) {
		return $img;
    }

    public function rectangulo($img, $id, $x, $y, $ancho, $alto, $relleno, $fill = 0, $tipo) {
		$size_x = imagesx($img);
        $size_y = imagesy($img);
	
        if($tipo=='G')
		{
            imagefilledrectangle($img, $x, $size_y-$y, $x + $ancho, $size_y-($y + $alto), $this->colores->rojo);			
			// El texto a dibujar
			$text = $id;
			// Reemplace la ruta por la de su propia fuente
			$fuente = 'C:\Windows\Fonts\times.ttf';					
			imagettftext($img, 6, 0, $x+$ancho/2-floor(log(5*$id)), $size_y-($y+$alto/2-5), $this->colores->negro, $fuente, $text);			
		}
		
        imagerectangle($img, $x, $size_y-$y, $x + $ancho, $size_y-($y + $alto), $this->colores->negro);				

        return $img;
    }

}

?>
