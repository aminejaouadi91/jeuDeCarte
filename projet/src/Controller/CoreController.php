<?php

namespace App\Controller;

use App\Service\Services;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
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
            $number = $services->randomValue(self::VALUES);
            $color = $services->randomValue(self::COLORS);
            $card = $number . "_" . $color;
            if (!$data->contains($card)) {
                $data->add($card);
            }
        }
        $cards = $data->getValues();
        $services->setDataSession($cards);
        $dataUnsorted = $services->getData($cards);
        return $this->render('core/index.html.twig', [
            'cards' => $dataUnsorted,
        ]);
    }

    /**
     * @Route("/sorted", name="sorted")
     */

    public function sortedCards(Services $services)
    {
        $cards = $services->sortCards();
        $dataSorted = $services->getData($cards);
        return $this->render('core/index.html.twig', [
            'cards' => $dataSorted,
        ]);
    }


}
