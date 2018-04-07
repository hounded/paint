<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->redirectToRoute('fos_user_security_login',array(

        ));
    }

    /**
     * @Route("/overview", name="overview")
     */
    public function overviewAction()
    {
        $em = $this->getDoctrine()->getManager();
        $orders = $em->getRepository('AppBundle:Orders')->forDate(date('Y-m-d'));
        $butcheryItems = $em->getRepository('AppBundle:OrderItems')->forDate(date('Y-m-d'),'ordered','butchery');
        $packingItems = $em->getRepository('AppBundle:OrderItems')->forDate(date('Y-m-d'),'ordered','packed');
        $orderedItems = $em->getRepository('AppBundle:OrderItems')->forDate(date('Y-m-d'),'ordered','ordered');

        $data = array();

        $runs = $em->getRepository('AppBundle:Runs')->findAll();
        $i = 0;
        foreach ($runs as $run ) {
            $data[$i]['run']= $run;
            $data[$i]['orders'] = $em->getRepository('AppBundle:Orders')->forDateRun(date('Y-m-d'),$run->getId());
            $data[$i]['butcheryItems'] = $em->getRepository('AppBundle:OrderItems')->forDateRun(date('Y-m-d'),'ordered','butchery',$run->getId());
            $data[$i]['packedItems'] = $em->getRepository('AppBundle:OrderItems')->forDateRun(date('Y-m-d'),'ordered','packed',$run->getId());
            $data[$i]['orderedItems'] = $em->getRepository('AppBundle:OrderItems')->forDateRun(date('Y-m-d'),'ordered','ordered',$run->getId());
            $data[$i]['completed'] = $em->getRepository('AppBundle:Orders')->forDateCompletedRun(date('Y-m-d'),$run->getId());
            $i++;
        }


        return $this->render('default/overview.html.twig',array(
            'orders' => $orders,
            'butcheryItems'=>$butcheryItems,
            'packingItems'=>$packingItems,
            'orderedItems'=>$orderedItems,
            'runs'=>$data
        ));
    }

    /**
     * @Route("/customer/{id}", name="customer")
     */
    public function customerAction(Request $request)
    {
        $customerId = $request->attributes->get('id');

        $config = $this->container->getParameter('netsuite');
        $service = new NetSuiteService($config);

        $NSrequest = new GetRequest();
        $NSrequest->baseRef = new RecordRef();
        $NSrequest->baseRef->internalId = $customerId;
        $NSrequest->baseRef->type = "customer";
        $getResponse = $service->get($NSrequest);

        if (!$getResponse->readResponse->status->isSuccess) {
            $customer = "GET ERROR";
        } else {
            $customer = $getResponse->readResponse->record;
        }

        return $this->render('default/test.html.twig', [
            'customer' => $customer,
            'addy2'=>'h'
        ]);
    }


    /**
     * @Route("/invoice", name="invoice")
     */
    public function invoiceAction(Request $request)
    {



        $config = $this->container->getParameter('netsuite');
        $service = new NetSuiteService($config);

        $invoice = new Invoice();
        $invoice->customForm = new RecordRef();
        $invoice->customForm->internalId = 121;
        $invoice->entity = new RecordRef();
        $invoice->entity->internalId = 3079;



        $item[0] = new InvoiceItem();
        $item[0]->quantity = 2;
        $item[0]->item = new RecordRef();
        $item[0]->item->internalId = 179;

        $item[1] = new InvoiceItem();
        $item[1]->quantity = 5;
        $item[1]->item = new RecordRef();
        $item[1]->item->internalId = 134;

        $customField = new SelectCustomFieldRef();
        $customField->internalId = 846;
        $customField->value = new ListOrRecordRef();
        $customField->value->internalId = 11;

        $shippingAddress = new RecordRef();
        $shippingAddress->internalId = "4979";
//
//
        $invoice->itemList = new InvoiceItemList();
        $invoice->itemList->item = $item;


        $invoice->customFieldList = new CustomFieldList();
        $invoice->customFieldList->customField[] = $customField;

        $invoice->shipAddressList = $shippingAddress;




        $request = new AddRequest();
        $request->record = $invoice;

        $addResponse = $service->add($request);

        if (!$addResponse->writeResponse->status->isSuccess) {
            $invoiceResult = $addResponse->writeResponse->status->statusDetail;
        } else {
            $invoiceResult = $addResponse->writeResponse->baseRef->internalId;
        }

        return $this->render('default/test.html.twig', [
            'customer' => $invoiceResult,
            'addy2'=>'hey'
        ]);
    }

