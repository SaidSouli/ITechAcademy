<?php

namespace App\Controller\Admin;

use App\Entity\Course;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextAreaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
class CourseCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Course::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('title'),
            TextAreaField::new('description'),
            TextField::new('price'),
            IntegerField::new('durationHours')
            ->setLabel('Duration (Hours)')
            ->setFormTypeOption('attr',['min'=> 1,] ),
            ChoiceField::new('level')->setChoices([
                'Beginner' => 'beginner',
                'Intermediate' => 'Intermediate',
                'Advanced'=>'advanced'
            ]),
            AssociationField::new('trainer'),
            DateTimeField::new('createdAt')->hideOnForm()
        ];
    }
    
}
