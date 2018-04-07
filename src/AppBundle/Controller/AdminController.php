<?php

namespace AppBundle\Controller;


use Doctrine\Common\Collections\ArrayCollection;
use Proxies\__CG__\AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
/**
 * Reports controller.
 *
 * @Route("/admin")
 */
class AdminController extends Controller
{
    /**
     * @Route("/", name="admin")
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('AppBundle:User')->findBy(array(), array('username'=>'asc'));
        $roles = array(
            "ROLE_AUTH",
            "ROLE_ADMIN",

        );


        return $this->render('admin/index.html.twig',array(
                'users'=>$users,
                'roles'=>$roles
            )

        );
    }

    /**
     *@Route("/add/{id}", name="admin_add")
     *@Method({"GET","POST"})
     */
    public function addAction(Request $request, \AppBundle\Entity\User $user)
    {
       // var_dump($user);
        $role = $request->request->get('role');
        $em = $this->getDoctrine()->getManager();
        $user->addRole($role);
        $em->persist($user);
        $em->flush();

        return $this->redirectToRoute('admin');
    }

    /**
     * @Route("/remove/{id}", name="admin_remove")
     *
     */
    public function removeAction(Request $request, \AppBundle\Entity\User $user)
    {
        $role = $request->request->get('role');
        $em = $this->getDoctrine()->getManager();
        $user->removeRole($role);
        $em->persist($user);
        $em->flush();

        return $this->redirectToRoute('admin');
    }




}
