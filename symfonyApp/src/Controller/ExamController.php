<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}
