<?php

namespace App\Controller;

use App\Entity\Enrollment;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Course;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use App\Repository\EnrollmentRepository;
use Symfony\Component\HttpFoundation\Request;

#[Route('/course')]
final class CourseController extends AbstractController
{
    #[Route('/', name: 'app_course', methods:['GET'])]
    #[IsGranted('ROLE_USER')]
    public function index(EntityManagerInterface $em): Response
    {
        $courses = $em->getRepository(Course::class)->findAll();
        return $this->render('course/course.html.twig', [
            'courses' => $courses,
        ]);
    }

    #[Route('/all',methods:["GET"])]
    public function getAllCourses(EntityManagerInterface $em): JsonResponse
    {
        $courses = $em->getRepository(Course::class)->findAll();
        return $this->json($courses);
    }
    
    #[Route("/{id}",methods:["GET"])]
    public function getCourseById(Course $course): JsonResponse
    {
        return $this->json($course);

    }

    #[Route('/{id}/show' , name: 'app_course_show' , methods:(['GET']) )]
    #[IsGranted('ROLE_USER')]
    public function show (Course $course , EnrollmentRepository $er)
    {
        $enrollement = $er->findOneBy([
            'student' => $this->getUser(),
            'course' => $course

        ]);
        return $this-> render('course/show.html.twig' , [
            'course' => $course,
            'alreadyEnrolled' => $enrollement !== null
        ]);
    }


    #[Route('/{id}/enroll', name: 'app_course_enroll' , methods:['POST'])]
    #[IsGranted('ROLE_USER')]
    public function enroll(Request $request , Course $course , EntityManagerInterface $em , EnrollmentRepository $er): Response
    {

        if(!$this->isCsrfTokenValid('enroll' . $course->getId(), $request->getPayload()->get('_token')))
        {
            throw $this->createAccessDeniedException('Invalid CSRF token');
        }

        $existing = $er->findOneBy([
            'student' => $this->getUser(),
            'course' => $course,
        ]);   
        if($existing)
        {
            $this->addFlash('warning','You are already enrolled my friend ');
            
            $this->redirectToRoute('app_course_show' , ['id' => $course->getId()]);
        }

        $enrollment = new Enrollment();
        $enrollment->setStudent($this->getUser());
        $enrollment->setCourse($course);
        $enrollment->setEnrolledAt(new \DateTimeImmutable());

        $em->persist($enrollment);
        $em->flush();
        
        $this->addFlash('success' , 'You are now enrolled in "'. $course->getTitle() . '" .' );

        $this->redirectToRoute('app_course_show' , ['id' => $course->getId()]);
        
        return $this->redirectToRoute('app_my_courses');
    }


}
