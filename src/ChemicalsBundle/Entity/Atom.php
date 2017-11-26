<?php

namespace ChemicalsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ChemicalsBundle\Entity\Element;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\IsTrue;

/**
 * Atom
 *
 * @ORM\Table(name="chemicals_atom")
 * @ORM\Entity(repositoryClass="ChemicalsBundle\Repository\AtomRepository")
 */
class Atom
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var type Element
     *
     * @ORM\ManyToOne(targetEntity="Element")
     * @ORM\JoinColumn(name="element_id", referencedColumnName="id")
     */
    private $element;

    /**
     * @TODO : à revoir.
     * @ORM\OneToMany(targetEntity="AtomsGroup", mappedBy="mainAtom")
     */
    private $atomsGroups;
    
    /**
     * @var ArrayCollection Produit $clients
     *
     * Inverse Side
     *
     * @ORM\ManyToMany(targetEntity="AtomsGroup", mappedBy="atoms")
     */
    private $atomsGroupsComponents;
  
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->atomsGroups = new \Doctrine\Common\Collections\ArrayCollection();
        $this->atomsGroupsComponents = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * @return Atom
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
     * Set element
     *
     * @param \ChemicalsBundle\Entity\Element $element
     *
     * @return Atom
     */
    public function setElement(\ChemicalsBundle\Entity\Element $element = null)
    {
        $this->element = $element;

        return $this;
    }

    /**
     * Get element
     *
     * @return \ChemicalsBundle\Entity\Element
     */
    public function getElement()
    {
        return $this->element;
    }

    /**
     * Add atomsGroup
     *
     * @param \ChemicalsBundle\Entity\AtomsGroup $atomsGroup
     *
     * @return Atom
     */
    public function addAtomsGroup(\ChemicalsBundle\Entity\AtomsGroup $atomsGroup)
    {
        $this->atomsGroups[] = $atomsGroup;

        return $this;
    }

    /**
     * Remove atomsGroup
     *
     * @param \ChemicalsBundle\Entity\AtomsGroup $atomsGroup
     */
    public function removeAtomsGroup(\ChemicalsBundle\Entity\AtomsGroup $atomsGroup)
    {
        $this->atomsGroups->removeElement($atomsGroup);
    }

    /**
     * Get atomsGroups
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAtomsGroups()
    {
        return $this->atomsGroups;
    }

    /**
     * Add atomsGroupsComponent
     *
     * @param \ChemicalsBundle\Entity\AtomsGroup $atomsGroupsComponent
     *
     * @return Atom
     */
    public function addAtomsGroupsComponent(\ChemicalsBundle\Entity\AtomsGroup $atomsGroupsComponent)
    {
        $this->atomsGroupsComponents[] = $atomsGroupsComponent;

        return $this;
    }

    /**
     * Remove atomsGroupsComponent
     *
     * @param \ChemicalsBundle\Entity\AtomsGroup $atomsGroupsComponent
     */
    public function removeAtomsGroupsComponent(\ChemicalsBundle\Entity\AtomsGroup $atomsGroupsComponent)
    {
        $this->atomsGroupsComponents->removeElement($atomsGroupsComponent);
    }

    /**
     * Get atomsGroupsComponents
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAtomsGroupsComponents()
    {
        return $this->atomsGroupsComponents;
    }
    
    public function __toString()
    {
        return $this->getName();
    }
    
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('name', new NotBlank([
            'message' => 'Name of the atom can not be null',
        ]));
        $metadata->addGetterConstraint('nameAuthorized', new IsTrue([
            'message' => 'The name cannot be "toto"',
        ]));
            
    }
    
    public function isNameAuthorized()
    {
        return !in_array($this->name, ["toto"]);
    }
}
