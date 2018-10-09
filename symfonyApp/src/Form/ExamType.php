<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Exam;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExamType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category', EntityType::class, array(
                'class' => Category::class,
                'choice_label' => 'categoryName'
            ))
            ->add('isPublic', ChoiceType::class, array(
                'choices' => array(
                    'Not Decided Yet' => null,
                    'Yes' => true,
                    'No' => false
                )))
            ->add('user')
            ->add('numberOfQuestions', ChoiceType::class, array(
                'choices' => array(
                    5 => 5,
                    6 => 6,
                    7 => 7,
                    8 => 8,
                    9 => 9,
                    10 => 10
                )
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Exam::class,
        ]);
    }
}
