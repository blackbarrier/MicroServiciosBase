<?php

namespace App\Form;

use App\Entity\CierreCaja;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CierreCajaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fecha', null, [
                "required" => true,
                "label" => false,
                'data' => new \DateTime(),
                "attr" => [
                    "class" => "form-control",
                    'placeholder' => 'Ingrese un código de producto',
                    'readonly' => true,
                    // "pattern" => "[0-9]{0,20}"
                    // 'data-validation' => 'required custom length',
                    // 'data-validation-regexp' => "^([a-zA-ZáéíóúÁÉÍÓÚñÑçÇäëïöüÄËÏÖÜâêîôûÂÊÎÔÛàèìòùÀÈÌÒÙ\s\']+)$",
                    // 'data-validation-length' => '2-50'
                ],
            ])

            ->add('observaciones', TextType::class, [
                "required" => false,
                "label" => false,
                "attr" => [
                    "class" => "form-control",
                    'placeholder' => 'Observaciones',
                    // "pattern" => "[0-9]{0,20}"
                    // 'data-validation' => 'required custom length',
                    // 'data-validation-regexp' => "^([a-zA-ZáéíóúÁÉÍÓÚñÑçÇäëïöüÄËÏÖÜâêîôûÂÊÎÔÛàèìòùÀÈÌÒÙ\s\']+)$",
                    // 'data-validation-length' => '2-50'
                ],
            ])

            ->add('balance', NumberType::class, [
                "required" => true,
                "label" => false,
                'data' => $options['balance'], // Pasar el balance calculado                
                "attr" => [
                    'readonly' => true,
                    "class" => "form-control",
                    'placeholder' => 'Observaciones',
                    // "pattern" => "[0-9]{0,20}"
                    // 'data-validation' => 'required custom length',
                    // 'data-validation-regexp' => "^([a-zA-ZáéíóúÁÉÍÓÚñÑçÇäëïöüÄËÏÖÜâêîôûÂÊÎÔÛàèìòùÀÈÌÒÙ\s\']+)$",
                    // 'data-validation-length' => '2-50'
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CierreCaja::class,
        ]);

        // Agregar la opción 'balance' como opción válida
        $resolver->setDefined(['balance']);
    }
}
