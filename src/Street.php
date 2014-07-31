<?php
namespace Plakhonin\city;
class Street {

    public $streetName;
    public $streetLong;
    public $streetStart;
    public $streetFinish;
    public $buildingCount;
    public $janitorTeretory = 3000;

    public function __construct($StreetRand) {
        $options = $StreetRand->streetRand();
        $resultStreetName = $StreetRand->streetName();

        $this->streetName = array_rand($resultStreetName);
        $this->streetLong = $options['streetLong'];
        $this->streetStart = $options['streetStart'];
        $this->streetFinish = $options['streetFinish'];
        $this->buildingCount = $options['buildingCount'];

        $arr = array();

        for ($i = 0; $i < $options['buildingCount']; $i++) {
            $arr[$i] = new MultiStoreyBuilding(new BuildingRand);
            $this->buildingCount = $arr;
        }
    }

    public function janitorCount() {
        $janitor = 0;
        foreach ($this->buildingCount as $value) {
            $janitor += $value->neighborhoods;
        }
        $janitor = ceil($janitor / $this->janitorTeretory);
        return $janitor;
    }

    public function streetTax() {
        $allStreetTax = 0;
        foreach ($this->buildingCount as $value) {
            $allStreetTax += $value->allFlatTax();
        }
        return $allStreetTax;
    }

}


class StreetRand {

    public function streetName() {
        return array("Ленина" => "Ленина", "Алиева" => "Алиева", "Бекетова" => "Бекетова", "Победы" => "Победы", "Сумская" => "Сумская");
    }

    public function streetRand() {
        return array(
            "streetLong" => rand(1, 5),
            "streetStart" => rand(1, 10) . "°" . rand(1, 10) . "′" . rand(1, 10) . " c.ш; " . rand(1, 10) . "°" . rand(1, 10) . "′" . rand(1, 10) . " в.д.",
            "streetFinish" => rand(1, 10) . "°" . rand(1, 10) . "′" . rand(1, 10) . " c.ш; " . rand(1, 10) . "°" . rand(1, 10) . "′" . rand(1, 10) . " в.д.",
            "buildingCount" => rand(5, 50)
        );
    }

}
