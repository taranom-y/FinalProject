<?php

namespace App\Menu;

use App\Entity\Planner;
use App\Entity\Product;
use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Doctrine\ORM\EntityManagerInterface;
class MenuBuilder {

    private $factory;

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private EntityManagerInterface $entityManager;

    public function __construct(FactoryInterface $factory,  EntityManagerInterface $entityManager)
    {
        $this->factory = $factory;
        $this->entityManager = $entityManager;
    }

    public function createMainMenu(array $options): ItemInterface
    {
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class','navbar text-light ');

        $menu->addChild('Home', ['route' => 'app_home'])
            ->setLinkAttribute('class',' nav-link px-3 ');

        $menu->addChild('About', ['route' => 'app_about'])
            ->setLinkAttribute('class',' nav-link px-3');

        $menu->addChild('Contact', ['route' => 'app_message_new'])
            ->setLinkAttribute('class',' nav-link px-3 ');

        $menu->addChild('Login', ['route' => 'app_login'])
            ->setLinkAttribute('class',' nav-link px-3 ');

        $menu->addChild('Logout', ['route' => 'app_logout'])
            ->setLinkAttribute('class',' nav-link px-3 ');

        $menu->addChild('Register', ['route' => 'app_register'])
            ->setLinkAttribute('class',' nav-link px-3 ');

        $menu->addChild('management', ['route' => 'admin'])
            ->setLinkAttribute('class',' nav-link px-3 ');



        return $menu;
    }
}