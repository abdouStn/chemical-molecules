<?php

namespace ChemicalsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ChemicalsBundle\Entity\AtomsGroup;
use ChemicalsBundle\Utils\Extractor;

/**
 * Molecule.
 *
 * @ORM\Table(name="chemicals_molecule")
 * @ORM\Entity(repositoryClass="ChemicalsBundle\Repository\MoleculeRepository")
 */
class Molecule extends Extractor
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
     * @var string
     *
     * @ORM\Column(name="formula", type="string", length=255)
     */
    private $formula;
    
    /**
     * @ORM\OneToMany(targetEntity="AtomsGroup", mappedBy="molecule", cascade={"persist", "remove"})
     */
    protected $atomsGroups;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->atomsGroups = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Molecule
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
     * Set formula
     *
     * @param string $formula
     *
     * @return Molecule
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

    /**
     * Add atomsGroup
     *
     * @param \ChemicalsBundle\Entity\AtomsGroup $atomsGroup
     *
     * @return Molecule
     */
    public function addAtomsGroup(\ChemicalsBundle\Entity\AtomsGroup $atomsGroup)
    {
        $this->atomsGroups[] = $atomsGroup;

        return $this;
    }

    /**
     * Add atomsGroup
     *
     * @param \Doctrine\Common\Collections\ArrayCollection $atomsGroups
     *
     * @return Molecule
     */
    public function setAtomsGroups(\Doctrine\Common\Collections\ArrayCollection $atomsGroups)
    {
        $this->atomsGroups = $atomsGroups;

        return $this;
    }

    /**
     * Remove atomsGroups
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
    
    public function __toString()
    {
        return $this->getName() . '(' . $this->getFormula() . ')';
    }
}
