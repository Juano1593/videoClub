<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Peliculas;

class CrearAlquiler extends AbstractType{


    public function buildForm(FormBuilderInterface $builder, array $options){

        $builder->add('id_peliculas', ChoiceType::class, array(
            'label' => 'Pelicula',
            'choices' => array(
                'El Origen' => 1,
                'Lightyear' => 2,
                'Thor Amor y trueno' => 3,
                'Hannibal' => 4
            )
        ))
        // ->add('valor_total', TextType::class, array(
        //     'label' => 'Valor Total'
        // ))
        ->add('fecha_inicio', DateType::class, array(
            'label' => 'Fecha Inicio'
        ))
        ->add('fecha_fin', DateType::class, array(
            'label' => 'Fecha Fin'
        ))
        ->add('cliente', ChoiceType::class, array(
            'label' => 'Cliente',
            'choices' => array(
                'Juan Camilo' => 'Juan Camilo',
                'Pablo' => 'Pablo',
                'Mario Bros' => 'Mario Bros'
            )
        ))
        ->add('submit', SubmitType::class, array(
            'label' => 'Agregar'
        ));
        

    }

}