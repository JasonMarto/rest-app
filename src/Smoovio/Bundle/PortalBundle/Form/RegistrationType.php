<?php

namespace Smoovio\Bundle\PortalBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username', TextType::class);
        $builder->add('email', EmailType::class);
        $builder->add('password', RepeatedType::class, array(
            'first_name'  => 'password',
            'second_name' => 'confirm',
            'type'        => PasswordType::class,
        ));
        $builder->add('terms', CheckboxType::class, array('property_path' => 'termsAccepted'));
        $builder->add('Sign Up!', SubmitType::class);
    }

    public function getName()
    {
        return 'smoovio_core_registration_form';
    }
}
