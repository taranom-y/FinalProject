<?php

namespace App\Product;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;

class SearchService
{
    private EntityManagerInterface $entityManager;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function  __construct(EntityManagerInterface $entityManager){
       $this->entityManager =$entityManager;
    }

    /**
     * @param $productNameQuery
     * @return array
     */
    public  function search($productNameQuery):array{
        /** @var \App\Repository\ProductRepository  $productRepository */
          $productRepository =$this->entityManager->getRepository(Product::class);
          return $productRepository->searchByName($productNameQuery);
    }
}