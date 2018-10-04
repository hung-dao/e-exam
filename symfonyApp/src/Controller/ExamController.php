<?php

namespace App\Controller;

use App\Entity\Exam;
use App\Form\ExamType;
use App\Repository\ExamRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExamController extends AbstractController
{
    public function Dashboard()
    {
        $user = $this->getUser();
        return $this->render('exam/index.html.twig', [
            'controller_name' => 'ExamController',
            'user' => $user->getName()
        ]);
    }

    /**
     * @Route("/view-all", name="exam_index", methods="GET")
     */
    public function index(ExamRepository $examRepository): Response
    {
        return $this->render('exam/index.html.twig', ['exams' => $examRepository->findAll()]);
    }

    /**
     * @Route("/create-exam", name="create_new_exam", methods="GET|POST")
     */
    public function newExam(Request $request): Response
    {
        $exam = new Exam();
        $form = $this->createForm(ExamType::class, $exam);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($exam);
            $em->flush();

            return $this->redirectToRoute('exam_index');
        }

        return $this->render('exam/new.html.twig', [
            'exam' => $exam,
            'form' => $form->createView(),
        ]);
    }

}
