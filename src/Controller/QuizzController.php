<?php

namespace App\Controller;

use App\Entity\Quizz;
use App\Form\QuestionType;
use App\Repository\QuestionRepository;
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
    public function show(Quizz $quizz, QuestionRepository $questionRepository): Response
    {
        $questions = $questionRepository->findByQuizzId($quizz->getId());
        $forms = [];
        foreach ($questions as $question) {
            $form = $this->createForm(QuestionType::class, $question, ['questionId'=> $question->getId()]);
            array_push($forms, $form->createView());

        }
        return $this->render('quizz/show.html.twig', [
            'forms' => $forms,
            'title' => $quizz->getTitle(),
        ]);
    }
}
