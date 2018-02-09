<?php

namespace Cps\Personal\ArchivoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class busfunType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('filtro',  'genemu_jqueryautocomplete_entity', array(
                 'class' => 'Cps\Personal\ArchivoBundle\Entity\Empleado',
                 'property' => 'busajax','label' => 'Funcionario',
        ))
        ;
    }
}