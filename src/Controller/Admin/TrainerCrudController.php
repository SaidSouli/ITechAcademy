<?php

namespace App\Controller\Admin;

use App\Entity\Trainer;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextAreaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class TrainerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Trainer::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('fullname'),
            TextAreaField::new('bio'),
            TextField::new('photourl'),
            AssociationField::new('courses'),
            
        ];
    }
    
}
