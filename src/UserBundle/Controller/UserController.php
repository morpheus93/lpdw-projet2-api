<?php

namespace UserBundle\Controller;

use FOS\RestBundle\Routing\ClassResourceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use UserBundle\Entity\User;
use UserBundle\Form\Type\UserType;
use Symfony\Component\Form\Form;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class UserController extends Controller implements ClassResourceInterface
{

/** Ajout d'un utilisateur */
    public function postAction(Request $request){
    	$user = new User();
        return $this->formUser($user, $request, 'post');
    }

/** Création du formulaire utilisateur **/
   	private function formUser(User $user, Request $request, $method = 'post'){
        $form = $this->createForm(UserType::class, $user, ['method' => $method]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return new JsonResponse(array(""),200);
        }
        return new JsonResponse($this->getAllErrors($form));
    }
    
/** Recuperation des erreurs **/
    protected function getAllErrors(Form $form){
        $errorsString = [];
        /** @var \Symfony\Component\Form\FormInterface $child */
        foreach ($form->all() as $child)
        {
            $errors = $child->getErrors(true, false);
            foreach($errors as $error) {
                $errorsString[$child->getName()] = $error->getMessage(); // TODO translate ?
            }
        }
        return $errorsString;
    }
}