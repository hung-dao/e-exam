<?php

namespace App\Form;

use App\Entity\Exam;
use App\Entity\Question;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExamByQuestionsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('isPublic', ChoiceType::class, array(
                'label' => 'Public',
                'choices' => array(
                    'Not Decided Yet' => null,
                    'Yes' => true,
                    'No' => false
                )))
            ->add('numberOfQuestions', ChoiceType::class, array(
                'label' => 'Number of questions',
                'choices' => array(
                    '5'=> 5,
                    '6'=> 6,
                    '7'=> 7,
                    '8'=> 8,
                    '9'=> 9,
                    '10'=> 10
                )
            ))
            ->add('questions', CollectionType::class, array(
                'entry_type' => EntityType::class,
                'entry_options' => array(
                    'class' => Question::class,
                    'choice_label' => 'questionText'
                ),
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
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
