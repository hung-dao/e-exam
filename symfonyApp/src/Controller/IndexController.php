<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class IndexController extends Controller
{
    public function Index(Request $request)
    {
        /**
         * @Route("/login",name="login")
         */

        $authUtils = $this->get('security.authentication_utils');
        // get the login error if there is one
        $error = $authUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authUtils->getLastUsername();
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }
    public function Logout()
    {
        
    }
}
