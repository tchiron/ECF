<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/signin", name="app_signin")
     */
    public function index(\Symfony\Component\HttpFoundation\Request $req, \App\Service\PasswordHash $passwordHash ) {
        $dto = new \App\DTO\SigninDTO();
        $form = $this->createForm(\App\Form\SigninType::class, $dto);
        $form->handleRequest($req);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $user = new \App\Entity\User();
            $user->setUsername($dto->getUsername());
            $user->setPassword($dto->getPassword());
            $user->setEmail($dto->getEmail());
            $user->setRoles(['ROLE_USER']);
            $user = $passwordHash->hash($user);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            
            return $this->redirectToRoute("app_login");
        }
        
        return $this->render("user/index.html.twig", [
            "monForm" => $form->createView()
        ]);
    }
}
