<?php

namespace App\Controller;

use App\Entity\Quizz;
use App\Repository\QuizzRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuizzController extends AbstractController
{
    /**
     * @Route("/quizzes", name="quizzes")
     */
    public function index(QuizzRepository $quizzRepository): Response
    {
        $quizzes = $quizzRepository->findAll();
        return $this->render('quizz/index.html.twig', [
            'quizzes' => $quizzes,
        ]);
    }

        /**
     * @Route("/quizz/{id}", name="quizz_show")
     */
    public function show(Quizz $quizz): Response
    {
        return $this->render('quizz/show.html.twig', [
            'quizz' => $quizz,
        ]);
    }
}
