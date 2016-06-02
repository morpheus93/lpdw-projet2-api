<?php
/**
 * Controller for project entity
 */
namespace CoreBundle\Controller;

use CoreBundle\Entity\Promise;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use CoreBundle\Entity\Project;

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
		// TODO : Ajout de l'association + Date publication?
		// TODO : Ajout de l'image
        $project = new Project();
        $project->setName($paramFetcher->get('name'));
        $project->setDescription($paramFetcher->get('description'));
        $project->setVisibility(1);
		$project->setState(1);

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
    	$projects[] = $this->getDoctrine()->getRepository('CoreBundle:Project')->findAll();

    	return $projects;
    }
	
}