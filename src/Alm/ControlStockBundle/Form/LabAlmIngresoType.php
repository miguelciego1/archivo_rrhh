<?php

namespace Alm\ControlStockBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LabAlmIngresoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('fechaRecibido','genemu_jquerydate', array(
                      'widget' => 'single_text',
                      'html5' => 'false',
                ))
        ->add('numeroEgresoAlmacen');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Alm\ControlStockBundle\Entity\LabAlmIngreso'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'alm_controlstockbundle_labalmingreso';
    }


}
