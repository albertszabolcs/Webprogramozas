<?php
class Bevasarlolista {
    private $lista = [];

    public function hozzaad_elem($nev, $mennyiseg, $egysegar) {
        $this->lista[] = [
            "nev" => $nev,
            "mennyiseg" => $mennyiseg,
            "egysegar" => $egysegar
        ];
    }

    public function kiir_lista() {
        echo "<pre>";
        print_r($this->lista);
        echo "</pre>";
    }
}

$bevasarlolista = new Bevasarlolista();


$bevasarlolista->hozzaad_elem("Kenyer", 2, 8.5);
$bevasarlolista->hozzaad_elem("Viz", 1, 2.5);

$bevasarlolista->kiir_lista();
?>
