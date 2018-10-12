<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Exam;
use App\Entity\Question;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExamByCategoriesType extends AbstractType
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
            ->add('category', EntityType::class, array(
                'label' => 'Category',
                'class' =>'App\Entity\Category',
                'mapped' =>false,
                'placeholder' => "Please select category",
                'choice_label' => 'categoryName'
            ))
            ->add('numberOfQuestions', ChoiceType::class, array(
                'label' => 'Number of questions',
                'choices' => array(
                    5 => 5,
                    6 => 6,
                    7 => 7,
                    8 => 8,
                    9 => 9,
                    10 => 10
                )
            ))
            ->add('questions', CollectionType::class, array(
                'label'=> false,
                'entry_type' => EntityType::class,
                'entry_options' => array(
                    'class' => Question::class,
                    'choice_label' => 'questionText'
                ),
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ));
        $builder->get('category')->addEventListener(
          FormEvents::POST_SUBMIT,
            function (FormEvent $event)
          {
              $form = $event->getForm();
                dump($form->getData());
//              $form->getParent()->add('questions', EntityType::class, [
//                  'class' => 'App\Entity\Question',
//                  'placeholder' => 'Please select question',
//                  'choices' => $form->getData()->getQuestions()
//              ]);
          }
        );


    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
            'data_class' => Exam::class,
        ]);
    }
}
