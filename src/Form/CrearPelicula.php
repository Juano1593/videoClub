<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CrearPelicula extends AbstractType{


    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder->add('nombre', TextType::class, array(
            'label' => 'Nombre'
        ))
        ->add('sinopsis', TextType::class, array(
            'label' => 'Sinopsis'
        ))
        ->add('precio_unitario', TextType::class, array(
            'label' => 'Precio Unitario'
        ))
        ->add('tipo', TextType::class, array(
            'label' => 'Tipo'
        ))
        ->add('fecha_estreno', DateType::class, array(
            'label' => 'Fecha Estreno'
        ))
        ->add('categoria', TextType::class, array(
            'label' => 'Categoria'
        ))
        ->add('submit', SubmitType::class, array(
            'label' => 'Agregar'
        ));
        

    }

}