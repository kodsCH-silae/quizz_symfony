<?php

namespace App\Form;

use App\Entity\Question;
use App\Entity\Answer;
use App\Entity\Quizz;
use App\Repository\AnswerRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $id = $options['questionId'];
        $builder
            ->add('label')
            ->add('quizz', EntityType::class, [
                'class' => Quizz::class,
                'choice_label' => function ($quizz) {
                    return $quizz->getTitle();
                }
            ])
            ->add('answers', EntityType::class,[
                'class' => Answer::class,
                'choice_label'  => 'label',
                'query_builder' => function(AnswerRepository $answerRepository) use($id) {
                    return $answerRepository->findByQuestionId($id);
                },
                'multiple' => true,
                'expanded' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Question::class,
            'questionId' => null,
        ]);
    }
}
