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
class AdminType extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('title',TextType::class, array(
                    //'data'=>'valeur par defaut'
                    ))
                ->add('text', TextareaType::class, array(
                    'attr' => array('class' =>'materialize-textarea')                   
                    //, 'data'=>'valeur par defaut'
                    ))
                ->add('Submit',  SubmitType::class,array('attr' => array('class' =>'waves-effect waves-light btn')));
        
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class'=>'Blog\FrontBundle\Entity\Post'
        ));
    }

}
