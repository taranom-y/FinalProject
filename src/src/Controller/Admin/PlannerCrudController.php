<?php

namespace App\Controller\Admin;

use App\Entity\Planner;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PlannerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Planner::class;
    }

    public function  configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->update(Crud::PAGE_INDEX,Action::NEW,function(Action $action){
                return $action->setIcon('fa fa-plus-square')->addCssClass('btn btn-success');
            })
            ->update(Crud::PAGE_INDEX,Action::EDIT,function(Action $action){
                return $action->setIcon('fa fa-edit')->addCssClass('btn btn-warning');
            })
            ->update(Crud::PAGE_INDEX,Action::DETAIL,function(Action $action){
                return $action->setIcon('fa fa-eye')->addCssClass('btn btn-info');
            })
            ->update(Crud::PAGE_INDEX,Action::DELETE,function(Action $action){
                return $action->setIcon('fa fa-trash')->addCssClass('btn btn-outline-danger');
            });

    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name'),
            NumberField::new('price'),
            TextField::new('type'),
            TextField::new('description'),
            ImageField::new('image')
                ->setBasePath('/images')
                ->setUploadDir('assets/images')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
        ];
    }
    public function configureFilters(Filters $filters): Filters
    {
        return  $filters
            ->add('name');
    }

}
