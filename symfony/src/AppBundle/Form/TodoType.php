<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TodoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array('attr' => array(
                'class' => 'form-control',
                'title' => 'Enter the label',
            )))
            ->add('description', TextareaType::class, array('attr' => array(
                'class' => 'form-control',
                'title' => 'Enter the description',
            )))
            ->add('dueDate', DateTimeType::class, array('attr' => array(
                'class' => 'formcontrol',
                'title' => 'Select the due date'
            )))
            ->add('save', SubmitType::class, array(
                'label' => 'Save task',
                'attr' => array(
                    'class' => 'btn btn-primary',
                    'title' => 'Save task'
                )
            ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Todo'
        ));
    }
}
