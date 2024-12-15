<?php
class BevasarloLista {
    private $lista = [];

    public function hozzaad_elem($nev, $mennyiseg, $egysegar) {
        $this->lista[] = [
            "nev" => $nev,
            "mennyiseg" => $mennyiseg,
            "egysegar" => $egysegar
        ];
    }

    public function eltavolit_elem($nev) {
        foreach ($this->lista as $index => $elem) {
            if ($elem['nev'] === $nev) {
                unset($this->lista[$index]);
                $this->lista = array_values($this->lista);
                return true;
            }
        }
        return false;
    }

    public function megjelenit_lista() {
        echo "<pre>";
        print_r($this->lista);
        echo "</pre>";
    }
}

$bevasarlolista = new BevasarloLista();

$bevasarlolista->hozzaad_elem("Kenyer", 2, 8.5);
$bevasarlolista->hozzaad_elem("Viz", 1, 2.5);

echo "Bevásárlólista az elemek hozzáadása után:\n";
$bevasarlolista->megjelenit_lista();

$nev_eltavolit = "Kenyer";
if ($bevasarlolista->eltavolit_elem($nev_eltavolit)) {
    echo "$nev_eltavolit eltávolítva a bevásárlólistáról.\n";
} else {
    echo "$nev_eltavolit nem található a bevásárlólistán.\n";
}
echo "Bevásárlólista az eltávolítás után:\n";
$bevasarlolista->megjelenit_lista();
?>
