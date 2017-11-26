<?php

namespace ChemicalsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use ChemicalsBundle\Form\AtomType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class AtomsGroupType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $positionValues = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
        
        $builder
            ->add('name', TextType::class, [
            ])
            ->add('position', ChoiceType::class, [
                'choices' => $positionValues,
            ])
        ;
        $builder->add('mainAtom', AtomType::class);
        $builder->add('atoms', CollectionType::class, array(
            'entry_type' => AtomType::class,
            'allow_add'  => true,
            'allow_delete' => true,
            'by_reference' => false,
        ));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ChemicalsBundle\Entity\AtomsGroup'
        ));
    }
}
