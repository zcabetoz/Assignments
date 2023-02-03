<?php

namespace UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', 'text')
            ->add('first_name', 'text')
            ->add('last_name', 'text')
            ->add('email', 'email')
            ->add('password', 'password')
            ->add('role', 'choice', array('choices'=>array('ROLE_ADMIN'=>'Administrator','ROLE_USER'=>'User'), 'placeholder'=>'Select one role'))
            ->add('is_active', 'checkbox')
            ->add('save', 'submit', array('label'=>'Save user'))
        ;
    }

    public function getName()
    {
        return 'user';
    }
}