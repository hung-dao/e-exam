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
            ->add('questions', EntityType::class, array(
                'class' => Question::class,
                'choice_label' => 'questionText',
                'multiple' => true,
                'expanded' => true,
            ))
            /* try with add question base on category each
             * ->add('questions', CollectionType::class, array(
                'label' => false,
                'entry_type' => QuestionByCategoryType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'compound' => true,

            ))
            ->add('category', CollectionType::class, array(
                'label' => false,
                'entry_type' => EntityType::class,
                'entry_options' => array(
                    'class' => Category::class,
                    'label' => false,
                    'choice_label' => 'categoryName',
                    'placeholder' => "Choose Category",
                ),
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'compound' => true,
                'mapped' => false
            ))*/
        ;

        /*$builder->get('category')->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $event) {
            $category = $event->getData();
            $form = $event->getForm();
            echo '<script>console.log($category)</script>';
            echo '<script>console.log($event)</script>';
            $form->add('questions', EntityType::class, array(
                'class' => Question::class,
                'label' => false,
                'choice_label' => 'questionText',
                'placeholder' => "Choose Question",
                'query_builder' => function(QuestionRepository $quesRepo) use ($category) {
                    $quesRepo->findQuestionsByCategory($category);
                }
            ));
            dump($form);

        });*/
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Exam::class,
        ]);
    }
}
