<?php

namespace AppBundle\Form;

use Braincrafted\Bundle\BootstrapBundle\Form\Type\BootstrapCollectionType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdditionalItemsMultiType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description',BootstrapCollectionType::class,array(
                'entry_type'=> AdditionalItemsType::class,
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
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\AdditionalItems'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_additionalitems';
    }


}
