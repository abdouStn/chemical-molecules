<?php

namespace ChemicalsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use ChemicalsBundle\Form\AtomsGroupType;

class MoleculeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('formula')
            ->add('atomsGroups')
        ;
        $builder->add('atomsGroups', CollectionType::class, array(
            'entry_type' => AtomsGroupType::class,
            'allow_add'    => true,
            'allow_delete' => true,
        ));
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ChemicalsBundle\Entity\Molecule'
        ));
    }
}
