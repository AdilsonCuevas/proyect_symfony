<?php

namespace App\Form;

use App\Entity\Usuarios;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class UsuariosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('FirstName', TextType::class, [
                'label' => 'Nombres',
                'attr' => [
                    'placeholder' => 'Nombres',
                    'autocomplete' => 'off',
                    'class' => 'form-control',
                    'required' => true
                ]
            ])
            ->add('LastName', TextType::class, [
                'label' => 'Apellido(s)',
                'attr' => [
                    'placeholder' => 'Apellido(s)',
                    'autocomplete' => 'off',
                    'class' => 'form-control',
                    'required' => true
                ]
            ])
            ->add('Nit', NumberType::class, [
                'label' => 'No. Identificacion',
                'attr' => [
                    'placeholder' => '1234567',
                    'autocomplete' => 'off',
                    'class' => 'form-control',
                    'required' => true
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Correo electronico',
                'attr' => [
                    'placeholder' => 'nombre@dominio.com',
                    'autocomplete' => 'off',
                    'class' => 'form-control',
                    'required' => true
                ]
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Contraseña',
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => '*************',
                    'autocomplete' => 'off',
                    'class' => 'form-control',
                    'autocomplete' => 'new-password',
                    'required' => false
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Guardar',
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Usuarios::class,
        ]);
    }
}
