<?php
/**
 * Controller for user entity
 */
namespace UserBundle\Controller;

use FOS\RestBundle\Routing\ClassResourceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use UserBundle\Entity\User;
use UserBundle\Form\Type\UserType;
use Symfony\Component\Form\Form;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use FOS\RestBundle\Controller\Annotations as FOSRest;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * Class UserController
 *
 * Manage all action in relation with association entity
 *
 * @package     UserBundle\Controller
 * @category    controllers
 * @author      Mavillaz Remi <remi.mavillaz@live.fr>
 *
 */
class UserController extends Controller implements ClassResourceInterface
{
    /**
     * @ApiDoc(
     *  description="Link account with an user",
     *  input="Your\Namespace\Form\Type\YourType",
     *  output="UserBundle/Entity/User"
     * )
     */

    /**
     * Link account with user
     *
     * @param ParamFetcherInterface $paramFetcher Contain all body parameters received
     * @return JsonResponse Return 201 and empty array if account was linked OR 400 and error message JSON if error
     *
     * @ApiDoc(
     *  section="Users",
     *  description="Create User",
     *  resource = true,
     *  statusCodes = {
     *     201 = "Returned when successful",
     *   }
     * )
     * @FOSRest\RequestParam(name="name", nullable=false, description="User's name")
     * @FOSRest\RequestParam(name="lastname", nullable=false, description="User's lastname")
     * @FOSRest\RequestParam(name="birth_date", nullable=false, description="User's birth date")
     *
     */
    public function postAction(ParamFetcherInterface $paramFetcher){
		$account = $this->getUser();
		
        $user = new User();
        $user->setName($paramFetcher->get('name'));
        $user->setLastname($paramFetcher->get('lastname'));
        $birthDate = new \DateTime($paramFetcher->get('birth_date'));
        $user->setBirthDate($birthDate);
		$user->setAccount($account);
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return new JsonResponse(null, 201);
    }
}