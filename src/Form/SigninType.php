<?php

namespace App\Form;

use App\DTO\SigninDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SigninType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', NULL, [
                'label' => 'Username'
            ])
            ->add('email', \Symfony\Component\Form\Extension\Core\Type\EmailType::class, [
                'label' => 'Email',
                'required' => true,
            ])
            ->add('password', \Symfony\Component\Form\Extension\Core\Type\RepeatedType::class, [
                'type' => \Symfony\Component\Form\Extension\Core\Type\PasswordType::class,
                'invalid_message' => 'The password fields must match.',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options'  => ['label' => 'Password'],
                'second_options' => ['label' => 'Repeat Password'],
            ])
            ->add('submit', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, [
                'label' => 'Submit'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SigninDTO::class,
        ]);
    }
}
