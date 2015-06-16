<?php

namespace TK\UserManagerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', 'text')
            ->add('lastName',  'text')
            ->add('age',       'text')
            ->add('email',     'email')
            ->add('userRole',  'entity',         array(
                  'class'    => 'TKUserManagerBundle:UserRole',
                  'property' => 'name'
            ))
            ->add('userAddresses', 'collection', array(
                  'type'               => new UserAddressType(),
                  'cascade_validation' => true,
                  'allow_add'          => true,
                  'allow_delete'       => true,
                  'by_reference'       => false,
            ))
        ;
      // $builder
      //     ->add('firstName', 'text', ['required' => false])
      //     ->add('lastName',  'text', ['required' => false])
      //     ->add('age',       'text', ['required' => false])
      //     ->add('email',     'email', ['required' => false])
      //     ->add('userRole',  'entity',         array(
      //           'class'    => 'TKUserManagerBundle:UserRole',
      //           'property' => 'name'
      //     ))
      //     ->add('userAddresses', 'collection', array(
      //           'type'               => new UserAddressType(),
      //           'cascade_validation' => true,
      //           'allow_add'          => true,
      //           'allow_delete'       => true,
      //           'by_reference'       => false,
      //     ))
      // ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TK\UserManagerBundle\Entity\User',
            'cascade_validation' => true
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'tk_usermanagerbundle_user';
    }
}
