<?php

namespace App\Controller;

use App\Service\Services;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CoreController extends AbstractController
{
    CONST COLORS = ['c1' => "of_diamonds", 'c2' => "of_hearts", 'c3' => "of_spades", 'c4' => "of_clubs"];
    CONST VALUES = ["01" => "ace", "02" => "2", "03" => "3", "04" => "4", "05" => "5", "06" => "6", "07" => "7", "08" => "8", "09" => "9", "10" => "10", "11" => "jack", "12" => "queen", "13" => "king"];
    CONST LIMIT = 10;

    /**
     * @Route("/", name="unsorted")
     */

    public function unsortedCards(Services $services)
    {
        $data = new ArrayCollection();
        while (self::LIMIT > $data->count()) {
            $value = $services->randomValue(self::VALUES);
            $color = $services->randomValue(self::COLORS);
            $key = $value . "_" . $color;
            if (!$data->contains($key)) {
                $data->add($key);
            }
        }
        $cards = $data->getValues();
        $this->get('session')->set('data', $cards);
        $dataunsorted = $services->getData($cards, self::VALUES, self::COLORS);
        return $this->render('core/index.html.twig', [
            'cards' => $dataunsorted,
        ]);
    }

    /**
     * @Route("/core", name="sorted")
     */

    public function sortedCards(Services $services)
    {

        $cards = $this->get('session')->get('data');
        sort($cards);
        $dataSorted = $services->getData($cards, self::VALUES, self::COLORS);
        return $this->render('core/index.html.twig', [
            'cards' => $dataSorted,
        ]);
    }


}
