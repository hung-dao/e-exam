<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Exam;
use App\Entity\Question;
use App\Repository\QuestionRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ExamByAutoCategoriesType extends AbstractType
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

        ;
//
//
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
            'data_class' => Exam::class,
        ]);
    }
}
