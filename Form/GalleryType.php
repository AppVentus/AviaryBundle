<?php

namespace Appventus\AviaryBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Appventus\AviaryBundle\Form\PictureType;

class GalleryType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pictures', 'collection', array(
                'type'         => new PictureType(),
                'allow_add'    => true,
                'allow_delete' => true,
                'by_reference' => false))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Appventus\AviaryBundle\Entity\Gallery'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appventus_aviarybundle_gallery';
    }
}
