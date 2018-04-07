<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SurfaceType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('surfaceName',EntityType::class,array(
                'class' => 'AppBundle:SurfaceName',

            ))
            ->add('height')
            ->add('width')
            ->add('num1',NumberType::class,array(
                'label'=>'Multiple',
                'required'=>false,

            ))
            ->add('deduction'
                ,ChoiceType::class,array(
                    'choices'=>array(
                        'No'=>'No',
                        'Yes'=> 'Yes',
                    ))
            )
//            ->add('type',ChoiceType::class,array(
//                'choices'=>array(
//                    'Meter 2'=> 'Meter 2',
//                    'Linear M'=>'Linear M'
//                )
//            ))
            ->add('rate')
//            ->add('location')
//            ->add('job')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Surface'
        ));
    }
}
