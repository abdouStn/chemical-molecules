<?php
namespace ChemicalsBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

use ChemicalsBundle\Entity\Element;
use ChemicalsBundle\Entity\Atom;
use ChemicalsBundle\Entity\AtomsGroup;
use ChemicalsBundle\Entity\Molecule;

/**
 * Fixture to load sample data.
 *
 * Implements ContainerAwareInterface to be able to get the
 * services.
 */
class LoadChemicalsData implements FixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $this->generateElements();
        $this->generateMolecule();
    }
    
    protected function generateElements()
    {
        $ws = $this->container->get("chemicals.periodic.helper");
        $periodicElements = $ws->getPeriodicElements();

        if (!empty($periodicElements)) {
            $em = $this->container->get('doctrine')->getManager();
            foreach ($periodicElements as $formula => $data) {
                $element = new Element();
                $element->setFormula($formula);
                $element->setName($data['name']);
                $element->setMass($data['mass']);
                $em->persist($element);
            }
            $em->flush();
        }
    }
    
    protected function generateMolecule()
    {
        $em = $this->container->get('doctrine')->getManager();
        $elementRepository = $this
            ->container
            ->get('doctrine')
            ->getRepository('ChemicalsBundle:Element');
            
        $molecule = new Molecule();
        $molecule->setFormula("CH4-NH2");
        $molecule->setName("Methane");

        $c = $elementRepository->findByFormula("C")[0];
        $h = $elementRepository->findByFormula("H")[0];
        $n = $elementRepository->findByFormula("N")[0];

        $cAtome = new Atom();
        $cAtome->setElement($c);
        $cAtome->setName($c->getName());

        $nAtome = new Atom();
        $nAtome->setElement($n);
        $nAtome->setName($n->getName());
            
        $atoms = [];
        $atoms2 = [];
        $atom2 = new Atom();
        $atom2->setElement($h);
        $atom2->setName($h->getName());
        $atoms2[] = $atom2;
        $atom2 = new Atom();
        $atom2->setElement($h);
        $atom2->setName($h->getName());
        $atoms2[] = $atom2;

        $atomsGroup = new AtomsGroup();
        $atomsGroup->setMainAtom($cAtome);
        $atomsGroup->setName("CH4");
        $atomsGroup2 = new AtomsGroup();
        $atomsGroup2->setName("NH2");
        $atomsGroup2->setMainAtom($nAtome);

        for ($i = 0; $i < 4; $i++) {
            $atoms[$i] = new Atom();
            $atoms[$i]->setElement($h);
            $atoms[$i]->setName($h->getName());
            $atoms[$i]->addAtomsGroup($atomsGroup);
        }
        foreach ($atoms as $atom) {
            $atomsGroup->addAtom($atom);
        }
        foreach ($atoms2 as $atom) {
            $atomsGroup2->addAtom($atom);
        }
        $atomsGroup->setMolecule($molecule);
        $atomsGroup->setPosition(1);
        $atomsGroup2->setMolecule($molecule);
        $atomsGroup2->setPosition(2);
            
        $em->persist($atomsGroup);
        $em->persist($atomsGroup2);
        $em->flush();
    }
}