<?php

    require_once 'class.Rendu.php';

    const BILLET_2 = 2;
    const BILLET_5 = 5;
    const BILLET_10 = 10;

    $billets = array(BILLET_2, BILLET_5, BILLET_10);

    $rendu = new Rendu(155, $billets);

    echo "Billets: ";
    foreach($rendu->billets as $billet) {
        echo $billet . "\n";
    }

    echo "Montant: " . $rendu->montant . "\n";

    echo "Nombres: ";
    foreach($rendu->nombres as $nombre) {
        echo $nombre . "\n";
    }
?>