<?php

namespace App\Form;

use App\Entity\Answer;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnswerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('answerText' , TextType::class, array(
                'label' => false,
            ))
            ->add('isCorrect', CheckboxType::class, array(
                'label' => "correct answer",
                'required' => false,
                // 'data' => false
            ))
        ;
        $builder
            ->get('isCorrect')
            ->addModelTransformer(new CallbackTransformer(
                function ($isCorrectAsString) {
                    // transform the string to boolean
                    return (bool)(int)$isCorrectAsString;
                },
                function ($isCorrectAsBoolean) {
                    // transform the boolean to string
                    return (string)(int)$isCorrectAsBoolean;
                }
        ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Answer::class,
        ]);
    }
}
