<?php

namespace UserBundle\Controller;

use FOS\RestBundle\Routing\ClassResourceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use UserBundle\Entity\Association;
use UserBundle\Form\Type\AssociationType;
use Symfony\Component\Form\Form;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class AssociationController extends Controller implements ClassResourceInterface
{

/** Ajout d'une association */
    public function postAction(Request $request){
    	$association = new Association();
        return $this->formAssociation($association, $request, 'post');
    }

/** Création du formulaire association **/
   	private function formAssociation(Association $association, Request $request, $method = 'post'){
        $form = $this->createForm(AssociationType::class, $association, ['method' => $method]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($association);
            $em->flush();

            return new JsonResponse(array(""),200);
        }
        return new JsonResponse($this->getAllErrors($form), 400);
    }

    protected function getAllErrors(Form $form){
        $errorsString = [];
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