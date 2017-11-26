<?php
namespace ChemicalsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Atom Controller.
 * 
 * @author Aurélien Muller
 */
class AtomController extends Controller
{
    /**
     * Display atoms.
     * 
     * @param type $page
     * @param type $maxPerPage
     *
     * @return type
     */
    public function listAction($page, $maxPerPage)
    {
        $r = $this->getDoctrine()->getRepository("ChemicalsBundle:Atom");
        $atoms = $r->getListPaginated($page, $maxPerPage);
        $pagination = array(
            'page' => $page,
            'nbPages' => ceil(count($atoms) / $maxPerPage),
            'max' => $maxPerPage,
            'routeName' => 'chemicals_atoms_list',
            'routeParams' => array()
        );

        return $this->render(
            'chemicals/atoms.list.html.twig',
            [
                'atoms' => $atoms,
                'pagination' => $pagination,
            ]);
    }

    /**
     * Display specific atom.
     * 
     * @param type $id
     *
     * @return type
     */
    public function displayAction($id)
    {
        $atom = $this->getDoctrine()->getRepository("ChemicalsBundle:Atom")->findOneById($id);     

        if (!empty($atom)) {
            $this
                ->get('thormeier_breadcrumb.breadcrumb_provider')
                ->getBreadcrumbByRoute('chemicals_atoms_display')
                ->setRouteParameters(array(
                    'id' => $atom->getId(),
                ))
                ->setLabelParameters(array(
                    '%name%' => $atom->getName(),
                ));

            return $this->render(
                'chemicals/atom.full.html.twig',
                [
                    'atom' => $atom,
                ]
             );
        } else {
            return $this->createNotFoundException('That atom was not found');
        }
    }
}
