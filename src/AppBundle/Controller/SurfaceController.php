<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Job;
use AppBundle\Entity\Surface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Area;
use AppBundle\Form\AreaType;

/**
 * Area controller.
 *
 * @Route("/surface")
 */
class SurfaceController extends Controller
{
    /**
     * Lists all Area entities.
     *
     * @Route("/", name="surface_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $surfaces = $em->getRepository('AppBundle:Area')->findAll();

        return $this->render('surface/index.html.twig', array(
            'surfaces' => $surfaces,
        ));
    }


    /**
     * Lists all Area entities.
     *
     * @Route("/area/{id}", name="surface_creation")
     * @Method({"GET","POST"})
     */
    public function creationAction(Area $area,Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $surface = new Surface();
        $surfaces = $em->getRepository('AppBundle:Surface')->findBy(array('area'=>$area));
        $form = $this->createForm('AppBundle\Form\SurfaceMultiType', $surface);
//        $form->handleRequest($request);


        if ($request->isMethod('POST')) {
            $em = $this->getDoctrine()->getManager();
            $surfacesSubmitted = $request->request->all()['surface_multi']['surfaceName'];
            foreach ($surfacesSubmitted as $surfaceArray){

                $surface = new Surface();
                $SurfaceName = $this->getDoctrine()->getRepository('AppBundle:SurfaceName')->find($surfaceArray['surfaceName']);
                $surface->setSurfaceName($SurfaceName);
                $surface->setHeight($surfaceArray['height']);
                $surface->setWidth($surfaceArray['width']);

                if(($surfaceArray['num1'])<>""){
                    $surface->setNum1($surfaceArray['num1']);
                }
                $surface->setRate($surfaceArray['rate']);
//                $surface->setType($surfaceArray['type']);
                $surface->setDeduction($surfaceArray['deduction']);
                $surface->setArea($area);
                $surface->setSurfaceTotal();
                $surface->setSurfaceTotalArea();
                $surface->setUser($this->getUser());
                $em->persist($surface);
                $em->flush();

            }
            $calculate = $this->get('app.utils.calculations');
            $SurfaceCost = $calculate->calculateAreaCostBySurfaces($area->getId());
            $area->setCost($SurfaceCost);

            $em->persist($area);
            $em->flush();

            $calculate->calculateTotalJobCost($area->getJob()->getId());

            return $this->redirectToRoute('area_creation', array(
                'id' => $area->getJob()->getId())
            );
        }
        $job = $area->getJob();

        return $this->render('surface/creation.html.twig', array(
            'form'=>$form->createView(),
            'area'=>$area,
            'surfaces' => $surfaces,
            'request'=>$request,
            'job'=>$job
        ));
    }

    /**
     * Creates a new Area entity.
     *
     * @Route("/new", name="surface_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $surface = new Surface();
        $form = $this->createForm('AppBundle\Form\SurfaceType', $surface);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $area = $surface->getArea();
            $em = $this->getDoctrine()->getManager();
            $em->persist($surface);
            $em->flush();

            $calculate = $this->get('app.utils.calculations');
            $SurfaceCost = $calculate->calculateAreaCostBySurfaces($area->getId());
            $area->setCost($SurfaceCost);

            $em->persist($area);
            $em->flush();

            $calculate->calculateTotalJobCost($area->getJob()->getId());
            return $this->redirectToRoute('surface_show', array('id' => $surface->getId()));
        }

        return $this->render('surface/new.html.twig', array(
            'surface' => $surface,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Area entity.
     *
     * @Route("/{id}", name="surface_show")
     * @Method("GET")
     */
    public function showAction(Area $surface)
    {
        $deleteForm = $this->createDeleteForm($surface);

        return $this->render('surface/show.html.twig', array(
            'surface' => $surface,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Area entity.
     *
     * @Route("/{id}/edit", name="surface_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Surface $surface)
    {
        $deleteForm = $this->createDeleteForm($surface);
        $editForm = $this->createForm('AppBundle\Form\SurfaceType', $surface);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $area = $surface->getArea();
            $em = $this->getDoctrine()->getManager();

            $surface->setSurfaceTotalArea();
            $surface->setSurfaceTotal();
            $calculate = $this->get('app.utils.calculations');
            $SurfaceCost = $calculate->calculateAreaCostBySurfaces($area->getId());
            $area->setCost($SurfaceCost);
            $calculate->calculateTotalJobCost($area->getJob()->getId());
            $em->persist($surface);
            $em->persist($area);
            $em->flush();

            return $this->redirectToRoute('surface_creation', array('id' => $area->getId()));
        }

        return $this->render('surface/edit.html.twig', array(
            'surface' => $surface,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Area entity.
     *
     * @Route("/{id}", name="surface_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Surface $surface)
    {
        $form = $this->createDeleteForm($surface);
        $form->handleRequest($request);
        $areaId = $surface->getArea()->getId();
        if ($form->isSubmitted() && $form->isValid()) {
            $area = $surface->getArea();
            $em = $this->getDoctrine()->getManager();
            $calculate = $this->get('app.utils.calculations');
            $SurfaceCost = $calculate->calculateAreaCostBySurfaces($area->getId());
            $area->setCost($SurfaceCost);
            $calculate->calculateTotalJobCost($area->getJob()->getId());
            $em->persist($area);
            $em->remove($surface);
            $em->flush();
        }

        return $this->redirectToRoute('surface_creation',array(
            'id'=>$areaId,
        ));
    }

    /**
     * Creates a form to delete a Area entity.
     *
     * @param Area $surface The Area entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Surface $surface)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('surface_delete', array('id' => $surface->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
