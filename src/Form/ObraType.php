<?php

namespace App\Form;

use App\Entity\Obra;
use App\Entity\Genero;
use App\Entity\Tipo;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ObraType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Titulo')
            ->add('Sinopsis')
            ->add('Fecha_salida', DateType::class, [
                'widget' => 'single_text',
                'required' => false,
                'label' => 'Fecha de salida',
            ])            
            ->add('Portada')
            ->add('Tipo', EntityType::class, [
                'class' => Tipo::class,
                'choice_label' => 'nombre', // o usá __toString() si ya lo agregaste
                'placeholder' => 'Seleccioná un tipo',
                'required' => false,
            ])
            ->add('Genero', EntityType::class, [
                'class' => Genero::class,
                'choice_label' => 'nombre', // o el campo que tengas en Genero
                'multiple' => true,
                'expanded' => true, // true = checkboxes; false = select múltiple
                'label' => 'Géneros',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Obra::class,
        ]);
    }
}
