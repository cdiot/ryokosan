<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title', 'label.title'),
            SlugField::new('slug', 'label.slug')
                ->setTargetFieldName('title'),
            TextEditorField::new('content', 'label.content'),
            TextareaField::new('featuredText', 'label.featured_text'),
            AssociationField::new('categories', 'label.categories'),
            AssociationField::new('featuredImage', 'label.featured_image'),
            DateTimeField::new('createdAt', 'label.created_at')->hideOnForm(),
            DateTimeField::new('updatedAt', 'label.updated_at')->hideOnForm(),
        ];
    }
}
