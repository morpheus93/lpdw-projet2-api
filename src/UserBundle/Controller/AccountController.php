<?php
/**
 * Controller for account entity
 */
namespace UserBundle\Controller;

use FOS\RestBundle\Request\ParamFetcherInterface;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use UserBundle\Entity\Account;
use FOS\RestBundle\Controller\Annotations as FOSRest;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


/**
 * Class AccountController
 *
 * Manage all action in relation with account entity
 *
 * @package     UserBundle\Controller
 * @category    controllers
 * @author      Elias Cédric Laouiti <elias@laouiti.me>
 *
 */

class AccountController extends Controller implements ClassResourceInterface
{
    /**
     * Create account
     *
     * @param ParamFetcherInterface $paramFetcher Contain all body parameters received
     * @return JsonResponse Return 201 and empty array if account was created OR 400 and error message JSON if error
     *
     * @ApiDoc(
     *  section="Accounts",
     *  description="Create new account",
     *  resource = true,
     *  statusCodes = {
     *     201 = "Returned when successful",
     *     400 = "Returned when password and confirmation doesn't match"
     *   }
     * )
     * @FOSRest\RequestParam(name="email", nullable=false, requirements=@CoreBundle\Validator\Constraints\Email, description="Account's email")
     * @FOSRest\RequestParam(name="password", nullable=false, description="Account's password")
     * @FOSRest\RequestParam(name="password_confirmation", nullable=false, description="Password confirmation")
     */
    public function postAction(ParamFetcherInterface $paramFetcher)
    {
        // TODO : Validator
        // TODO : Add email validation
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

	/**
	 * Update an account's password
	 *
	 * @param ParamFetcherInterface $paramFetcherInterface Contain all body parameters received
	 *
	 * @return JsonResponse Return 201 and empty array if account was created OR 400 and error message JSON if error
	 *
	 * @ApiDoc(
	 *  section="Accounts",
	 *  description="Update an account",
	 *  resource = true,
	 *  statusCodes = {
	 *     204 = "Returned when successful",
	 *     400 = "Returned when password and confirmation doesn't match OR when email is already used"
	 *   }
	 * )
	 * @FOSRest\Patch("/accounts/me/password")
	 * @FOSRest\RequestParam(name="password", nullable=false, description="Account's password")
	 * @FOSRest\RequestParam(name="password_confirmation", nullable=false, description="Password confirmation")
	 * @Secure(roles="IS_AUTHENTICATED_FULLY")
	 *
	 */
    public function patchPasswordAction(ParamFetcherInterface $paramFetcherInterface){
        $account = $this->getUser();

        if($paramFetcherInterface->get("password") != null){
            if($paramFetcherInterface->get("password") == $paramFetcherInterface->get("password_confirmation")){
                $account->setPlainPassword($paramFetcherInterface->get('password'));
                // TODO : Length constrainte
            } else {
                $resp = array("message" => "Password and confirmation password doesn't match");
                return new JsonResponse($resp, 400);
            }
        }

        $userManager = $this->get("fos_user.user_manager");
        $userManager->updateUser($account);
        $em = $this->getDoctrine()->getManager();
        $em->persist($account);
        $em->flush();
	    return new JsonResponse(null, 204);
    }

	/**
	 * Update an account's email
	 *
	 * @param ParamFetcherInterface $paramFetcherInterface Contain all body parameters received
	 *
	 * @return JsonResponse Return 201 and empty array if account was created OR 400 and error message JSON if error
	 *
	 * @ApiDoc(
	 *  section="Accounts",
	 *  description="Update an account email",
	 *  resource = true,
	 *  statusCodes = {
	 *     204 = "Returned when successful",
	 *     400 = "Returned when email is already used"
	 *   }
	 * )
	 * @FOSRest\Patch("/accounts/me/email")
	 * @FOSRest\RequestParam(name="email", nullable=false, description="Account's email")
	 * @Secure(roles="IS_AUTHENTICATED_FULLY")
	 *
	 */
    public function patchEmailAction(ParamFetcherInterface $paramFetcherInterface){
        $account = $this->getUser();

	    if($paramFetcherInterface->get("email") != null){
		    $account->setEmail($paramFetcherInterface->get('email'));
		    // TODO : Unique constrainte
	    }

        $userManager = $this->get("fos_user.user_manager");
        $userManager->updateUser($account);
        $em = $this->getDoctrine()->getManager();
        $em->persist($account);
        $em->flush();
	    return new JsonResponse(null, 204);
    }

    /**
     * Get all accounts
     * @return JsonResponse Return 200 and Account array if account was founded OR 404 and error message JSON if error
     *
     * @ApiDoc(
     *  section="Accounts",
     *  description="Get all Account",
     *  resource = true,
     *  statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when account is not found"
     *   }
     * )
     *
     * @Secure(roles="ROLE_USER")
     */
    public function cgetAction(){
        // TODO : Limit view to ROLE_ADMIN
        $em = $this->getDoctrine()->getRepository("UserBundle:Account");
        $accounts[] = $em->findAll();
        return $accounts;
    }

    /**
    * Get account info
    *
    * @param Account $account
    * @return Array
    */
    private function getAccountInfos(Account $account){

        // TODO : Get assos ou user info
    }

   /**
     * Get current user account 's
     * @return JsonResponse Return 200 and Account array if account was founded OR 404 and error message JSON if error
     *
     * @ApiDoc(
     *  section="Accounts",
     *  description="Get current user Account",
     *  resource = true,
     *  statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when account is not found"
     *   }
     * )
     *
     * @Secure(roles="IS_AUTHENTICATED_FULLY")
     */
    public function getMeAction(){
        return $this->getAccountInfos($this->getUser());
    }
    
    /**
     * Get an account
     * @param Account $account
     * @return JsonResponse Return 200 and Account array if account was founded OR 404 and error message JSON if error
     *
     * @ApiDoc(
     *  section="Accounts",
     *  description="Get an Account",
     *  resource = true,
     *  statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when account is not found"
     *   }
     * )
     * @ParamConverter("account", class="UserBundle:Account")
     *
     * @Secure(roles="ROLE_USER")
     */
    public function getAction(Account $account)
    {
        // TODO : Limit view to ROLE_ADMIN
	    return $this->getAccountInfos($account);
    }

}
