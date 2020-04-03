<?php

namespace App\tests;

use App\Controller\CoreController;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Response;

class ApiControllerTest extends KernelTestCase
{




    protected function setUp(): void
    {
        parent::setUp();

        self::bootKernel();


    }


    public function testIndex()
    {
        $controller = new CoreController();
        $response = $controller->unsortedCards();
        dd($response);
    }


}

