<?php

namespace Blog\FrontBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

/**
 * Description of LivreType
 *
 * @author adelaunay
 */
class AdminDeleteType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
        ->add('title', EntityType::class, array(
        'class' => 'FrontBundle:Comment'
        ,'choice_label' => 'title'
        ,'attr' => array('class' =>'input-field')                   
        //, 'data'=>'valeur par defaut'
        ))
        ->add('submit', SubmitType::class, array('attr' => array(
            'class' => 'waves-effect waves-light btn tooltipped',
            'data-position'=> "right",
            'data-delay' =>"50",
            'data-tooltip'=>"Ceci est un bouton qui va supprimer ce commentaire"
            )));
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Blog\FrontBundle\Entity\Post'
        ));
    }

}
