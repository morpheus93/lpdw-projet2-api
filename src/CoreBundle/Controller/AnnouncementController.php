<?php

	namespace CoreBundle\Controller;

	use CoreBundle\Entity\Announcement;
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
	 * Class AnnouncementController
	 *
	 * Manage all action in relation with announcement entity
	 *
	 * @package     CoreBundle\Controller
	 * @category    controllers
	 * @author      Laouiti Elias <elias@laouiti.me>
	 *
	 */
	class AnnouncementController extends Controller implements ClassResourceInterface
	{

		/**
		 * Create an anouncement
		 *
		 * @param ParamFetcherInterface $paramFetcher Contain all body parameters received
		 * @return JsonResponse Return 201 and empty array if announcement was created OR 400 and error message JSON if error
		 *
		 * @ApiDoc(
		 *  section="Announcement",
		 *  description="Create new announcement",
		 *  resource = true,
		 *  statusCodes = {
		 *     201 = "Returned when successful",
		 *     400 = "Returned when required param is empty"
		 *   }
		 * )
		 * @FOSRest\RequestParam(name="name", nullable=false, description="Announcement name")
		 * @FOSRest\RequestParam(name="description", nullable=false, description="Announcement description")
		 * @FOSRest\RequestParam(name="dateBegin", nullable=false, description="Announcement start date")
		 * @FOSRest\RequestParam(name="dateEnd", nullable=true, description="Announcement stop date")
		 * @FOSRest\RequestParam(name="city", nullable=false, description="Announcement city ")
		 * @FOSRest\RequestParam(name="address", nullable=false, description="Announcement address")
		 * @FOSRest\RequestParam(name="contactName", nullable=false, description="Announcement contact name")
		 * @FOSRest\RequestParam(name="contactEmail", nullable=true, description="Announcement contact email")
		 * @FOSRest\RequestParam(name="contactPhone", nullable=true, description="Announcement contact phone")
		 * @FOSRest\RequestParam(name="type", nullable=false, description="Announcement type : 'exchange', 'donate', 'collect'")
		 * @FOSRest\RequestParam(name="stock", nullable=true, description="Announcement quantity")
		 * @FOSRest\RequestParam(name="minCollect", nullable=true, description="Announcement minimum collect")
		 * @FOSRest\RequestParam(name="maxCollect", nullable=true, description="Announcement maximum collect")
		 * @FOSRest\RequestParam(name="shipping", nullable=false, description="Object can be shipped ?")
		 */
		public function postAction(ParamFetcherInterface $paramFetcher)
		{
			$announcement = new Announcement();
			$announcement->setName($paramFetcher->get("name"));
			$announcement->setDescription($paramFetcher->get("description"));
			$announcement->setDateBegin(new \DateTime()); // TODO : Get Date from param fetcher
			$announcement->setCity($paramFetcher->get("city"));
			$announcement->setAddress($paramFetcher->get("address"));
			$announcement->setContactName($paramFetcher->get("contactName"));
			$announcement->setType($paramFetcher->get("type"));
			$announcement->setShipping($paramFetcher->get("shipping"));

			if(!is_null($dateFinish = $paramFetcher->get("dateEnd"))){
				$announcement->setDateEnd($dateFinish);
			}

			if(!is_null($contactPhone = $paramFetcher->get("contactPhone"))){
				$announcement->setContactPhone($contactPhone);
			}

			if(!is_null($contactEmail = $paramFetcher->get("contactEmail"))){
				$announcement->setContactEmail($contactEmail);
			}

			if(!is_null($minCollect = $paramFetcher->get("minCollect"))){
				$announcement->setMinCollect($minCollect);
			}

			if(!is_null($maxCollect = $paramFetcher->get("maxCollect"))){
				$announcement->setMaxCollect($maxCollect);
			}

			if(!is_null($stock = $paramFetcher->get("stock"))){
				$announcement->setStock($stock);
			}

			$em = $this->getDoctrine()->getManager();
			$em->persist($announcement);
			$em->flush();

			return new JsonResponse(null, 201);
		}
	}
