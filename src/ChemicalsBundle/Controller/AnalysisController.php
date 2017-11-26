<?php
namespace ChemicalsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AnalysisController extends Controller
{    
    /**
     * Analysis page.
     *
     * With a very basic use of js library (Chart.js).
     *
     * @return type
     */
    public function analysisAction()
    {
        // Requêtes à lancer.
        $sql = "SELECT column_name, table_name 
            FROM information_schema.columns c
            WHERE table_schema = DATABASE() AND
            c.table_name in (
                'chemicals_atom', 
                'chemicals_atoms_group', 
                'chemicals_molecule',
                'chemicals_bound_atoms',
                'chemicals_element'
            );";

        try
        {
            $em = $this->getDoctrine()->getManager();
            $stmt = $em->getConnection()->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
            $data = [];
            foreach ($result as $part)
            {
                $data[$part['table_name']][] = $part['column_name'];
            }            
        } catch (Exception $ex) {
            $this->addFlash(
                'error',
                $ex->getMessage()
            );
        }

        return $this->render('chemicals/analysis.html.twig', [
            'data' => $data,
            'element' => $this->getDoctrine()->getRepository('ChemicalsBundle:Element')->getNb(),
            'atom' => $this->getDoctrine()->getRepository('ChemicalsBundle:Atom')->getNb(),
            'molecule' => $this->getDoctrine()->getRepository('ChemicalsBundle:Molecule')->getNb(),
            'atomsgroup' => $this->getDoctrine()->getRepository('ChemicalsBundle:AtomsGroup')->getNb()
        ]);
    }
    
    /**
     * Homepage.
     *
     * @return type
     */
    public function indexAction()
    {
        $rElt = $this->getDoctrine()->getRepository('ChemicalsBundle:Element');
        $rAtom = $this->getDoctrine()->getRepository('ChemicalsBundle:Atom');
        $rMolecule = $this->getDoctrine()->getRepository('ChemicalsBundle:Molecule');
        
        return $this->render('chemicals/index.html.twig', [
           'nbElts' => $rElt->getNb(),
           'nbAtoms' => $rAtom->getNb(),
           'nbMolecules' => $rMolecule->getNb(), 
        ]);
    }
}
