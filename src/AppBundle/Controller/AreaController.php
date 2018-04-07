<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Job;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Area;
use AppBundle\Form\AreaType;

/**
 * Area controller.
 *
 * @Route("/area")
 */
class AreaController extends Controller
{
    /**
     * Lists all Area entities.
     *
     * @Route("/", name="area_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $areas = $em->getRepository('AppBundle:Area')->findAll();

        return $this->render('area/index.html.twig', array(
            'areas' => $areas,
        ));
    }

    /**
     * Creates a new Area entity.
     *
     * @Route("/new", name="area_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $area = new Area();
        $form = $this->createForm('AppBundle\Form\AreaType', $area);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($area);
            $em->flush();

            return $this->redirectToRoute('area_show', array('id' => $area->getId()));
        }

        return $this->render('area/new.html.twig', array(
            'area' => $area,
            'form' => $form->createView(),
        ));
    }


    /**
     * Creates a new Area entity.
     *
     * @Route("/new/{id}", name="area_creation")
     * @Method({"GET", "POST"})
     */
    public function creationAction(Request $request,Job $job)
    {
        $em = $this->getDoctrine();
        $areas = $em->getRepository('AppBundle:Area')->findBy(array('job'=>$job));
        $area = new Area();
        $form = $this->createForm('AppBundle\Form\AreaType', $area);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $area->setJob($job);
            $em = $this->getDoctrine()->getManager();
            $em->persist($area);
            $em->flush();

            return $this->redirectToRoute('surface_creation', array('id' => $area->getId()));
        }

        return $this->render('area/creation.html.twig', array(
            'job'=>$job,
            'existingLots'=>$areas,
            'area' => $area,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Area entity.
     *
     * @Route("/{id}", name="area_show")
     * @Method("GET")
     */
    public function showAction(Area $area)
    {
        $deleteForm = $this->createDeleteForm($area);

        return $this->render('area/show.html.twig', array(
            'area' => $area,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Area entity.
     *
     * @Route("/{id}/edit", name="area_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Area $area)
    {
        $deleteForm = $this->createDeleteForm($area);
        $editForm = $this->createForm('AppBundle\Form\AreaType', $area);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($area);
            $em->flush();

            return $this->redirectToRoute('area_edit', array('id' => $area->getId()));
        }

        return $this->render('area/edit.html.twig', array(
            'area' => $area,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Area entity.
     *
     * @Route("/{id}", name="area_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Area $area)
    {
        $form = $this->createDeleteForm($area);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($area);
            $em->flush();
        }

        return $this->redirectToRoute('area_index');
    }

    /**
     * Creates a form to delete a Area entity.
     *
     * @param Area $area The Area entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Area $area)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('area_delete', array('id' => $area->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
