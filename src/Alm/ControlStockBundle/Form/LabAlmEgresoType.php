<?php

namespace Alm\ControlStockBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LabAlmEgresoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $secciones=array('R'=>'RC-IVA','P'=>'PLANILLA','A'=>'ARCHIVO','E'=>'EVALUACION Y CAPACITACION','AFP'=>'AFP','CA'=>'CONTROL ASISTENCIA','SU'=>'SUBSIDIO','S'=>'SECRETARÍA','AL'=>'ASESORIA-LEGAL');
        $builder->add('recibidoPor')->add('seccion','choice',array('choices'=>$secciones));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Alm\ControlStockBundle\Entity\LabAlmEgreso'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'alm_controlstockbundle_labalmegreso';
    }


}
