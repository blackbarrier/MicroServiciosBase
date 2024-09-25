<?php

namespace App\Form;

use App\Entity\Empleado;
use App\Entity\EstadoEmpleado;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmpleadoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre', TextType::class, [
                "required" => true,
                "label" => "Nombre",
                "attr" => [
                    "class" => "form-control",
                    'placeholder' => 'Nombre del empleado'                    
                ],
            ])

            // ->add('legajo', NumberType::class, [
            //     "required" => true,
            //     "label" => "Legajo",
            //     "attr" => [
            //         "class" => "form-control",
            //         'placeholder' => 'Legajo asi'
            //     ],
            // ])

            ->add('estado', EntityType::class, [
                'class' => EstadoEmpleado::class,
                'choice_label' => 'nombre',
                "required" => true,
                "label" => "Estado",
                "attr" => [
                    "class" => "form-control",
                    'placeholder' => 'Seleccione un estado'
                ],
            ])

            ->add('dni', NumberType::class, [
                "required" => true,
                "label" => "DNI",
                "attr" => [
                    "class" => "form-control",
                    'placeholder' => 'DNI empleado'
                ],
            ])

            ->add('telefono', TextType::class, [
                "required" => true,
                "label" => "Teléfono",
                "attr" => [
                    "class" => "form-control",
                    'placeholder' => 'Ingrese un teléfono válido'
                ],
            ])

            ->add('direccion', TextType::class, [
                "required" => true,
                "label" => "Direccíon",
                "attr" => [
                    "class" => "form-control",
                    'placeholder' => 'Ingrese la dirección del empleado'
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Empleado::class,
        ]);
    }
}
