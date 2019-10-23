<?php


namespace App\Form;


use App\DTO\FormDTO;
use App\Entity\ChoiceClass;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InputForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('url', TextType::class)
            ->add('choices', ChoiceType::class, [
                'choices' => [
                    'title' => new ChoiceClass('title'),
                    'description' => new ChoiceClass('description'),
                    'links' => new ChoiceClass('a'),
                    'h1' => new ChoiceClass('h1'),
                ],
                'choice_label' => function(ChoiceClass $choiceClass) {
                    return $choiceClass->getName();
                },
                'multiple' => true,
                'expanded' => true
            ])
            ->add('submit', SubmitType::class)
            ->getForm();
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => FormDTO::class,
        ));
    }
}
