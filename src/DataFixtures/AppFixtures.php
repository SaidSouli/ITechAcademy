<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use App\Entity\Trainer;
use App\Entity\Course;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }
    public function load(ObjectManager $manager): void
    {
        

        $admin = new User();
        $admin->setEmail("admin1@gmail.com");
        $admin->setFullname("Wahida Labidi");
        $plaintextPassword = "wahida123";
        $hashedPassword = $this->passwordHasher->hashPassword(
            $admin,
            $plaintextPassword
        );
        $admin->setPassword($hashedPassword);
        $admin->setRoles(["ROLE_ADMIN"]);
        $manager->persist($admin);

        $student1 = new User();
        $student1->setEmail("student1@gmail.com");
        $student1->setFullname("said souli");
        $password1 = 'saidpassword';
        $hashedPassword = $this->passwordHasher->hashPassword($student1,$password1);
        $student1->setPassword($hashedPassword);
        $student1->setRoles(['ROLE_USER']);
        $manager->persist($student1);
        
        $student2 = new User();
        $student2->setEmail("student2@gmail.com");
        $student2->setFullname("imed dhihbi");
        $password2 = 'imadpassword';
        $hashedPassword = $this->passwordHasher->hashPassword($student2,$password2);
        $student2->setPassword($hashedPassword);
        $student2->setRoles(['ROLE_USER']);
        $manager->persist($student2);
        
        $trainer1 = new Trainer();
        $trainer1->setFullname("sami chhibi");
        $trainer1->setBio("trainer for php language");
        $trainer1->setPhotoUrl("#");
        $manager->persist($trainer1);
        $trainer2 = new Trainer();
        $trainer2->setFullname("alex perreira");
        $trainer2->setBio("trainer for java language");
        $trainer2->setPhotoUrl("#");
        $manager->persist($trainer2);
        $trainer3 = new Trainer();
        $trainer3->setFullname("ilia topuria");
        $trainer3->setBio("trainer for python language");
        $trainer3->setPhotoUrl("#");
        $manager->persist($trainer3);
        
        $course = new Course();
            $course->setTitle('php language');
            $course->setDescription('php for beginners');
            $course->setPrice('0.99');
            
            
            $course->setDurationHours(1); 
            
            $course->setLevel('beginner');
            $course->setCreatedAt(new \DateTimeImmutable());
            $course->setTrainer($trainer1);
            $manager->persist($course);

        

        



        $manager->flush();
    }
}
