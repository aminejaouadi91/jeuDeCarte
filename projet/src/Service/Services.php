<?php

namespace App\Service;


use App\Controller\CoreController;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Services
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function randomValue($values): string
    {
        return array_rand($values);
    }

    public function getData($cards)
    {
        $data = new ArrayCollection();
        foreach ($cards as $card) {
            $values = explode("_", $card);
            $data->add(CoreController::VALUES[current($values)] . "_" . CoreController::COLORS[end($values)]);
        }
        return $data;
    }

    public function sortCards()
    {
        $cards = $this->session->get('data');
        sort($cards);
        return $cards;
    }

    public function setDataSession($cards): void
    {
        $this->session->set('data', $cards);
    }
}