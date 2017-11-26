<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ChemicalsBundle\Form\AtomsGroupType;
use Symfony\Component\HttpFoundation\Request;
use ChemicalsBundle\Entity\AtomsGroup;

/**
 * AtomsGroup Controller.
 * 
 * @author Aurélien Muller
 */
class AtomsGroupController extends Controller
{
    /**
     * Displays atomsGroup edit form.
     * 
     * @param Request $request
     * @param int $id
     * @param int $moleculeid
     * 
     * @return type
     */
    public function editAction(Request $request, $id, $moleculeid)
    {
        $atomsGroup = $this->getDoctrine()->getRepository('ChemicalsBundle:AtomsGroup')->findById($id);
        if (!empty($atomsGroup))
        {
            $atomsGroup = $atomsGroup[0];
        }

        $form = $this->createForm(AtomsGroupType::class, $atomsGroup);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($atomsGroup);
            $em->flush();
            $this
                ->get('thormeier_breadcrumb.breadcrumb_provider')
                ->getBreadcrumbByRoute('chemicals_atomsgroups_edit')
                ->setRouteParameters(array(
                    'id' => $atom->getId(),
                ))
                ->setLabelParameters(array(
                    '%name%' => $atom->getName(),
                ));
            $this->addFlash(
                'notice',
                'Atoms group with id ' . $atomsGroup->getId() . ' was edited successfully.'
            );
            return $this->redirectToRoute('chemicals_molecules_display', ['id' => $moleculeid]);
        }

        return $this->render('chemicals/atomsgroup.form.edit.html.twig', ['form' => $form->createView(), 'atomsGroup' => $atomsGroup, 'molecule' => $atomsGroup->getMolecule()]);
    }

    /**
     * Displays atomsGroup edit form.
     * 
     * @param Request $request
     * 
     * @return type
     */
    public function addAction(Request $request, $moleculeid)
    {
        $atomsGroup = new AtomsGroup();
        $molecule = $this->getDoctrine()->getRepository('ChemicalsBundle:Molecule')->findById($moleculeid);
        if (!empty($molecule))
        {
            $molecule = $molecule[0];
            $atomsGroup->setMolecule($molecule);
            $form = $this->createForm(AtomsGroupType::class, $atomsGroup);

            $form->handleRequest($request);

            if ($form->isSubmitted() /*&& $form->isValid()*/) {
                $em = $this->getDoctrine()->getManager();
                $molecule->addAtomsGroup($atomsGroup);
                $em->persist($atomsGroup);
                $em->flush();

                $this->addFlash(
                    'notice',
                    'New atoms group was linked successfully to molecule ' . $molecule . '.'
                );
                return $this->redirectToRoute('chemicals_molecules_display', ['id' => $moleculeid]);
            }

            return $this->render('chemicals/atomsgroup.form.add.html.twig', [
                'form' => $form->createView(),
                'molecule' => $molecule,
            ]);
        }
        $this->addFlash('notice', 'That molecule does not exist.');
        return $this->redirectToRoute('chemicals_molecules_list');
    }
    
    
    /**
     * Removes atom from database.
     * 
     * @param type $id
     * @param int $moleculeid
     *
     * @return type
     */
    public function deleteAction($id, $moleculeid)
    {
        $rep = $this->getDoctrine()->getRepository('ChemicalsBundle:AtomsGroup');
        $atom = $rep->findById($id);
        if (!empty($atom)) {
            $atom = $atom[0];
            $mol = $this->getDoctrine()->getRepository('ChemicalsBundle:Molecule')->findById($moleculeid);
            if (!empty($mol))
            {
                $mol[0]->removeAtomsGroup($atom);
            }
            $em = $this->getDoctrine()->getManager();
            $atom->removeMolecule();
            $em->remove($atom);
            $em->flush();
            $this->addFlash(
                'notice',
                'Atoms group ' . $id . ' deleted successfully.'
            );
        }
        else {
            $this->addFlash(
                'error',
                'No atoms group deleted, that id does not exist.'
            );
        }
        return $this->redirectToRoute('chemicals_molecules_display', ['id' => $moleculeid]);   
    }
}
