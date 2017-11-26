<?php

namespace ChemicalsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AtomsGroup
 *
 * @ORM\Table(name="chemicals_atoms_group")
 * @ORM\Entity(repositoryClass="ChemicalsBundle\Repository\AtomsGroupRepository")
 */
class AtomsGroup
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    
    /**
     * @var Atom $mainAtome 
     *
     * @ORM\ManyToOne(targetEntity="Atom", inversedBy="atomsGroups", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="main_atom_id", referencedColumnName="id")
     */
    private $mainAtom;

    /**
     * @var ArrayCollection Atom $atoms
     *
     * Owning Side
     *
     * @ORM\ManyToMany(targetEntity="Atom", inversedBy="atomsGroupsComponents", cascade={"persist", "remove"})
     * @ORM\JoinTable(name="chemicals_bound_atoms",
     *   joinColumns={@ORM\JoinColumn(name="atoms_group_id", referencedColumnName="id")},
     *   inverseJoinColumns={@ORM\JoinColumn(name="atom_id", referencedColumnName="id")}
     * )
     */
    private $atoms;

    /**
     * @var Molecule $molecule
     *
     * @ORM\ManyToOne(targetEntity="Molecule", inversedBy="atomsGroups", cascade={"persist", "merge", "remove"})
     * @ORM\JoinColumn(name="molecule_id", referencedColumnName="id")
     */
    private $molecule;

    /**
     * @var string
     *
     * @ORM\Column(name="position", type="integer")
     */
    private $position;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->atoms = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return AtomsGroup
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set position
     *
     * @param integer $position
     *
     * @return AtomsGroup
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set mainAtom
     *
     * @param \ChemicalsBundle\Entity\Atom $mainAtom
     *
     * @return AtomsGroup
     */
    public function setMainAtom(\ChemicalsBundle\Entity\Atom $mainAtom = null)
    {
        $this->mainAtom = $mainAtom;

        return $this;
    }

    /**
     * Get mainAtom
     *
     * @return \ChemicalsBundle\Entity\Atom
     */
    public function getMainAtom()
    {
        return $this->mainAtom;
    }

    /**
     * Add atom
     *
     * @param \ChemicalsBundle\Entity\Atom $atom
     *
     * @return AtomsGroup
     */
    public function addAtom(\ChemicalsBundle\Entity\Atom $atom)
    {
        $atom->addAtomsGroupsComponent($this);
        $this->atoms[] = $atom;

        return $this;
    }

    /**
     * Remove atom
     *
     * @param \ChemicalsBundle\Entity\Atom $atom
     */
    public function removeAtom(\ChemicalsBundle\Entity\Atom $atom)
    {
        $this->atoms->removeElement($atom);
    }

    /**
     * Get atoms
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAtoms()
    {
        return $this->atoms;
    }

    /**
     * Set molecule
     *
     * @param \ChemicalsBundle\Entity\Molecule $molecule
     *
     * @return AtomsGroup
     */
    public function setMolecule(\ChemicalsBundle\Entity\Molecule $molecule = null)
    {
        $this->molecule = $molecule;

        return $this;
    }
    
    /**
     * Remove molecule.
     */
    public function removeMolecule()
    {
        $this->molecule = null;
    }

    /**
     * Get molecule
     *
     * @return \ChemicalsBundle\Entity\Molecule
     */
    public function getMolecule()
    {
        return $this->molecule;
    }
    
    public function __toString()
    {
        return $this->getName();
    }
}