//    /**
//     * @Route("/customer/{id}", name="customer")
//     */
//    public function customerAction(Request $request)
//    {
//        $customerId = $request->attributes->get('id');
//
//        $config = $this->container->getParameter('netsuite');
//        $service = new NetSuiteService($config);
//
//        $NSrequest = new GetRequest();
//        $NSrequest->baseRef = new RecordRef();
//        $NSrequest->baseRef->internalId = $customerId;
//        $NSrequest->baseRef->type = "customer";
//        $getResponse = $service->get($NSrequest);
//
//        if (!$getResponse->readResponse->status->isSuccess) {
//            $customer = "GET ERROR";
//        } else {
//            $customer = $getResponse->readResponse->record;
//        }
//
//        return $this->render('default/test.html.twig', [
//            'customer' => $customer,
//        ]);
//    }


    /**
     * @Route("/addy/{id}", name="addy")
     */
    public function addressAction(Request $request)
    {

        $invoiceId = $request->attributes->get('id');

        $config = $this->container->getParameter('netsuite');
        $service = new NetSuiteService($config);

        $request = new GetRequest();

        $request->baseRef = new RecordRef();
        $request->baseRef->internalId = $invoiceId;
        $request->baseRef->type = "invoice";

//        $request->baseRef = new Address();
//        $request->baseRef->internalId = 4979;
////        $request->baseRef->type = "Address";



        $getResponse = $service->get($request);



        if (!$getResponse->readResponse->status->isSuccess) {
            $invoiceResult = $getResponse->readResponse->status;
        } else {
            $invoiceResult = $getResponse->readResponse->record;
//            $addy2 = $getResponse->readResponse->record->addressbookList->addressbook;
            $customer = $getResponse->readResponse->record;
//            echo "GET SUCCESS, customer:";
//            echo "\nCompany name: ". $customer->companyName;
//            echo "\nInternal Id: ". $customer->internalId;
//            echo "\nEmail: ". $customer->email . "\n";
//
//            $addressBookListArray = $customer->addressbookList->addressbook;
//            if (is_array($addressBookListArray)) {
//                foreach ($addressBookListArray as $addressEntry) {
//                    $address = $addressEntry->addressbookAddress;
//                    echo "\nAddress:\n";
//                    echo $addressEntry->label . "\n" .
//                        $address->attention . "\n" .
//                        $address->addressee . "\n" .
//                        $address->phone . "\n" .
//                        $address->city . "\n" .
//                        $address->state . "\n" .
//                        $address->zip . "\n" .
//                        $address->country . "\n\n";
//                }
//            } else {
//                $address = $addressBookListArray->addressbookAddress;
//                echo "\nAddress:\n";
//                echo $addressBookListArray->label . "\n" .
//                    $address->attention . "\n" .
//                    $address->addressee . "\n" .
//                    $address->phone . "\n" .
//                    $address->city . "\n" .
//                    $address->state . "\n" .
//                    $address->zip . "\n" .
//                    $address->country . "\n\n";
//            }
        }

//        if (!$getResponse->readResponse) {
//            $invoiceResult = "Error";
//        } else {
//            $invoiceResult = $getResponse->readResponse;
//        }

        return $this->render('default/test.html.twig', [
            'customer' => $invoiceResult,
            'addy2'=>'hi'
        ]);
    }



    /**
     * @Route("/getinvoice", name="get_invoice")
     *
     */
    public function getInvoiceAction(Request $request)
    {



        $config = $this->container->getParameter('netsuite');
        $service = new NetSuiteService($config);

        $request = new GetRequest();
        $request->baseRef = new RecordRef();
        $request->baseRef->internalId = 142295;
        $request->baseRef->type = "invoice";





//        $request->baseRef = new Address();
//        $request->baseRef->internalId = 4979;
////        $request->baseRef->type = "Address";



        $getResponse = $service->get($request);

        $addy2 = "hellio";

        if (!$getResponse->readResponse->status->isSuccess) {
            $invoiceResult = $getResponse->readResponse->status;
        } else {
            $invoiceResult = $getResponse->readResponse->record;
//            $addy2 = $getResponse->readResponse->record->addressbookList->addressbook;
        }


        return $this->render('default/test.html.twig', [
            'customer' => $invoiceResult,
            'addy2'=>$addy2
        ]);
    }

    /**
     * @Route("/testrun", name="test_run")
     *
     */
    public function testRunAction(Request $request)
    {
        return $this->render(':default:test.html.twig',array(
            'ip'=>$request->getClientIp(),
        ));
    }
//
//    /**
//     * @Route("/testrun", name="test_run")
//     *
//     */
//    public function testRunAction(Request $request)
//    {
//
//
//
////        $request->baseRef = new Address();
////        $request->baseRef->internalId = 4979;
//////        $request->baseRef->type = "Address";
//
//        $em = $this->getDoctrine()->getManager();
//
//        $orders =  $em->getRepository('AppBundle:Orders')->findAll();
//        $runDetails = array();
//        $i = 0;
//        foreach($orders as $order) {
//            $runDetails[$i]['order'] = $order;
//            if ($order->getNsInvoiceId() <> null) {
//
//                $config = $this->container->getParameter('netsuite');
//                $service = new NetSuiteService($config);
//
//                $request = new GetRequest();
//                $request->baseRef = new RecordRef();
//                $request->baseRef->internalId = $order->getNsInvoiceId();
//                $request->baseRef->type = "invoice";
//
//                $getResponse = $service->get($request);
//
//                if (!$getResponse->readResponse->status->isSuccess) {
//                    $runDetails[$i]['invoice'] = null;
//                } else {
//                    $runDetails[$i]['invoice'] = $getResponse->readResponse->record;
//                }
//            } else {
//                $runDetails[$i]['invoice'] = null;
//            }
//            $i++;
//        }
//
//        return $this->render('default/run.html.twig', [
//            'runDetails' => $runDetails,
//
//        ]);
//
//
//    }


}
