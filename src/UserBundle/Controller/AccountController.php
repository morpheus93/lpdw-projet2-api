<?php

namespace UserBundle\Controller;

use FOS\RestBundle\Request\ParamFetcherInterface;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\JsonResponse;
use UserBundle\Entity\Account;
use FOS\RestBundle\Controller\Annotations as FOSRest;

class AccountController extends Controller implements ClassResourceInterface
{
    /**
     * @ApiDoc(
     *  description="Create a new account",
     *  input="Your\Namespace\Form\Type\YourType",
     *  output="UserBundle/Entity/Account"
     * )
     */

    /**
     * Create account
     *
     * @param ParamFetcherInterface $paramFetcher
     * @return JsonResponse
     *
     * @ApiDoc(
     *  section="Emotions",
     *  description="Get list of emotions",
     *  resource = true,
     *  statusCodes = {
     *     201 = "Returned when successful",
     *     400 = "Returned when password and confirmation doesn't match"
     *   }
     * )
     * @FOSRest\RequestParam(name="email", nullable=false, description="Account's email")
     * @FOSRest\RequestParam(name="password", nullable=false, description="Account's password")
     * @FOSRest\RequestParam(name="password_confirmation", nullable=false, description="Password confirmation")
     *
     */
    // TODO : Validator
    // TODO : Add email validation
    public function postAction(ParamFetcherInterface $paramFetcher){

        if ($paramFetcher->get('password') !== $paramFetcher->get('password_confirmation')) {
            $resp = array("message" => "Password and confirmation password doesn't match");
            return new JsonResponse($resp, 400);
        }

        $account = new Account();
        $account->setEmail($paramFetcher->get('email'));
        $account->setPlainPassword($paramFetcher->get('password'));
        $account->setEnabled(true);


        $userManager = $this->get("fos_user.user_manager");
        $userManager->updateUser($account);

        $em = $this->getDoctrine()->getManager();
        $em->persist($account);
        $em->flush();

        return new JsonResponse(null, 201);
    }
}
