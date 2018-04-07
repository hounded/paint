<?php

namespace AppBundle\Form;

use Braincrafted\Bundle\BootstrapBundle\Form\Type\BootstrapCollectionType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SurfaceMultiType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('surfaceName',BootstrapCollectionType::class,array(
                'entry_type'=>SurfaceType::class,
                'label'=>false,
                'allow_add'             => true,
                'allow_delete'          => true,
                'add_button_text'       => 'Add item',
                'delete_button_text'    => 'Delete item',
                'sub_widget_col'        => 10,
                'button_col'            => 2,
            ))
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
