<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Exam;
use App\Form\ExamByCategoriesType;
use App\Form\ExamByQuestionsType;
use App\Repository\ExamRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ExamController extends AbstractController
{
    /*
     * @Route("dashboard"), name ="dashboard",  methods="GET")
     */
    public function dashboard(ExamRepository $examRepository) : Response
    {
        return $this->render('exam/index.html.twig', ['exams' => $examRepository->findAll()]);
    }
    /**
     * @Route("/exam/", name="exam_index", methods="GET")
     */
    public function index(ExamRepository $examRepository): Response
    {
        return $this->render('exam/index.html.twig', ['exams' => $examRepository->findAll()]);
    }

    /**
     * @Route("/exam/new", name="exam_new", methods="GET|POST")
     */
    public function new()
    {
        return $this->render('exam/new.html.twig');
    }

    /**
     * @Route("/exam/preview/{id}", name="exam_preview", methods="GET|POST")
     */
    public function preview(Request $request, Exam $exam)
    {
        dump($request->get('id'));
        dump($exam);
        $form = $this->createForm(ExamByQuestionsType::class, $exam);
        $form->handleRequest($request);

        if ($form -> isSubmitted()) {
            return $this->redirectToRoute('exam_show', ['id' => $exam->getId()]);
        }

        return $this->render('exam/preview.html.twig', [
            'exam' => $exam,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/exam/new-exam-by-categories", name="exam_new_by_categories", methods="GET|POST")
     */
    public function newByCategories(Request $request): Response
    {
        $exam = new Exam();
        $form = $this->createForm(ExamByCategoriesType::class, $exam);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            return $this->redirectToRoute('exam_preview', [
                'exam' => $exam,
            ]);
        }

        return $this->render('exam/new_by_categories.html.twig', [
            'exam' => $exam,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/exam/new-exam-by-questions", name="exam_new_by_questions", methods="GET|POST")
     */
    public function newByQuestions(Request $request): Response
    {
        $exam = new Exam();
        $form = $this->createForm(ExamByQuestionsType::class, $exam);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $exam->setIsOpen(true)
                ->setName('General Exam')
                ->setUser($this->getUser())
                ->setOpenDate(new \DateTime("now"))
                ->setNumberOfQuestions($exam->getQuestions()->count());

            foreach ($exam->getQuestions() as $question) {
                $question -> addExam($exam);
            };
            $em = $this->getDoctrine()->getManager();
            $em->persist($exam);
            $em->flush();
            return $this->redirectToRoute('exam_preview', [
                'id' => $exam->getId(),
            ]);
        }

        return $this->render('exam/new_by_questions.html.twig', [
            'exam' => $exam,
            'form' => $form->createView(),
        ]);


    }

    /**
     * @Route("/exam/{id}", name="exam_show", methods="GET")
     */
    public function show(Exam $exam): Response
    {
        return $this->render('exam/show.html.twig', ['exam' => $exam]);
    }

    /**
     * @Route("/exam/{id}/edit", name="exam_edit", methods="GET|POST")
     */
    public function edit(Request $request, Exam $exam): Response
    {
        $form = $this->createForm(ExamByQuestionsType::class, $exam);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('exam_show', ['id' => $exam->getId()]);
        }

        return $this->render('exam/edit.html.twig', [
            'exam' => $exam,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/exam/{id}", name="exam_delete", methods="DELETE")
     */
    public function delete(Request $request, Exam $exam): Response
    {
        if ($this->isCsrfTokenValid('delete'.$exam->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($exam);
            $em->flush();
        }

        return $this->redirectToRoute('exam_index');
    }
}
