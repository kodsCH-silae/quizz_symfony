<?php
// src/Controller/ProductController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RandomController extends AbstractController
{
   /**
    * @Route("/random/show")
    */
    public function show(): Response
    {
        $number = random_int(0, 100);

        return $this->render('show.html.twig', ['number' => $number
      ]);
    }
}