<?php

namespace App\Controller\Admin;

use App\Entity\Flash;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class FlashCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Flash::class;
        
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
    
            // You can use a Form Panel inside a Form Tab
            FormField::addPanel('Flashs Details'),
    
            // Your fields
            NumberField::new('price'),
            IntegerField::new('size'),
            TextEditorField::new('description'),
            AssociationField::new('tatoueurs'),

        ];
    }
}
