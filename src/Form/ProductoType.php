<?php

namespace App\Form;

use App\Entity\Producto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
        ->add('codigo', TextType::class, [
                "required" => true,
                "label" => "Código",
                "attr" => [
                    "class" => "form-control",
                    'placeholder' => 'Ingrese un código de producto',
                    // "pattern" => "[0-9]{0,20}"
                    // 'data-validation' => 'required custom length',
                    // 'data-validation-regexp' => "^([a-zA-ZáéíóúÁÉÍÓÚñÑçÇäëïöüÄËÏÖÜâêîôûÂÊÎÔÛàèìòùÀÈÌÒÙ\s\']+)$",
                    // 'data-validation-length' => '2-50'
                ],
            ])
        ->add('nombre', TextType::class, [
                "required" => true,
                "label" => "Nombre",
                "attr" => [
                    "class" => "form-control",
                    'placeholder' => 'Ingrese el nombre del producto',
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
                    'placeholder' => 'Ingrese la descripción del producto',
                    // 'data-validation' => 'required custom length',
                    // 'data-validation-regexp' => "^([a-zA-ZáéíóúÁÉÍÓÚñÑçÇäëïöüÄËÏÖÜâêîôûÂÊÎÔÛàèìòùÀÈÌÒÙ\s\']+)$",
                    // 'data-validation-length' => '2-50'
                ],
            ])
        ->add('precio', NumberType::class, [
                "required" => true,
                "label" => "Precio",
                "attr" => [
                    "class" => "form-control",
                    'placeholder' => 'Ingrese el precio',
                    "maxlength" => 20,  
                    // "minlength" => 1,  
                    "pattern" => "[0-9]{0,20}"
                    // 'data-validation' => 'required custom length',
                    // 'data-validation-regexp' => "^([a-zA-ZáéíóúÁÉÍÓÚñÑçÇäëïöüÄËÏÖÜâêîôûÂÊÎÔÛàèìòùÀÈÌÒÙ\s\']+)$",
                    // 'data-validation-length' => '2-50'
                ],
            ])
        ->add('stock', NumberType::class, [
                "required" => false,
                "label" => "Stock",
                "attr" => [
                    "class" => "form-control",
                    'placeholder' => 'Ingrese un stock (Opcional)',
                    "maxlength" => 20,  
                    "pattern" => "[0-9]{0,20}"
                    // 'data-validation' => 'required custom length',
                    // 'data-validation-regexp' => "^([a-zA-ZáéíóúÁÉÍÓÚñÑçÇäëïöüÄËÏÖÜâêîôûÂÊÎÔÛàèìòùÀÈÌÒÙ\s\']+)$",
                    // 'data-validation-length' => '2-50'
                ],
            ])
            
          
        
        // ->add('imagen', FileType::class, [
        //         "required" => false,
        //         "label" => "Imagen producto",
        //         "attr" => [
        //             "class" => "form-control",
        //             // 'placeholder' => 'Ingrese un stock (Opcional)',
        //             // 'data-validation' => 'required custom length',
        //             // 'data-validation-regexp' => "^([a-zA-ZáéíóúÁÉÍÓÚñÑçÇäëïöüÄËÏÖÜâêîôûÂÊÎÔÛàèìòùÀÈÌÒÙ\s\']+)$",
        //             // 'data-validation-length' => '2-50'
        //         ],
        //     ])
            
          
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Producto::class,
        ]);
    }
}
