<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class IndexController extends AbstractController
{
    public function Index(Request $request)
    {
        // if the user haven't logged in: return to login page
        // if user has logged in, return to homepage (the dashboard)
        /**
         * @Route("/login",name="login")
         */
      
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }
    public function Logout()
    {
        
    }
}
