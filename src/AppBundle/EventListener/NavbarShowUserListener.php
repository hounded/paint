<?php
/**
 * NavbarShowUserListener.php
 * avanzu-admin
 * Date: 23.02.14
 */

namespace AppBundle\EventListener;


use Avanzu\AdminThemeBundle\Event\ShowUserEvent;
use Avanzu\AdminThemeBundle\Model\UserModel;

class NavbarShowUserListener {

    public function onShowUser(ShowUserEvent $event) {

        $user = new UserModel();
        $user->setAvatar('')->setIsOnline(true)->setMemberSince(new \DateTime())->setUsername('Demo User');

        $event->setUser($user);
    }

}