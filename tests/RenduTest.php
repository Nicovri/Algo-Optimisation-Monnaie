<?php declare(strict_types=1);

    use PHPUnit\Framework\TestCase;

    require_once dirname(__DIR__) . "/src/Rendu.php";

    const BILLET_2 = 2;
    const BILLET_5 = 5;
    const BILLET_10 = 10;

final class RenduTest extends TestCase {
    private $billets = array(BILLET_2, BILLET_5, BILLET_10);
    public function testRendu1(): void {
        $rendu = new Rendu(1, $this->billets);
        $this->assertEquals(null, $rendu->nombres);
    }

    public function testRendu6(): void {
        $rendu = new Rendu(6, $this->billets);
        $this->assertEquals(array(0, 0, 3), $rendu->nombres);
    }

    public function testRendu10(): void {
        $rendu = new Rendu(10, $this->billets);
        $this->assertEquals(array(1, 0, 0), $rendu->nombres);
    }

    public function testRendu11(): void {
        $rendu = new Rendu(11, $this->billets);
        $this->assertEquals(array(0, 1, 3), $rendu->nombres);
    }

    public function testRendu21(): void {
        $rendu = new Rendu(21, $this->billets);
        $this->assertEquals(array(1, 1, 3), $rendu->nombres);
    }

    public function testRendu23(): void {
        $rendu = new Rendu(23, $this->billets);
        $this->assertEquals(array(1, 1, 4), $rendu->nombres);
    }

    public function testRendu31(): void {
        $rendu = new Rendu(31, $this->billets);
        $this->assertEquals(array(2, 1, 3), $rendu->nombres);
    }

    public function testRenduMore(): void {
        $rendu = new Rendu(9007199254740991, $this->billets);
        $this->assertEquals(array(900719925474098, 1, 3), $rendu->nombres);
    }
}
?>