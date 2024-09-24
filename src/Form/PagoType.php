<?php

namespace App\Form;

use App\Entity\Pago;
use App\Entity\Proveedor;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PagoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fecha', DateTimeType::class, [
                'widget' => 'single_text',
                'data' => new \DateTime(),
                'attr' => [
                    // 'readonly' => true
                ]
            ])

            ->add('monto', MoneyType::class, [
                'currency' => false,
                'attr' => [
                    'placeholder' => "$"
                ],
                'scale' => 2, // Dos decimales de precisión
                'html5' => true, // Para asegurar el soporte de validación HTML5
            ])

            ->add('proveedor', EntityType::class, [
                'class' => Proveedor::class,
                'choice_label' => 'nombre',
                'placeholder' => 'Seleccione un proveedor',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pago::class,
        ]);
    }
}
