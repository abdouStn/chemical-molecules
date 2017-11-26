<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ChemicalsBundle\Form\AtomType;
use Symfony\Component\HttpFoundation\Request;
use ChemicalsBundle\Entity\Atom;

/**
 * Atom Controller.
 * 
 * @author Aurélien Muller
 */
class AtomController extends Controller
{
    /**
     * Displays atom edit form.
     * 
     * @param Request $request
     * @param type $id
     * 
     * @return type
     */
    public function editAction(Request $request, $id)
    {
        $atom = $this->getDoctrine()->getRepository('ChemicalsBundle:Atom')->findById($id);
        if (!empty($atom))
        {
            $atom = $atom[0];
        }

        $form = $this->createForm(AtomType::class, $atom);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($atom);
            $em->flush();

            $this->addFlash(
                'notice',
                'Atom with id ' . $atom->getId() . ' was edited successfully.'
            );
            return $this->redirectToRoute('chemicals_atoms_list');
        }
        $this
            ->get('thormeier_breadcrumb.breadcrumb_provider')
            ->getBreadcrumbByRoute('chemicals_atoms_edit')
            ->setRouteParameters(array(
                'id' => $atom->getId(),
            ))
            ->setLabelParameters(array(
                '%name%' => $atom->getName(),
            ));

        return $this->render('chemicals/atom.form.edit.html.twig', ['form' => $form->createView(), 'atom' => $atom]);
    }
    
    /**
     * Displays atom edit form.
     * 
     * @param Request $request
     * 
     * @return type
     */
    public function addAction(Request $request)
    {
        $atom = new Atom();
        $form = $this->createForm(AtomType::class, $atom);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($atom);
            $em->flush();

            $this->addFlash(
                'notice',
                'New atom was created successfully (id=' . $atom->getId() . ').'
            );
            return $this->redirectToRoute('chemicals_atoms_list');
        }

        return $this->render('chemicals/atom.form.add.html.twig', [
            'form' => $form->createView()
        ]);
    }
    
    
    /**
     * Removes atom from database.
     * 
     * @param type $id
     * 
     * @return type
     */
    public function deleteAction($id)
    {
        $rep = $this->getDoctrine()->getRepository('ChemicalsBundle:Atom');
        $atom = $rep->findById($id);
        if (!empty($atom)) {
            $atom = $atom[0];
            if (!empty($atom->getAtomsGroups()->count()))
            {
                $this->addFlash(
                    'error',
                    "Atom " . $atom . "is a main atom and thus can't be deleted unless its atoms group is deleted first."
                );
            }
            else
            {
                $em = $this->getDoctrine()->getManager();
                $em->remove($atom);
                $em->flush();
                $this->addFlash(
                    'notice',
                    'Atom ' . $id . ' deleted successfully.'
                );
            }
        }
        else {
            $this->addFlash(
                'error',
                'No atom deleted, that id does not exist.'
            );
        }
        return $this->redirectToRoute("chemicals_atoms_list");
    }
}
