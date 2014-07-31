<?php

//3.	Создайте класс, описывающий населенный пункт. В качестве примеров полей используйте название
// населенного пункта, год основания, географические координаты и т.д. Реализуйте методы, которые:
//- рассчитывает бюджет населенного пункта в зависимости от размера налога на землю, полученного со всех домов;
//- рассчитывает количество населения, проживающего в населенном пункте;
//- выводит информацию о населенном пункте.
namespace Plakhonin\city;
class City {

    public $buildingCount;
    public $neighborhoods;
    public $Kharkov;
    public $people;


    public function __construct($cityRand) {
        $resultCity = $cityRand->cityRand();

        $this->Kharkov = $resultCity["Kharkov"];
        $this->buildingCount = $resultCity["buildingCount"];
        $this->neighborhoods = $resultCity["neighborhoods"];
        $this->people = $resultCity["people"];


        $arr = array();
        for ($i = 0; $i < $resultCity['buildingCount']; $i++) {
            $arr[$i] = new MultiStoreyBuilding(new BuildingRand);
            $this->buildingCount = $arr;
        }
    }

    public function allLandTaxt() {
        $allLandTax = 0;
        foreach ($this->buildingCount as $value) {
            $allLandTax += $value->neighborhoods;
        }
        $allLandTax *= 10;
        return $allLandTax;
    }
    
        public function allandTax() {
        $sum = $this->neighborhoods * 10 * $this->buildingCount; //10 грн за 1м2
        return $sum;
    }



}

class CityRand {

    public function cityRand() {
        return array(
            
            "Kharkov" => "Харьков - Год оснлования 1654г. Широта: 50°00′00″ с.ш. Долгота: 36°15′00″ в.д.	",
            "buildingCount" => rand(10, 50),
            "neighborhoods" => rand(400, 1000),
            "people" => rand(2,2.5)
        );
    }

}


