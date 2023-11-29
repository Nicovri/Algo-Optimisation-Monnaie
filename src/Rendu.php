<?php

class Rendu {
    private $montant;
    private $billets;
    private $nombres;

    public function __construct($montant, $billets)
    {
        $this->montant = $montant;
        $this->billets = $this->billetDisponibles($billets);
        $this->nombres = $this->rendu($this->montant, $this->billets);
    }

    public function __get($name) {
        if('montant' === $name) {
            return $this->montant;
        }
        elseif('billets' === $name) {
            return $this->billets;
        } elseif('nombres' === $name) {
            return $this->nombres;
        } else {
            throw new Exception('Nom invalide...');
        }
    }

    private function billetDisponibles($billets) {
       sort($billets, SORT_REGULAR);
       return array_reverse($billets);
    }

    public function rendu($montant, $billets) {
        if($montant >= $billets[count($billets) - 1]) {
            $nombres = array();

            foreach($billets as $billet) {
                $nombre = intval($montant / $billet);
                $montant -= $nombre * $billet;
                $nombres[] = $nombre;
            }

            if($montant !== 0) {
                $montant += $billets[0];
                $nombres[0] -= 1;
                $nombres2 = $this->rendu($montant, array_slice($billets, 1));
                foreach($nombres2 as $i => $nombre2) {
                    $nombres[$i+1] += $nombre2;
                    $montant -= $nombre2 * $billets[$i];
                }
            }

            return $nombres;

        } else {
            return null;
        }
    }
}



?>