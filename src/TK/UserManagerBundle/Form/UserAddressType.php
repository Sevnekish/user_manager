<?php

namespace TK\UserManagerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserAddressType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('zip',     'text', array(
                  'attr'=> array('class'=>'zip')
            ))
            ->add('city',    'text', array(
                  'attr'=> array('class'=>'city')
            ))
            ->add('address', 'text', array(
                  'attr'=> array('class'=>'address')
            ))
        ;
        // $builder
        //     ->add('zip',     'text', array(
        //           'required' => false,
        //           'attr'=> array('class'=>'zip')
        //     ))
        //     ->add('city',    'text', array(
        //           'required' => false,
        //           'attr'=> array('class'=>'city')
        //     ))
        //     ->add('address', 'text', array(
        //           'required' => false,
        //           'attr'=> array('class'=>'address')
        //     ))
        // ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TK\UserManagerBundle\Entity\UserAddress'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'tk_usermanagerbundle_useraddress';
    }
}
