<?php
namespace DemoBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Description of LivreType
 *
 * @author sollivier
 */
class CommentType extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('titre',TextType::class)
                ->add('dateParution',  DateType::class)
                ->add('categorie',EntityType::class,array(
                    'class'=>'DemoBundle:Categorie',
                    'choice_label'=>'libelle'
                ))
                ->add('ajouter',  SubmitType::class)
                ->add('sauverEtAjouter',  SubmitType::class);
        
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class'=>'DemoBundle\Entity\Livre'
        ));
    }

}