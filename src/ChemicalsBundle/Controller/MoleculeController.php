<?php
namespace ChemicalsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Molecule controller.
 * 
 * @author Aurélien Muller
 */
class MoleculeController extends Controller
{ 
    /**
     * Display molecules stored within database.
     * 
     * @param type $page
     * @param type $maxPerPage
     *
     * @return type
     */
    public function listAction($page, $maxPerPage)
    {
        $r = $this->getDoctrine()->getRepository("ChemicalsBundle:Molecule");
        $molecules = $r->getListPaginated($page, $maxPerPage);
        $pagination = array(
            'page' => $page,
            'nbPages' => ceil(count($molecules) / $maxPerPage),
            'max' => $maxPerPage,
            'routeName' => 'chemicals_molecules_list',
            'routeParams' => array()
        );

        return $this->render(
            'chemicals/molecules.list.html.twig',
            [
                'molecules' => $molecules,
                'pagination' => $pagination,
            ]);
    }
    
    /**
     * Display specific molecule.
     * 
     * @param type $id
     *
     * @return type
     */
    public function displayAction($id)
    {
        $molecule = $this->getDoctrine()->getRepository("ChemicalsBundle:Molecule")->loadMolecule($id);     
        if (!empty($molecule)) {
            $this
                ->get('thormeier_breadcrumb.breadcrumb_provider')
                ->getBreadcrumbByRoute('chemicals_molecules_display')
                ->setRouteParameters(array(
                    'id' => $molecule->id,
                ))
                ->setLabelParameters(array(
                    '%name%' => $molecule->name,
                ));
            $code = $this->get('chemicals.visjs.helper')->generateVisJsForMolecule($molecule, 'molecule-3d');
            return $this->render(
                'chemicals/molecule.full.html.twig',
                [
                    'molecule' => $molecule,
                    'code' => $code,
                ]
             );
        } else {
            return $this->createNotFoundException('That molecule was not found');
        }
    }
}
