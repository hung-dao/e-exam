<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    public function index()
    {
        // if the user haven't logged in: return to login page
        // if user has logged in, return to homepage (the dashboard)
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    public function login()
    {
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
            'user_login' => true,
            'user_role' => 'teacher',
        ])  ;
    }

    public function logout()
    {
        // if the user haven't logged in: return to login page
        // if user has logged in, return to homepage (the dashboard)
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

}
