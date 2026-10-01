<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use App\Entity\User;

final class MyCoursesController extends AbstractController
{
    #[Route('/my/courses', name: 'app_my_courses')]
    #[IsGranted('ROLE_USER')]
    public function index(): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        return $this->render('my_courses/index.html.twig', [
            'enrollments' => $user->getEnrollments(),
        ]);
    }
}
