<?php

namespace App\Controller\Admin;

use App\Entity\Rubric;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class RubricCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Rubric::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id', 'ID')->onlyOnIndex(),
            TextField::new('name', 'label.name'),
        ];
    }
}
