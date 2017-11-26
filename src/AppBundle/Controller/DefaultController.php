<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Default controller for admin bundle.
 *
 * @author Aurélien Muller
 */
class DefaultController extends Controller
{
    /**
     * Lists all users.
     *
     * @return type
     */
    public function listUsersAction()
    {
        // @TODO : use pager. 
        $users =  $this->get('fos_user.user_manager')->findUsers();
        return $this->render('user/list.html.twig', [
            'users' => $users,
        ]);
        
    }

    /**
     * User has admin profile added.
     * 
     * @param type $id
     *   User id.
     *
     * @return type
     */
    public function setAdminAction($id)
    {
        try {
            $user = $this->get('fos_user.user_manager')->findUserBy(['id' => $id]);
            $user->addRole('ROLE_ADMIN');
            $this->get('fos_user.user_manager')->updateUser($user);
            $this->addFlash('success', 'User role switched to admin.');
        } catch (Exception $ex) {
            $this->get('logger')->error($ex->getMessage());
            $this->addFlash('error', 'An unexpected error has occurred while changing users role.');
        }

        return $this->redirectToRoute('app_users_list');
    }

    /**
     * User has admin profile removed.
     * 
     * @param type $id
     *   User id.
     *
     * @return type
     */
    public function unsetAdminAction($id)
    {
        try {
            $user = $this->get('fos_user.user_manager')->findUserBy(['id' => $id]);
            $user->removeRole('ROLE_ADMIN');
            $this->get('fos_user.user_manager')->updateUser($user);
            $this->addFlash('success', 'User role switched to user.');
        } catch (Exception $ex) {
            $this->get('logger')->error($ex->getMessage());
            $this->addFlash('error', 'An unexpected error has occurred while changing users role.');
        }

        return $this->redirectToRoute('app_users_list');
    }
}
