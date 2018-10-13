<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Exam;
use App\Entity\Question;
use App\Repository\QuestionRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionByCategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category', EntityType::class, array(
                'class' => Category::class,
                'label' => false,
                'compound' => true,
                'choice_label' => 'categoryName',
                'placeholder' => "Choose Category",
                'mapped' => false
            ));
        $builder->get('category')->addEventListener(FormEvents::PRE_SUBMIT, function(FormEvent $event) {
                $category = $event->getData();
                $form = $event->getForm();
                echo '<script>console.log($category)</script>';
                echo '<script>console.log($event)</script>';
                $form->getParent()->add('questions', EntityType::class, array(
                   'class' => Question::class,
                   'label' => false,
                   'compound' => true,
                   'choice_label' => 'questionText',
                   'placeholder' => "Choose Question",
                   'query_builder' => function(QuestionRepository $quesRepo) use ($category) {
                       $quesRepo->findQuestionsByCategory($category);
                   }
                ));
                dump($form);

            });

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Exam::class,
        ]);
    }
}
