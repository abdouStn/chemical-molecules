<?php

namespace ChemicalsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Mapping\ClassMetadata;
//use Symfony\Component\Validator\Constraints as Assert;

/**
 * Element from periodic table.
 *
 * @ORM\Table(name="chemicals_element")
 * @ORM\Entity(repositoryClass="ChemicalsBundle\Repository\ElementRepository")
 */
class Element
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="formula", type="string", length=255, unique=true)
     */
    private $formula;

    /**
     * @var string
     *
     * @ORM\Column(name="mass", type="string", length=255, unique=false)
     */
    private $mass;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Element
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get mass.
     *
     * @return string
     */
    public function getMass()
    {
        return $this->mass;
    }

    /**
     * Set mass.
     *
     * @param type $mass
     */
    public function setMass($mass)
    {
        $this->mass= $mass;
    }

    /**
     * Set formula
     *
     * @param string $formula
     *
     * @return Element
     */
    public function setFormula($formula)
    {
        $this->formula = $formula;

        return $this;
    }

    /**
     * Get formula
     *
     * @return string
     */
    public function getFormula()
    {
        return $this->formula;
    }
    
    public function __toString()
    {
        return $this->getName() . '(' . $this->getFormula() . ')';
    }
    
    /**
     * Validation method.
     * 
     * @param \ChemicalsBundle\Form\ClassMetadata $metadata
     */
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        /*
        // Utiliser en bonus : https://jqueryvalidation.org/documentation/
        // https://www.pierrefay.com/fr/blog/jquery-validate-formulaire-validation-tutoriel.html
        $metadata->addPropertyConstraint('formula', new Assert\Choice(array(
            'choices' => ['option1', 'option2', 'optionn'],
            'message' => 'Choose a valid formula.',
        )));
        $metadata->addPropertyConstraint('name', new Assert\NotBlank());
        $metadata->addPropertyConstraint(
            'name',
            new Assert\Length(array("min" => 3))
        );
        $metadata->addGetterConstraint('nameAuthorized', new Assert\IsTrue(array(
            'message' => 'The password cannot match your first name',
        )));
        */
    }
}
