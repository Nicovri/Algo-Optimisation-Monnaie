<?php

class Rendu {
    private $montant;
    private $billets;
    private $nombres;

    public function __construct($montant, $billets)
    {
        $this->montant = $montant;
        $this->billets = $this->billetDisponibles($billets);
        $this->nombres = $this->renduMonnaie($this->montant, $this->billets);
        //    In case you are trying to use greedy algorithm
        // $this->nombres = $this->rendu($this->montant, $this->billets);
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
       return $billets;
    //    In case you are trying to use greedy algorithm
    //    return array_reverse($billets);
    }

    private function rec($montant, $i, $billets, &$m) {
        if($montant == 0) {
            return 0;
        }
        if($montant > 0 && $i == 0 || $montant < 0) {
            return INF;
        }
        if($m[$montant][$i] === null) {
            $m[$montant][$i] = min($this->rec($montant, $i-1, $billets, $m), $this->rec($montant - $billets[$i-1], $i, $billets, $m) + 1);
        }
        return $m[$montant][$i];
    }

    private function progDyn($montant, $billets) {
        $n = count($billets);
        $m = array_fill(0, $montant + 1, array_fill(0, $n + 1, null));

        

        $this->rec($montant, $n, $billets, $m);
        return $m;
    }

    // Dynamic Programming Algorithm
    private function renduMonnaie($montant, $billets) {
        $n = count($billets);
        $m = $this->progDyn($montant, $billets);
        $nombres = array_fill(0, $n, 0);

        if($montant < $billets[0]) {
            return null;
        }

        while($montant > 0) {
            if(isset($m[$montant][$n]) && $m[$montant][$n] == $m[$montant][$n - 1]) {
                $n -= 1;
            } else {
                $nombres[$n-1] += 1;
                $montant -= $billets[$n-1];
            }
        }

        return $nombres;
    }

    // Greedy Algorithm (does not always work)
    public function rendu($montant, $billets) {
        if($montant >= $billets[count($billets) - 1]) {
            $nombres = array();

            foreach($billets as $billet) {
                $nombre = intval($montant / $billet);
                $montant -= $nombre * $billet;
                $nombres[] = $nombre;
            }

            if($montant !== 0) {
                if($billets[0] !== 0) {
                    $montant += $billets[0];
                    $nombres[0] -= 1;
                }
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