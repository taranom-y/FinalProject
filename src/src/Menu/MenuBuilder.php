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
        $menu->setChildrenAttribute('class','navbar navbar-expand-lg navbar-dark bg-dark text-light ');

        $menu->addChild('Home', ['route' => 'app_home'])
            ->setLinkAttribute('class',' nav-link px-3 ');

        $menu->addChild('About us', ['route' => 'app_about'])
            ->setLinkAttribute('class',' nav-link px-3');

        $menu->addChild('Contact Us', ['route' => 'app_message_new'])
            ->setLinkAttribute('class',' nav-link px-3 ');

        $menu->addChild('Login/Logout', ['route' => 'app_login'])
            ->setLinkAttribute('class',' nav-link px-3 ');

        $menu->addChild('Register', ['route' => 'app_register'])
            ->setLinkAttribute('class',' nav-link px-3 ');

        $menu->addChild('management', ['route' => 'app_register'])
            ->setLinkAttribute('class',' nav-link px-3 ');

/*

        $menu->addChild('Products')->setLinkAttribute('class','nav-link dropdown ');
        $menu['Products']->addChild('Planner and Calender',['route' =>'app_planner_index'])
            ->setLinkAttribute('class','dropdown-item');
        $menu['Products']->addChild('Paper and cardboard',['route' =>'app_planner_index'])
            ->setLinkAttribute('class','dropdown-item');





        /*

        $planners = $this->entityManager->getRepository(Planner::class)->findAll();

        foreach ($planners as $planner) {
            $menu['Planners']->addChild($planner->getName(), [
                'route'           => 'app_planner_show',
                'routeParameters' => ['id' => $planner->getId()],
            ]);
        }
        */

        return $menu;
    }
}