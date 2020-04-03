<?php

namespace App\Service;


use Doctrine\Common\Collections\ArrayCollection;

class Services
{

    public function randomValue($array)
    {
        return array_rand($array);
    }

    public function getData($cards, $values, $colors)
    {
        $data = new ArrayCollection();
        foreach ($cards as $card) {
            $test = explode("_", $card);
            $data->add($values[$test[0]] . "_" . $colors[$test[1]]);
        }
        return $data;
    }
}