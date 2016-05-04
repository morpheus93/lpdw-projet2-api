<?php
/**
 * Controller for association entity
 */
namespace UserBundle\Controller;

use FOS\RestBundle\Routing\ClassResourceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use UserBundle\Entity\Association;
use FOS\RestBundle\Controller\Annotations as FOSRest;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use UserBundle\Form\Type\AssociationType;
use Symfony\Component\Form\Form;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
/**
 * Class AssociationController
 *
 * Manage all action in relation with association entity
 *
 * @package     UserBundle\Controller
 * @category    controllers
 * @author      Mavillaz Remi <remi.mavillaz@live.fr>
 *
 */
class AssociationController extends Controller implements ClassResourceInterface
{
    /**
     * @ApiDoc(
     *  description="Link account with an association",
     *  input="Your\Namespace\Form\Type\YourType",
     *  output="UserBundle/Entity/Association"
     * )
     */

    /**
     * Link account with association
     *
     * @param ParamFetcherInterface $paramFetcher Contain all body parameters received
     * @return JsonResponse Return 201 and empty array if account was linked OR 400 and error message JSON if error
     *
     * @ApiDoc(
     *  section="Associations",
     *  description="Create Association",
     *  resource = true,
     *  statusCodes = {
     *     201 = "Returned when successful",
     *   }
     * )
     * @FOSRest\RequestParam(name="code", nullable=false, description="Association's code")
     * @FOSRest\RequestParam(name="name", nullable=false, description="Association's name")
     * @FOSRest\RequestParam(name="description", nullable=false, description="Association's description")
     * @FOSRest\RequestParam(name="leader_name", nullable=false, description="Association's leader name")
     * @FOSRest\RequestParam(name="leader_phone", nullable=false, description="Association's leader phone")
     * @FOSRest\RequestParam(name="leader_email", nullable=false, description="Association's leader email")
     *
     */
    public function postAction(ParamFetcherInterface $paramFetcher){

    	$association = new Association();
        $association->setCode($paramFetcher->get('code'));
        $association->setName($paramFetcher->get('name'));
        $association->setDescription($paramFetcher->get('description'));
        $association->setLeaderName($paramFetcher->get('leader_name'));
        $association->setLeaderPhone($paramFetcher->get('leader_phone'));
        $association->setLeaderEmail($paramFetcher->get('leader_email'));

        $em = $this->getDoctrine()->getManager();
        $em->persist($association);
        $em->flush();

        return new JsonResponse(null, 201);
    }
}