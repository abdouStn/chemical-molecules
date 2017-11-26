<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ChemicalsBundle\Form\MoleculeType;
use ChemicalsBundle\Entity\Molecule;
use Symfony\Component\HttpFoundation\Request;

/**
 * Molecule controller.
 * 
 * @author Aurélien Muller
 */
class MoleculeController extends Controller
{
    /**
     * Displays an edit form for molecule.
     *
     * @param type $id
     */
    public function editAction(Request $request, $id)
    {
        $molecule = $this->getDoctrine()->getRepository('ChemicalsBundle:Molecule')->findOneBy(['id' => $id]);

        $form = $this->createForm(MoleculeType::class, $molecule);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($molecule);
            $em->flush();

            $this->addFlash(
                'notice',
                'Element with id ' . $molecule->getId() . ' was edited successfully.'
            );
            return $this->redirectToRoute('chemicals_molecules_list');
        }
        $this
            ->get('thormeier_breadcrumb.breadcrumb_provider')
            ->getBreadcrumbByRoute('chemicals_molecules_edit')
            ->setRouteParameters(array(
                'id' => $molecule->getId(),
            ))
            ->setLabelParameters(array(
                '%name%' => $molecule->getName(),
            ));

        return $this->render('chemicals/molecule.form.edit.html.twig', ['form' => $form->createView(), 'molecule' => $molecule]);
    }
    
    /**
     * Display a new molecule form.
     */
    public function addAction(Request $request)
    {
        $molecule = new Molecule();
        $form = $this->createForm(MoleculeType::class, $molecule);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($molecule);
            $em->flush();

            $this->addFlash(
                'notice',
                'New molecule was created successfully (id=' . $molecule->getId() . '). Now add it some atomsGroups !'
            );
        return $this->redirectToRoute('chemicals_molecules_edit', ['id' => $molecule->getId()]);
        }

        return $this->render('chemicals/molecule.form.add.html.twig', ['form' => $form->createView(), 'debug' => $molecule]);
    }

    /**
     * Delete molecule.
     *
     * @param type $id
     */
    public function deleteAction($id)
    {
        $rep = $this->getDoctrine()->getRepository('ChemicalsBundle:Molecule');
        $molecule = $rep->findById($id);
        if (!empty($molecule)) {
            $molecule = $molecule[0];
            $em = $this->getDoctrine()->getManager();
            $em->remove($molecule);
            $em->flush();
            $this->addFlash(
                'notice',
                'Molecule ' . $id . ' deleted successfully.'
            );
        }
        else {
            $this->addFlash(
                'error',
                'No molecule deleted, that id does not exist.'
            );
        }
        return $this->redirectToRoute('chemicals_molecules_list');
    }
}
