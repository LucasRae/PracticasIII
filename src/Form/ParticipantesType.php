<?php

namespace App\Form;

use App\Entity\Participantes;
use App\Entity\Obra;
use App\Entity\Persona;
use App\Entity\Rol;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParticipantesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('obra', EntityType::class, [
                'class' => Obra::class,
                'choice_label' => 'titulo', // Usá el campo que quieras mostrar
                'placeholder' => 'Seleccione una obra',
                'label' => 'Obra',
            ])
            ->add('persona', EntityType::class, [
                'class' => Persona::class,
                'choice_label' => function (Persona $persona) {
                    return $persona->getNombre() . ' ' . $persona->getApellido();
                },
                'placeholder' => 'Seleccione una persona',
                'label' => 'Persona',
            ])
            ->add('rol', EntityType::class, [
                'class' => Rol::class,
                'choice_label' => 'nombre', // o cualquier campo significativo
                'placeholder' => 'Seleccione un rol',
                'label' => 'Rol',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Participantes::class,
        ]);
    }
}
