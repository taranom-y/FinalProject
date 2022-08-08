<?php

namespace App\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
class MenuBuilder {

    private $factory;

    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function createMainMenu(array $options): ItemInterface
    {
        $menu = $this->factory->createItem('root');

        $menu->addChild('Home', ['route' => 'app_home']);
        $menu->addChild('About us', ['route' => 'app_about']);
        $menu->addChild('Contact Us', ['route' => 'app_message_new']);


        return $menu;
    }
}