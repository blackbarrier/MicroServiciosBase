<?php

namespace App\Form;

use App\Entity\Proveedor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProveedorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('nombre', TextType::class, [
                "required" => true,
                "label" => "Nombre",
                "attr" => [
                    "class" => "form-control",
                    'placeholder' => 'Ingrese un nombre del proveedor',
                    // "pattern" => "[0-9]{0,20}"
                    // 'data-validation' => 'required custom length',
                    // 'data-validation-regexp' => "^([a-zA-ZáéíóúÁÉÍÓÚñÑçÇäëïöüÄËÏÖÜâêîôûÂÊÎÔÛàèìòùÀÈÌÒÙ\s\']+)$",
                    // 'data-validation-length' => '2-50'
                ],
            ])

            ->add('descripcion', TextType::class, [
                "required" => true,
                "label" => "Descripción",
                "attr" => [
                    "class" => "form-control",
                    'placeholder' => 'Ingrese descripción del proveedor',
                    // "pattern" => "[0-9]{0,20}"
                    // 'data-validation' => 'required custom length',
                    // 'data-validation-regexp' => "^([a-zA-ZáéíóúÁÉÍÓÚñÑçÇäëïöüÄËÏÖÜâêîôûÂÊÎÔÛàèìòùÀÈÌÒÙ\s\']+)$",
                    // 'data-validation-length' => '2-50'
                ],
            ])
            ->add('cuit', TextType::class, [
                "required" => true,
                "label" => "CUIT",
                "attr" => [
                    "class" => "form-control",
                    'placeholder' => 'Ingrese cuit del proveedor',
                    // "pattern" => "[0-9]{0,20}"
                    // 'data-validation' => 'required custom length',
                    // 'data-validation-regexp' => "^([a-zA-ZáéíóúÁÉÍÓÚñÑçÇäëïöüÄËÏÖÜâêîôûÂÊÎÔÛàèìòùÀÈÌÒÙ\s\']+)$",
                    // 'data-validation-length' => '2-50'
                ],
            ])
            ->add('telefono', TextType::class, [
                "required" => true,
                "label" => "Contacto",
                "attr" => [
                    "class" => "form-control",
                    'placeholder' => 'Ingrese un teléfono del proveedor',
                    // "pattern" => "[0-9]{0,20}"
                    // 'data-validation' => 'required custom length',
                    // 'data-validation-regexp' => "^([a-zA-ZáéíóúÁÉÍÓÚñÑçÇäëïöüÄËÏÖÜâêîôûÂÊÎÔÛàèìòùÀÈÌÒÙ\s\']+)$",
                    // 'data-validation-length' => '2-50'
                ],
            ])
            ->add('direccion', TextType::class, [
                "required" => true,
                "label" => "Dirección",
                "attr" => [
                    "class" => "form-control",
                    'placeholder' => 'Ingrese la direccion del proveedor',
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
            'data_class' => Proveedor::class,
        ]);
    }
}
