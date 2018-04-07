<?php
/**
 * Created by IntelliJ IDEA.
 * User: James
 * Date: 2017-03-19
 * Time: 6:29 PM
 */
namespace AppBundle\Utils;

use Doctrine\ORM\EntityManager;

class Calculations {

    private $em;

    public function __construct(EntityManager $entityManager){
        $this->em = $entityManager;
    }

    public function calculateAreaCostBySurfaces($Area){
        $surfaces = $this->em->getRepository('AppBundle:Surface')->findBy(array('area'=>$Area));
        $AreaTotalCost =0;
        foreach ($surfaces as $surface){
            if($surface->getDeduction() == 'Yes'){
                $AreaTotalCost = $AreaTotalCost - $surface->getSurfaceTotal();
            }else{
                $AreaTotalCost = $AreaTotalCost + $surface->getSurfaceTotal();
            }
        }
        return $AreaTotalCost;
    }

    public function calculateAdditionalItemsByJob($job){
        $additionalItems = $this->em->getRepository('AppBundle:AdditionalItems')->findBy(array('job'=>$job));
        $AdditionalTotalCost =0;
        foreach ($additionalItems as $additionalItem){
            $AdditionalTotalCost = $AdditionalTotalCost + $additionalItem->getTotal();
        }
        return $AdditionalTotalCost;
    }

    public function calculateTotalJobCost($jobId){
        $areas = $this->em->getRepository('AppBundle:Area')->findBy(array('job'=>$jobId));

        $jobCostAreas = 0;
        foreach ($areas as $area){
            $jobCostAreas = $jobCostAreas + $area->getCost();
        }

        $additionalCosts = $this->calculateAdditionalItemsByJob($jobId);
        $jobTotalCost = $jobCostAreas +$additionalCosts;
        $job = $this->em->getRepository('AppBundle:Job')->find($jobId);
        $job->setCostAreas($jobCostAreas);
        $job->setCostAdditionalItems($additionalCosts);
        $job->setCost($jobTotalCost);
        $job->setMargin();
        $job->setMaterials();
        $job->setHours();
        $this->em->persist($job);
        $this->em->flush();
//        return $jobTotalCost;
    }

}