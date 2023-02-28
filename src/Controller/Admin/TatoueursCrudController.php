<?php

namespace App\Controller\Admin;

use App\Entity\Tatoueurs;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;

class TatoueursCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Tatoueurs::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('firstName'),
            TextField::new('lastname'),
            TextField::new('instagram'),
            TextField::new('email'),
            TextEditorField::new('description'),
            BooleanField::new('allColors'),
            // TextField::new('imageUrl')->setHelp('Image URL must include the extension (.jpg, .png, etc.)'),
            ImageField::new('imageUrl')
                ->setBasePath('uploads/images/')
                ->setUploadDir('public/uploads/images/')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
            
                DateTimeField::new('createdAt')->hideOnForm(),
                DateTimeField::new('updatedAt')->hideOnForm(),
        
                AssociationField::new('salon')
        ];
    }
    
}
