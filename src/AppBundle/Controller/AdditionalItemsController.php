<?php

namespace AppBundle\Controller;

use AppBundle\Entity\AdditionalItems;
use AppBundle\Entity\Job;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Additionalitem controller.
 *
 * @Route("additionalitems")
 */
class AdditionalItemsController extends Controller
{
    /**
     * Lists all Area entities.
     *
     * @Route("/creation/{id}", name="additionalitems_creation")
     * @Method({"GET","POST"})
     */
    public function creationAction(Job $Job,Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $additionalItems = new AdditionalItems();
        $AllAdditionalItems = $em->getRepository('AppBundle:AdditionalItems')->findBy(array('job'=>$Job));
        $form = $this->createForm('AppBundle\Form\AdditionalItemsMultiType', $additionalItems);
//        $form->handleRequest($request);


        if ($request->isMethod('POST')) {
            $em = $this->getDoctrine()->getManager();
            $additionalSubmitted = $request->request->all()['appbundle_additionalitems']['description'];
            foreach ($additionalSubmitted as $additionalArray){

                $additionalItem = new AdditionalItems();
                $additionalItem->setDescription($additionalArray['description']);
                $additionalItem->setType($additionalArray['type']);
                $additionalItem->setRate($additionalArray['rate']);
                $additionalItem->setMulti($additionalArray['multi']);
                $additionalItem->setTotal();
                $additionalItem->setJob($Job);
                $additionalItem->setUser($this->getUser());
                var_dump($additionalItems);
                $em->persist($additionalItem);
                $em->flush();



            }
            $calculate = $this->get('app.utils.calculations');
            $calculate->calculateTotalJobCost($Job->getId());


            return $this->redirectToRoute('job_overview', array(
                    'id' => $Job->getId())
            );
//            return $this->render(':default:dump.html.twig', array(
//                    'var1' => $additionalItem)
//            );

        }


        return $this->render(':additionalitems:creation.html.twig', array(
            'form'=>$form->createView(),
            'additionalItems'=>$AllAdditionalItems,
            'job'=>$Job,
        ));
    }

    /**
     * Lists all additionalItem entities.
     *
     * @Route("/", name="additionalitems_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $additionalItems = $em->getRepository('AppBundle:AdditionalItems')->findAll();

        return $this->render('additionalitems/index.html.twig', array(
            'additionalItems' => $additionalItems,
        ));
    }

    /**
     * Creates a new additionalItem entity.
     *
     * @Route("/new", name="additionalitems_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $additionalItem = new Additionalitem();
        $form = $this->createForm('AppBundle\Form\AdditionalItemsType', $additionalItem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($additionalItem);
            $em->flush($additionalItem);

            return $this->redirectToRoute('additionalitems_show', array('id' => $additionalItem->getId()));
        }

        return $this->render('additionalitems/new.html.twig', array(
            'additionalItem' => $additionalItem,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a additionalItem entity.
     *
     * @Route("/{id}", name="additionalitems_show")
     * @Method("GET")
     */
    public function showAction(AdditionalItems $additionalItem)
    {
        $deleteForm = $this->createDeleteForm($additionalItem);

        return $this->render('additionalitems/show.html.twig', array(
            'additionalItem' => $additionalItem,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing additionalItem entity.
     *
     * @Route("/{id}/edit", name="additionalitems_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, AdditionalItems $additionalItem)
    {
        $deleteForm = $this->createDeleteForm($additionalItem);
        $editForm = $this->createForm('AppBundle\Form\AdditionalItemsType', $additionalItem);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('additionalitems_edit', array('id' => $additionalItem->getId()));
        }

        return $this->render('additionalitems/edit.html.twig', array(
            'additionalItem' => $additionalItem,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a additionalItem entity.
     *
     * @Route("/{id}", name="additionalitems_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, AdditionalItems $additionalItem)
    {
        $form = $this->createDeleteForm($additionalItem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($additionalItem);
            $em->flush();
        }

        return $this->redirectToRoute('additionalitems_index');
    }

    /**
     * Creates a form to delete a additionalItem entity.
     *
     * @param AdditionalItems $additionalItem The additionalItem entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(AdditionalItems $additionalItem)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('additionalitems_delete', array('id' => $additionalItem->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
