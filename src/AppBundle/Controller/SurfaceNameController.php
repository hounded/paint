<?php

namespace AppBundle\Controller;

use AppBundle\Entity\SurfaceName;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Surfacename controller.
 *
 * @Route("surfacename")
 */
class SurfaceNameController extends Controller
{
    /**
     * Lists all surfaceName entities.
     *
     * @Route("/", name="surfacename_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $surfaceNames = $em->getRepository('AppBundle:SurfaceName')->findAll();

        return $this->render('surfacename/index.html.twig', array(
            'surfaceNames' => $surfaceNames,
        ));
    }

    /**
     * Creates a new surfaceName entity.
     *
     * @Route("/new", name="surfacename_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $surfaceName = new Surfacename();
        $form = $this->createForm('AppBundle\Form\SurfaceNameType', $surfaceName);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($surfaceName);
            $em->flush($surfaceName);

            return $this->redirectToRoute('surfacename_index', array('id' => $surfaceName->getId()));
        }

        return $this->render('surfacename/new.html.twig', array(
            'surfaceName' => $surfaceName,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a surfaceName entity.
     *
     * @Route("/{id}", name="surfacename_show")
     * @Method("GET")
     */
    public function showAction(SurfaceName $surfaceName)
    {
        $deleteForm = $this->createDeleteForm($surfaceName);

        return $this->render('surfacename/show.html.twig', array(
            'surfaceName' => $surfaceName,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing surfaceName entity.
     *
     * @Route("/{id}/edit", name="surfacename_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, SurfaceName $surfaceName)
    {
        $deleteForm = $this->createDeleteForm($surfaceName);
        $editForm = $this->createForm('AppBundle\Form\SurfaceNameType', $surfaceName);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('surfacename_edit', array('id' => $surfaceName->getId()));
        }

        return $this->render('surfacename/edit.html.twig', array(
            'surfaceName' => $surfaceName,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a surfaceName entity.
     *
     * @Route("/{id}", name="surfacename_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, SurfaceName $surfaceName)
    {
        $form = $this->createDeleteForm($surfaceName);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($surfaceName);
            $em->flush();
        }

        return $this->redirectToRoute('surfacename_index');
    }

    /**
     * Creates a form to delete a surfaceName entity.
     *
     * @param SurfaceName $surfaceName The surfaceName entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(SurfaceName $surfaceName)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('surfacename_delete', array('id' => $surfaceName->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
