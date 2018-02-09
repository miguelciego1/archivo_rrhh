<?php

namespace Cps\Personal\ArchivoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class archivoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
          //  ->add('fecha', 'datetime')
          ->add('nroempleado',  'genemu_jqueryautocomplete_entity', array(
               'class' => 'Cps\Personal\ArchivoBundle\Entity\Empleado',
               'property' => 'busajax','label' => 'Funcionario',))

            ->add('glosa', 'textarea', array('label'=>'Observacion', 'required'  => false))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cps\Personal\ArchivoBundle\Entity\archivo'
        ));
    }
}
// ->add('nroempleado', 'entity', array(
//        'label'=>'funcionario',
//        'class' => 'CpsPerArchivoBundle:Empleado',
//        'query_builder' => function(\Doctrine\ORM\EntityRepository $er) {
//            return $er->createQueryBuilder('m')
//                ->where('m.activo = 1')
//                ->andWhere('m.expdate > CURRENT_DATE()')
//                ->orderBy('m.name', 'ASC');
//            },
//        ))
