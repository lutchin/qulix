<?php


namespace Qulix\RecyclingBundle\Controller;

use Qulix\RecyclingBundle\Entity\Crude;
use Qulix\RecyclingBundle\Entity\Worker;
use Qulix\RecyclingBundle\Entity\Population;
use Qulix\RecyclingBundle\Form\CrudeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class PageController extends Controller
{
	public function indexAction(Request $request)
	{
		$crude = new Crude();
		$form = $this->createForm( CrudeType::class, $crude );

		return $this->render('@QulixRecycling/Page/index.html.twig',
			[
				'form' => $form->createView()
			]
			);
	}

	public function crudeAction($type)
	{

		$em = $this->getDoctrine()->getManager();
		$repository = $em->getRepository('QulixRecyclingBundle:Crude');

		$query = $repository->createQueryBuilder('c')
			->Join('c.population','p')
			->where('p.sort= :type')
			->setParameter('type', $type)
			->getQuery();

		$results = $query->getResult();

		$arrayCollection = array();

		foreach ($results as $result){
			$arrayCollection[] = array(
				'crude' => $result->getName()
			);

		}
		return new JsonResponse($arrayCollection);
	}

	public function populationAction()
	{
		$results  = $this->getDoctrine()
			->getRepository(Population::class, 'default')
			->findAll();


		$arrayCollection = array();

		foreach ($results as $result){

			$arrayCollection[] = array(
				'population' => $result->getSort());

		}
		return new JsonResponse($arrayCollection);

	}

	public function showAction()
	{
		$results  = $this->getDoctrine()
		    ->getRepository(Worker::class, 'default')
			->findAll();

		$arrayCollection = array();

		foreach ($results as $result){

			$arrayCollection = array(
				'status' => $result->getStatus());

		}
		return new JsonResponse($arrayCollection);

	}

	public function clearAction($name = "Работник Вася")
	{
		$em = $this->getDoctrine()->getManager();
		$status = $this
			->getDoctrine()
			->getManager()
			->getRepository('QulixRecyclingBundle:Worker')
			->findOneBy(['name' => $name]);

		$status->setStatus(0);

		$em->flush();

			return new JsonResponse(['status' => $status->getStatus()]);
	}

	public function addAction($population, $crude, $name = "Работник Вася")
	{
		if($population&&$crude)
		{
            $em = $this->getDoctrine()->getManager();
			$results =	$this->getDoctrine()->getRepository(Worker::class, 'default')
			 ->findOneBy(['name' => $name]);


			$old_status = $results->getStatus();

			if($population == "Инопланетянин"&&$crude == "Инопланетянина сырье"){
                $status = $old_status;
				$message = "Отказано";
				return new JsonResponse([
					'status' => $status,
					'msg' => $message
				]);
			}elseif($population == "Асоциальная личность"&&$crude == "Хорошее сырье")
			{
			    $status = $old_status+1;
                $results->setStatus($status);
                $em->flush();
				$message = 'Принято';
				return new JsonResponse([
					'status' => $status,
					'msg' => $message
				]);
			}elseif ($population == "Асоциальная личность"&&$crude == "Инопланетянина сырье")
			{
                $status = $old_status-1;
                $results->setStatus($status);
                $em->flush();
                $message = "Принято";
                return new JsonResponse([
                    'status' => $status,
                    'msg' => $message
                ]);
			}elseif($population == "Обычный человек"&&$crude == "Хорошее сырье"){
                $status = $old_status+1;
                $results->setStatus($status);
                $em->flush();
                $message = "Принято";
                return new JsonResponse([
                    'status' => $status,
                    'msg' => $message
                ]);
			}elseif($population == "Обычный человек"&&$crude == "Выброшенное радиоактивное сырье"){
                $status = $old_status-1;
                $results->setStatus($status);
                $em->flush();
                $message = "Принято";
                return new JsonResponse([
                    'status' => $status,
                    'msg' => $message
                ]);
			}
		}

		return $this->redirectToRoute('QulixRecycling_homepage');
	}
}

