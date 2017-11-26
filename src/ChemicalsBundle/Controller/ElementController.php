<?php
namespace ChemicalsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Element controller.
 * 
 * @author Aurélien Muller
 */
class ElementController extends Controller
{ 
    /**
     * Display atoms from periodic table.
     * 
     * @param type $page
     * @param type $maxPerPage
     *
     * @return type
     */
    public function listAction($page, $maxPerPage)
    {
        $r = $this->getDoctrine()->getRepository("ChemicalsBundle:Element");
        $atoms = $r->getListPaginated($page, $maxPerPage);
        $pagination = array(
            'page' => $page,
            'nbPages' => ceil(count($atoms) / $maxPerPage),
            'max' => $maxPerPage,
            'routeName' => 'chemicals_elements_list',
            'routeParams' => array()
        );

        return $this->render(
            'chemicals/elements.list.html.twig',
            [
                'atoms' => $atoms,
                'pagination' => $pagination,
            ]);
    }

    /**
     * Display specific element.
     * 
     * @param type $id
     *
     * @return type
     */
    public function displayAction($id)
    {
        $element = $this->getDoctrine()->getRepository("ChemicalsBundle:Element")->findOneById($id);     
        if (!empty($element)) {
            $this
                ->get('thormeier_breadcrumb.breadcrumb_provider')
                ->getBreadcrumbByRoute('chemicals_elements_display')
                ->setRouteParameters(array(
                    'id' => $element->getId(),
                ))
                ->setLabelParameters(array(
                    '%name%' => $element->getName(),
                ));

            return $this->render(
                'chemicals/element.full.html.twig',
                [
                    'element' => $element,
                ]
             );
        } else {
            return $this->createNotFoundException('That element was not found');
        }
    }
}
