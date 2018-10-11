<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Question;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionType extends AbstractType
{
    private $userLogin = \Symfony\Component\Security\Core\User\User::class;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('questionText', TextareaType::class, array(
                'label' => 'Question'
            ))
            ->add('category', EntityType::class, array(
                'class' => Category::class,
                'choice_label' => 'categoryName'
            ))
            ->add('answers', CollectionType::class, array(
                'entry_type' => AnswerType::class,
                'entry_options' => array('label' => false),
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Question::class,
        ]);
    }
}
