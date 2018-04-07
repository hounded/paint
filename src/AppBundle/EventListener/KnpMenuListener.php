<?php
/**
 * KnpMenuListener.php
 * symfony3
 * Date: 13.06.16
 */

namespace AppBundle\EventListener;


use Avanzu\AdminThemeBundle\Event\KnpMenuEvent;
use Symfony\Component\DependencyInjection\ContainerInterface;

class KnpMenuListener
{

    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
    /**
     * @param KnpMenuEvent $event
     */
    public function onSetupKnpMenu(KnpMenuEvent $event)
    {

        $menu = $event->getMenu();
        $factory = $event->getFactory();
        $childOptions = $event->getChildOptions();

        $labelAttributes = ['icon' => 'fa fa-circle-o'];

//        $job = $menu->addChild('Jobs', $childOptions)->setLabelAttribute('icon', 'fa fa-paint-brush');
//        $job->addChild('Job list', ['route'=>'job_index'])->setLabelAttribute('icon', 'fa fa-list');

        $menu->addChild('Job list', ['route'=>'job_index'])->setLabelAttribute('icon', 'fa fa-paint-brush');
        $menu->addChild('Surface Settings', ['route'=>'surfacename_index'])->setLabelAttribute('icon', 'fa fa-houzz');




        if($this->container->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            $admin = $menu->addChild('Admin', $childOptions)->setLabelAttribute('icon', 'fa fa-shield');
            $admin->addChild('Users', ['route' => 'admin'])->setLabelAttribute('icon', 'fa fa-users');
        }

    }

}