<?php

namespace App\Menu;

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

        $menu->addChild('Home', ['route' => 'app_home']);
        $menu->addChild('About us', ['route' => 'app_about']);
        $menu->addChild('Contact Us', ['route' => 'app_message_new']);

        $menu->addChild('Products', ['route' => 'app_product_index']);


        /** @var Product[] $products */
        $products = $this->entityManager->getRepository(Product::class)->findAll();

        foreach ($products as $product) {
            $menu['Products']->addChild($product->getType(), [
                'route'           => 'app_product_show',
                'routeParameters' => ['id' => $product->getId()],
            ]);
        }

        return $menu;
    }
}