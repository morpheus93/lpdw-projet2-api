<?php
/**
 * Controller for promise entity
 */
namespace CoreBundle\Controller;

use FOS\RestBundle\Routing\ClassResourceInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use CoreBundle\Entity\Promise;
use CoreBundle\Entity\Project;

use FOS\RestBundle\Controller\Annotations as FOSRest;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
/**
 * Class PromiseController
 *
 * Manage all action in relation with association entity
 *
 * @package     CoreBundle\Controller
 * @category    controllers
 * @author      Mavillaz Remi <remi.mavillaz@live.fr>
 *
 */
class PromiseController extends Controller implements ClassResourceInterface
{
    /**
     * @ApiDoc(
     *  description="Create a promise",
     *  input="Your\Namespace\Form\Type\YourType",
     *  output="CoreBundle/Entity/Promise"
     * )
     */

    /**
     * Create a project
     *
     * @param ParamFetcherInterface $paramFetcher Contain all body parameters received
     * @return JsonResponse Return 201 and empty array if account was linked OR 400 and error message JSON if error
     *
     * @ApiDoc(
     *  section="Promises",
     *  description="Create promise",
     *  resource = true,
     *  statusCodes = {
     *     201 = "Returned when successful",
     *   }
     * )
     * @FOSRest\RequestParam(name="amount", nullable=false, requirements="\d+", description="Promise's amount")
     * @FOSRest\RequestParam(name="userHidden", nullable=false, description="Promise's amount")
     * @FOSRest\RequestParam(name="projectId", nullable=false, description="project's id")
     *
     */
	public function postAction(ParamFetcherInterface $paramFetcher){
		$account = $this->getUser();
        $promise = new Promise();;
        $project = $this->getDoctrine()->getRepository('CoreBundle:Project')->find($paramFetcher->get('projectId'));

        if (!$project) {
            $resp = array("message" => "This project does not exist");
            return new JsonResponse($resp, 400);
        }

        $paramFetcher->get('amount');
        $promise->setAccount($account);
        $promise->setProject($project);
        $promise->setAmount($paramFetcher->get('amount'));

        if($paramFetcher->get('userHidden') == true ){
            $promise->setUserHidden(true);
        } else{
            $promise->setUserHidden(false);
        }
        

        $em = $this->getDoctrine()->getManager();
        $em->persist($promise);
        $em->flush();

        return new JsonResponse(null, 201);
    }
    public function cgetAction()
    {
    	$promises = $this->getDoctrine()->getRepository('CoreBundle:Promise')->findAll();

    	return $promises;
    }
	
}