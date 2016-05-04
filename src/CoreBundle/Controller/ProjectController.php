<?php

namespace CoreBundle\Controller;

use FOS\RestBundle\Routing\ClassResourceInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use CoreBundle\Entity\Project;

class ProjectController extends Controller implements ClassResourceInterface
{
    public function cgetAction()
    {
    	$projects = $this->getDoctrine()->getRepository('CoreBundle:Project')->findAll();
        return $projects;
    }
}