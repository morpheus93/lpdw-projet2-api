<?php

namespace UserBundle\Controller;

use FOS\RestBundle\Routing\ClassResourceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AccountController extends Controller implements ClassResourceInterface
{

    public function postAction(){
        return "GOOD";
    }
}
