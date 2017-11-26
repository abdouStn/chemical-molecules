<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ChemicalsBundle\Form\ElementType;
use Symfony\Component\HttpFoundation\Request;
use ChemicalsBundle\Entity\Element;

/**
 * Element controller.
 * 
 * @author Aurélien Muller
 */
class ElementController extends Controller
{ 
    /**
     * Displays element edit form.
     * 
     * @param Request $request
     * @param type $id
     *
     * @return type
     */
    public function editAction(Request $request, $id)
    {
        $element = $this->getDoctrine()->getRepository('ChemicalsBundle:Element')->findById($id);
        if (!empty($element)) {
            $element = $element[0];
        }
        $form = $this->createForm(ElementType::class, $element);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($element);
            $em->flush();

            $this->addFlash(
                'notice',
                'Element with id ' . $element->getId() . ' was edited successfully.'
            );
            return $this->redirectToRoute('chemicals_elements_list');
        }
        $this
            ->get('thormeier_breadcrumb.breadcrumb_provider')
            ->getBreadcrumbByRoute('chemicals_elements_edit')
            ->setRouteParameters(array(
                'id' => $element->getId(),
            ))
            ->setLabelParameters(array(
                '%name%' => $element->getName(),
            ));

        return $this->render('chemicals/element.form.edit.html.twig', ['form' => $form->createView(), 'atom' => $element]);
    }
    

    /**
     * Displays new element add form.
     * 
     * @param Request $request
     * 
     * @return type
     */
    public function addAction(Request $request)
    {
        $element = new Element();
        $form = $this->createForm(ElementType::class, $element);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($element);
            $em->flush();

            $this->addFlash(
                'notice',
                'New element was created successfully (id=' . $element->getId() . ').'
            );
            return $this->redirectToRoute('chemicals_elements_list');
        }

        return $this->render('chemicals/element.form.add.html.twig', ['form' => $form->createView()]);
    }

    /**
     * Deletes element.
     * 
     * @param type $id
     * 
     * @return type
     */
    public function deleteAction($id)
    {
        $rep = $this->getDoctrine()->getRepository('ChemicalsBundle:Element');
        $element = $rep->findById($id);
        if (!empty($element)) {
            $element = $element[0];
            $em = $this->getDoctrine()->getManager();
            $em->remove($element);
            $em->flush();
            $this->addFlash(
                'notice',
                'Element ' . $id . ' deleted successfully.'
            );
        }
        else {
            $this->addFlash(
                'error',
                'No element deleted, that id does not exist.'
            );
        }
        return $this->redirectToRoute('chemicals_elements_list');
    }
}
