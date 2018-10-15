<?php

namespace App\Controller;

use App\Entity\Answer;
use App\Entity\Category;
use App\Entity\Exam;
use App\Entity\ExamForStudent;
use App\Entity\Question;
use App\Entity\StudentAnswer;
use App\Entity\User;
use App\Form\ExamByAutoCategoriesType;
use App\Form\ExamByQuestionsType;

use App\Repository\ExamRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;


class ExamController extends AbstractController
{
    /*
     * @Route("dashboard"), name ="dashboard",  methods="GET")
     */
    public function dashboard(ExamRepository $examRepository,UserRepository $userRepository) : Response
    {
        $Whoami= $this->getUser();
//        dump($Whoami);
        return $this->render('exam/dashboard.html.twig', [
            'exams' => $examRepository->findAll(),
            'user'=> $userRepository->findAll(),
            'ownername' => $Whoami
        ]);
    }

    //show all exam where exam.user = this.user
    /**
     * @Route("/exam/", name="exam_index", methods="GET")
     */
    public function index(ExamRepository $examRepository, UserRepository $userRepository): Response
    {
        $Whoami= $this->getUser()->getName();
        return $this->render('exam/index.html.twig', [
            'exams' => $examRepository->findBy(array('user' => $this->getUser())),
            'user' => $userRepository->findAll(),
            'ownername' => $Whoami
        ]);
    }

    /**
     * @Route("/exam/taking", name="open_exams", methods="GET")
     */
    public function openExams(ExamRepository $examRepository): Response
    {
        return $this->render('exam/open_exams.html.twig', ['exams' => $examRepository->findAll()]);
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
     * @Route("/exam/preview_category_exam", name="exam_category_preview", methods="GET|POST")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function previewWithCategory(Request $request )
    {

        $category = $this->getDoctrine()->getRepository(Category::class)->findOneBy(array('id' => $request->get('categoryId')));
//        dump($category);
        $numOfQues = $request->get('numberOfQuestions');
        $exam = new Exam();
        $exam->setName($category->getCategoryName() . ' Test')
            ->setNumberOfQuestions($numOfQues);
        $questions = $this->getQuestionsByRequest($category, $numOfQues);
        if (count($questions) < $numOfQues) {
            $exam->setNumberOfQuestions(count($questions));
        }
        foreach ($questions as $question) {
            $exam->addQuestion($question);
            //$question->addExam($exam);
        }

        $form = $this->createForm(ExamByAutoCategoriesType::class, $exam);
        $form->handleRequest($request);

        if ($form -> isSubmitted()) {
            $exam->setIsOpen(true)
                ->setUser($this->getUser())
                ->setOpenDate(new \DateTime("now"));

            foreach ($exam->getQuestions() as $question) {
                $question->addExam($exam);
            };
            $em = $this->getDoctrine()->getManager();
            $em->persist($exam);
            $em->flush();

//            dump($exam);

            return $this->redirectToRoute('exam_show', ['id' => $exam->getId()]);
        }

        return $this->render('exam/preview2.html.twig', [
            'form' => $form->createView(),
            'exam' => $exam,
            'categoryId' => $request->get('categoryId'),
            'numberOfQuestions' => $request->get('numberOfQuestions')
        ]);
    }

    /**
     * @Route("/exam/new-exam-by-categories", name="exam_new_by_categories", methods="GET|POST")
     * @param Request $request
     * @return Response
     */
    public function newByCategories(Request $request): Response
    {
        $form = $this->createFormBuilder()
            ->add('category', EntityType::class, array(
                'label' => 'Category',
                'class' =>'App\Entity\Category',
                //'mapped' =>false,
                'placeholder' => "Please select category",
                'choice_label' => 'categoryName'
            ))
            ->add('numberOfQuestions', NumberType::class, array( 'label' => "Number Of Questions"))
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData(); //to string
            $category = $data['category'];

            return $this->redirectToRoute('exam_category_preview', [
                'categoryId' => $category->getId(),
                'numberOfQuestions' => $data['numberOfQuestions']
            ] );
        }

        return $this->render('exam/new_by_categories.html.twig', [
            'form' => $form->createView(),
        ]);
    }
//

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

