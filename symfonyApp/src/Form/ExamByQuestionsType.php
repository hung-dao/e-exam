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
            ->add('questions', EntityType::class, array(
                'class' => Question::class,
                'choice_label' => 'questionText',
                'multiple' => true,
                'expanded' => true,
            ))

/*            ->add('questions', CollectionType::class, array(
                'entry_type' => EntityType::class,
                'entry_options' => array(
                    'class' => Question::class,
                    'choice_label' => 'questionText'
                ),
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ))
*/
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
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Exam::class,
        ]);
    }
}