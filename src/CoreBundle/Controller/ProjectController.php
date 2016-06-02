<?php
/**
 * Controller for project entity
 */
namespace CoreBundle\Controller;

use FOS\RestBundle\Routing\ClassResourceInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use CoreBundle\Entity\Project;
use CoreBundle\Entity\Promise;
use CoreBundle\Entity\Association;

use FOS\RestBundle\Controller\Annotations as FOSRest;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
/**
 * Class ProjectController
 *
 * Manage all action in relation with association entity
 *
 * @package     CoreBundle\Controller
 * @category    controllers
 * @author      Mavillaz Remi <remi.mavillaz@live.fr>
 * @author      Laouiti Elias <elias@laouiti.me>
 *
 */
class ProjectController extends Controller implements ClassResourceInterface
{
    /**
     * @ApiDoc(
     *  description="Create a project",
     *  input="Your\Namespace\Form\Type\YourType",
     *  output="CoreBundle/Entity/Project"
     * )
     */

    /**
     * Create a project
     *
     * @param ParamFetcherInterface $paramFetcher Contain all body parameters received
     * @return JsonResponse Return 201 and empty array if account was linked OR 400 and error message JSON if error
     *
     * @ApiDoc(
     *  section="Projects",
     *  description="Create project",
     *  resource = true,
     *  statusCodes = {
     *     201 = "Returned when successful",
     *   }
     * )
     * @FOSRest\RequestParam(name="name", nullable=false, description="Project's name")
     * @FOSRest\RequestParam(name="description", nullable=false, description="Project's description")
     *
     */
	public function postAction(ParamFetcherInterface $paramFetcher){
		$account = $this->getUser();
        $association = $this->getDoctrine()->getRepository('UserBundle:Association')->findOneBy(["account" => $account]);
		// TODO : Date publication
		// TODO : Ajout de l'image
        $date = new \DateTime();
        $project = new Project();
        $project->setAssociation($association);
        $project->setName($paramFetcher->get('name'));
        $project->setDescription($paramFetcher->get('description'));
        $project->setVisibility(1);
		$project->setState(1);
        $project->setdatePublication($date);

        $em = $this->getDoctrine()->getManager();
        $em->persist($project);
        $em->flush();

        return new JsonResponse(null, 201);
    }

    /**
     * Update a project
     *
     * @param ParamFetcherInterface $paramFetcher Contain all body parameters received
     * @return JsonResponse Return 201 and empty array if account was linked OR 400 and error message JSON if error
     *
     * @ApiDoc(
     *  section="Projects",
     *  description="Update a project",
     *  resource = true,
     *  statusCodes = {
     *     201 = "Returned when successful",
     *   }
     * )
     * @FOSRest\RequestParam(name="name", nullable=true, description="Project's name")
     * @FOSRest\RequestParam(name="description", nullable=true, description="Project's description")
     *
     */
    public function patchAction(Project $project, ParamFetcherInterface $paramFetcher){
        $account = $this->getUser();
        // TODO : validation
        $project->setName($paramFetcher->get('name'));
        $project->setDescription($paramFetcher->get('description'));        
        $em = $this->getDoctrine()->getManager();
        $em->persist($project);
        $em->flush();
        return new JsonResponse(null, 201);
    }

	/**
	* Get all projects
	*
	* @return Project[] Empty Project array if no project founded
	*
	* @ApiDoc(
	*  section="Projects",
	*  description="Get all projects",
	*  resource = true,
	*  statusCodes = {
	*     200 = "Returned when successful",
	*   }
	* )
	**/
    public function cgetAction()
    {
    	$projects = $this->getDoctrine()->getRepository('CoreBundle:Project')->findAll();
    	return $projects;
    }
    /**
     * Create a promise
     *
     * @param ParamFetcherInterface $paramFetcher Contain all body parameters received
     * @return JsonResponse Return 201 and empty array if account was linked OR 404 is project not exist
     *
     * @ApiDoc(
     *  section="Projects",
     *  description="Create promise",
     *  resource = true,
     *  statusCodes = {
     *     201 = "Returned when successful",
     *   }
     * )
     * @FOSRest\RequestParam(name="amount", nullable=false, requirements="\d+", description="Promise's amount")
     * @FOSRest\RequestParam(name="userHidden", nullable=false, description="User hidden")
     *
     */
    public function postPromiseAction(ParamFetcherInterface $paramFetcher, Project $project){
        $account = $this->getUser();
        $promise = new Promise();;

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
    
    /**
     * Get all promises
     *
     * @return Promise Empty Promise array if no project founded
     *
     * @ApiDoc(
     *  section="Projects",
     *  description="Get all promises for a project",
     *  resource = true,
     *  statusCodes = {
     *     200 = "Returned when successful",
     *   }
     * )
     **/
    public function getPromiseAction(Project $project){

        $promises = $this->getDoctrine()->getRepository('CoreBundle:Promise')->findBy(["project" => $project]);

        return $promises;
    }
}