            $em = $this->getDoctrine()->getManager();

            foreach ($exam->getQuestions() as $question) {
                $exam->addQuestion($question);
                $question->addExam($exam);
                $em->persist($question);
            }

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
        $Whoami= $this->getUser();
        return $this->render('exam/show.html.twig', [
            'exam' => $exam,
            'whoami' => $Whoami
        ]);

    }

    /**
     * @Route("/exam/take/{id}", name="exam_take", methods="GET|POST")
     */
    public function take(Request $request, Exam $exam): Response
    {
        return $this->render('exam/take.html.twig', [
            'exam' => $exam,
        ]);
    }

    /**
     * @Route("exam/{id}/preview_answers", name="preview_exam_answer", methods="POST")
     */
    public function previewAnswer(Request $request): Response
    {
//        dump($request);
//
//        dump($request->get('id'));
        $exam = $this->getDoctrine()->getRepository(Exam::class)
            ->findOneBy(['id' => $request->get('id')]);
        $totalQuestion = count($exam->getQuestions());

//        dump($exam);
//        dump($request->request->all());
        $answers = $request->request->all();
        $form = $this->createFormBuilder()->add('Submit', SubmitType::class)->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $studentExam = new ExamForStudent();
            $studentExam->setUser($this->getUser());
            $studentExam->setExam( $exam );

            $quesIndex = 1;
            $correctAns = 0;
            foreach ($exam->getQuestions() as $question) {
                $studentAns = new StudentAnswer();
                $ans = $this->getDoctrine()->getRepository(Answer::class)->findOneBy(
                    ['id' => $request->request->get('question'.$quesIndex)]
                );
                $studentAns->setAnswer( $ans );
                if ($ans->getIsCorrect()) {
                    $studentAns->setResult(true);
                    $correctAns ++;
                }
                $studentAns->setQuestion($ans->getQuestion());
                $studentExam->addAnswersSheet($studentAns);
                $this->getUser()->setStudentAnswer($studentAns);
                $quesIndex ++;
                //$em->persist($studentAns);
            }
            $studentExam->setResult($correctAns/$totalQuestion*100);
            $this->getUser()->setExamForStudent($studentExam);
            $studentExam->setStatus("done");
            dump($studentExam);
            $em->persist($studentExam);
            $em->flush($studentExam);

            return $this->redirectToRoute('result_exam', [
                'id' => $exam->getId(),
                'studentExam_id' => $studentExam->getId(),
            ]);
        }

        return $this->render('exam/preview_student_exam.html.twig', [
            'form' => $form->createView(),
            'exam' => $exam,
            'answers' => $answers
        ]);
    }

    // show result of an exam
    /**
     * @Route("/exam/{id}/result", name="result_exam", methods="GET|POST")
     */
    public function examResult(Request $request, Exam $exam)
    {
        $examStd = null;
        if ($request->get('studentExam_id') != null ) {
            $examStd = $this->getDoctrine()->getRepository(ExamForStudent::class)
                ->findOneBy(['id' => $request->get('studentExam_id')]);

        } else {
            //$exam_id = $this->getDoctrine()->getRepository(Exam::class)->findOneBy(['id' => $request->get('id')]);
            $exam_id = $exam->getId();
            foreach ($exam->getExamForStudents() as $studentExam) {
                if($studentExam->getUser() == $this->getUser()) {
                    $examStd = $studentExam;
                }
            }
        }

        if ($examStd == null) {
            $examDone = false;
        } else {
            $examDone = true;
        }

        return $this->render('exam/result_for_an_exam.html.twig', [
            'exam' => $exam,
            'examForStudent' => $examStd,
            'examDone' => $examDone
        ]);

//        if (!$request->get('studentExam'))
//        {
//            $studentExam = $request->get('studentExam');
//        } else {
//            $studentExam = $this->getDoctrine()->getRepository(ExamForStudent::class)->findOneBy(
//                [
//                    'exam' => $request->get()
//                ]
//            )
//        }
//
//        return $this->render('exam')
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

    public function getQuestionsByRequest( $category, $val )
    {
        $questions = $this->getDoctrine()->getRepository(Question::class)->findQuestionsByCategory($category, $val);
        return $questions;
    }
}
