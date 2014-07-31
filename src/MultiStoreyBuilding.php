<?php
namespace Plakhonin\city;

class MultiStoreyBuilding {

    public $buildingNumber;
    public $floorCount;
    public $porchCount;
    public $flatCount;
    public $neighborhoods;

    public function __construct($BuildingRand) {
        $options = $BuildingRand->buildingRand();

        $this->buildingNumber = $options['buildingNumber'];
        $this->floorCount = $options['floorCount'];
        $this->porchCount = $options['porchCount'];
        $this->neighborhoods = $options['neighborhoods'];
        $this->flatCount();
    }

//все квартиры в массив 
    public function flatCount() {
        $flatCount = $this->porchCount * $this->floorCount * 4; // 4 -количество квартир на этаже
        $arr = array();
        for ($i = 0; $i < $flatCount; $i++) {
            $arr[$i] = new Flat(new FlatRand);
        }
        $this->flatCount = $arr;
    }

    public function allFlatTax() {
        $sum = 0;
        foreach ($this->flatCount as $value) {
            $sum += $value->allTarif();
        }
        return $sum;
    }

    public function lighting() {
        $sum = $this->porchCount * $this->floorCount * 15;
        return $sum;
    }

    public function landTax() {
        $sum = $this->neighborhoods * 10; //10 грн за 1м2
        return $sum;
    }

}

class BuildingRand {

    public function buildingRand() {
        return array(
            "buildingNumber" => rand(1, 50),
            "floorCount" => rand(1, 24),
            "porchCount" => rand(1, 5),
            "neighborhoods" => rand(400, 1500)
        );
    }

}