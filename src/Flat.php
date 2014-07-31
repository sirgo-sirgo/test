<?php
namespace Plakhonin\city;

class Flat {

    public $rooms;
    public $squere;
    public $floor;
    public $tenants;
    public $balcony;
    public $heatingType;
    public $gasMeter;
    public $electricPower;
    public $waterm3;

//gas constants with gas meter
    const GAS2500 = 2500;
    const GAS6000 = 6000;
    const GASLESS2500TARIF = 1.197;
    const GASMORE2500TARIF = 1.965;
    const GASMORE6000TARIF = 4.011;
    const GASMONTH = 12;
//eclectric (kw/hour) constants
    const ELECTRIC150 = 150;
    const ELECTRIC800 = 800;
    const ELECTRICLESS150TARIF = 30.84;
    const ELECTRICMORE150TARIF = 41.94;
    const ELECTRICMORE800TARIF = 134.04;
    const ELECTRICUAN = 100;
// water 
    const WATERTARIF = 2.28;
//flat
    const FLATFIRSTTARIF = 1.10;
    const FLATSECONDTARIF = 1.50;

    public function __construct($FlatRand) {
        $options = $FlatRand->flatRand();

        $this->rooms = $options['rooms'];
        $this->squere = $options['squere'];
        $this->floor = $options['floor'];
        $this->tenants = $options['tenants'];
        $this->balcony = $options['balcony'];

        $this->heatingType = $options['heatingType'];
        if ($this->heatingType == 0) {
            $this->heatingType = "Центральное";
        } else {
            $this->heatingType = "Автономное";
        }

        $this->gasMeter = $options['gasMeter'];
        $this->electricPower = $options['electricPower'];
        $this->waterm3 = $options['waterm3'];
    }

    public function gas() {
        $m3 = $this->gasMeter;
        if ($m3 < self::GAS2500) {
            $sum = ($m3 * self::GASLESS2500TARIF) / self::GASMONTH;
            return $sum;
        } else if ($m3 >= self::GAS2500 || $m3 < self::GAS6000) {
            $sum = ($m3 * self::GASMORE2500TARIF) / self::GASMONTH;
            return $sum;
        } else {
            $sum = ($m3 * self::GASMORE6000TARIF) / self::GASMONTH;
            return $sum;
        }
    }

    public function electricPower() {
        $kwHour = $this->electricPower;
        if ($kwHour < self::ELECTRIC150) {
            $sum = ($kwHour * self::ELECTRICLESS150TARIF) / self::ELECTRICUAN;
            return $sum;
        } else if ($kwHour >= self::ELECTRIC150 || $kwHour < self::ELECTRIC800) {
            $sum = ($kwHour * self::ELECTRICMORE150TARIF) / self::ELECTRICUAN;
            return $sum;
        } else {
            $sum = ($kwHour * self::ELECTRICMORE800TARIF) / self::ELECTRICUAN;
            return $sum;
        }
    }

    public function water() {
        $sum = $this->waterm3 * self::WATERTARIF * $this->tenants;
        return $sum;
    }

    public function flat() {
        if ($this->floor <= 1) {
            $sum = $this->squere * self::FLATFIRSTTARIF;
            return $sum;
        } else {
            $sum = $this->squere * self::FLATSECONDTARIF;
            return $sum;
        }
    }

    public function allTarif() {
        $sum = $this->gas() + $this->electricPower() + $this->water() + $this->flat();
        return $sum;
    }

}
//functions rand for class Flat
class FlatRand {

    public function flatRand() {
        return array(
            "rooms" => rand(1, 4),
            "heatingType" => rand(0, 1),
            "balcony" => rand(1, 2),
            "tenants" => rand(1, 5),
            "gasMeter" => rand(500, 7000),
            "electricPower" => rand(100, 1000),
            "waterm3" => rand(1, 10),
            "squere" => rand(25, 150),
            "floor" => rand(0, 24)
        );
    }

}
