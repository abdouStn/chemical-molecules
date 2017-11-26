<?php

namespace ChemicalsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use ChemicalsBundle\Repository\ElementRepository;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class AtomType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('element', EntityType::class, [
                'class' => 'ChemicalsBundle:Element',
                'query_builder' => function (ElementRepository $er) {
                    return $er->getElementsOderedByNameForForms();
                },
            ])
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ChemicalsBundle\Entity\Atom'
        ));
    }
}
