<?php

namespace AppBundle\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Task;
use AppBundle\Entity\Client;
use AppBundle\Entity\Product;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;




class TaskController extends Controller
{

	public function newAction($id,Request $request){
		$task = new Task();
		
		if($id != -1){
			$em = $this->getDoctrine()->getManager();
			$client = $em->getRepository('AppBundle:Client')->find($id);
			$task ->setClient($client);
		}

	$task->setStartDate(date("d-m-Y"));

		$form = $this->createFormBuilder($task, ['translation_domain' => 'AppBundle'])
			->add('Client', 'genemu_jqueryselect2_entity', array(
				'class' => 'AppBundle\Entity\Client',
				'placeholder' => 'Choose an option',
				'choice_label' => 'longname',
				'label' => 'task.client'
			))
			->add('taskType', 'choice', array(
					'choices' => array('bordado' => 'bordado'),
					'placeholder' => '',
					'label' => 'task.taskType'
					
			))
			->add('startDate', 'text', array(
					'label' => 'task.startDate',
					'read_only'=> 'true'
					
					
			))
			->add('endDate', 'date', array(
					'widget' => 'single_text',
					'format' => 'dd-MM-yyyy',
					'label' => 'task.endDate',
					'invalid_message'=>'dateinvalid',
					'required' => true,
				
			))
			->add('taskStatus', 'choice', array(
					'choices' => array('Sin iniciar' => 'Sin iniciar','En curso' => 'En curso',
					'Completado' => 'Completado'),
					'label' => 'task.taskStatus'	
				))
			->add('priceFull', 'money', array('label' => 'task.priceFull',
						//'invalid_message'=>'Formato de moneda incorrecto'
				'invalid_message'=>'priceinvalid'
					
			))
			->add('quantity', 'integer', array(
						'label' => 'task.qty'
				))
			->add('statusPay', 'choice', array(
					'choices' => array('Pagado' => 'pagado','A cuenta' => 'a cuenta',
					'Pendiente' => 'pendiente'),
					'label' => 'task.statusPay',
					'placeholder' => 'Elige una opcion'
				))
			->add('accountPrice', 'money', array(
					'label' => 'task.accountPrice',
					'required' => false,
					'invalid_message'=>'priceinvalid'
				))
			->add('comment', 'textarea', array(
					'label' => 'task.comment',
					'required' => false,
				))
			->add('name', 'text', array(
					'label' => 'task.name',
					'required' => false
				))
			->add('sizeName', 'choice', array(
						'choices'   => array(
						'G'	=> 'Grande',
						'P' => 'Pequeño'),
						'expanded' =>true,
						'multiple'  => false,
						'required'  => false,
						'label' => 'task.sizeName',
					'required' => false
				))
			->add('Product', 'entity', array(
						'class' => 'AppBundle:Product',
						'group_by' => 'wearType',
						'placeholder' => 'Elige una opcion',
						'label' => 'task.product'))
			->add('Falla', 'entity', array(
						'class' => 'AppBundle:Falla',
						'choice_label' => 'name',
						'label' => 'task.falla',
						'placeholder' => 'Elige una opcion'
				))
			/*->add('Client', 'entity', array(
						'class' => 'AppBundle:Client',
						
						'label' => 'client'))*/
			->add('save', 'submit', array('label'=>'task.form.save'))
							
			->add('saveAndAdd', 'submit', array('label'=>'task.form.saveAndAdd'))
			
							
		->getForm();
		$form->handleRequest($request);
		
		if($form->isValid()){
								
			$em = $this->getDoctrine()->getManager();

			$em->persist($task);
								
			$em->flush();

			if($form->get('saveAndAdd')->isClicked()){

				return $this->redirectToRoute('new_task');

			}
		return $this->redirectToRoute('list_task');
								
		}
		return $this->render('Task/NewTask.html.twig', array('form'=>$form->createView()));;
	}
	
	public function listAction(){
		$em = $this->getDoctrine()->getRepository('AppBundle:Task');
		$task = $em->findAll();
	
		return $this->render('Task/ListTask.html.twig', array('task'=>$task));;
	
	}
	
	public function showAction($id){
			
		$task = $this->getDoctrine()
		->getRepository('AppBundle:Task')
		->find($id);
	
		if (!$task) {
				
			return new Response('Tarea id: '.$id. ' no encontrada');
		}
	
		return $this->render('Task/ShowTask.html.twig', array('task'=>$task));;
	}
	
	public function deleteAction($id){
	
		$em = $this->getDoctrine()->getManager();
		$task = $em->getRepository('AppBundle:Task')->find($id);
		$em->remove($task);
		$em->flush();
	
		return $this->render('Task/DeleteTask.html.twig', array('task'=>$task));
	}
	
	public function editAction($id, Request $request){
	
		$em = $this->getDoctrine()->getManager();
		$task = $em->getRepository('AppBundle:Task')->find($id);
		
		$form = $this->createFormBuilder($task, ['translation_domain' => 'AppBundle'])
		->add('Client', 'genemu_jqueryselect2_entity', array(
				'class' => 'AppBundle\Entity\Client',
				'placeholder' => 'Choose an option',
				'choice_label' => 'longname',
				'label' => 'task.client'
			))
			->add('taskType', 'choice', array(
					'choices' => array('bordado' => 'bordado'),
					'placeholder' => '',
					'label' => 'task.taskType'
					
			))
			->add('startDate', 'text', array(
					'label' => 'task.startDate',
					'read_only'=> 'true'
					
			))
			->add('endDate', DateType::class, array(
					'widget' => 'single_text',
					'format' => 'dd-MM-yyyy',
					'label' => 'task.endDate',
					'invalid_message'=>'dateinvalid',
					'required' => true
			))
			->add('taskStatus', 'choice', array(
					'choices' => array('Sin iniciar' => 'Sin iniciar','En curso' => 'En curso',
					'Completado' => 'Completado'),
					'label' => 'task.taskStatus'	
				))
			->add('priceFull', 'money', array('label' => 'task.priceFull',
						//'invalid_message'=>'Formato de moneda incorrecto'
				'invalid_message'=>'priceinvalid'
					
			))
			->add('quantity', 'integer', array(
						'label' => 'task.qty'
				))
			->add('statusPay', 'choice', array(
					'choices' => array('Pagado' => 'pagado','A cuenta' => 'a cuenta',
					'Pendiente' => 'pendiente'),
					'label' => 'task.statusPay',
					'placeholder' => 'Elige una opcion'
				))
			->add('accountPrice', 'money', array(
					'label' => 'task.accountPrice',
					'required' => false,
					'invalid_message'=>'priceinvalid'
				))
			->add('comment', 'textarea', array(
					'label' => 'task.comment',
					'required' => false,
				))
			->add('name', 'text', array(
					'label' => 'task.name',
					'required' => false
				))
			->add('sizeName', 'choice', array(
						'choices'   => array(
						'G'	=> 'Grande',
						'P' => 'Pequeño'),
						'expanded' =>true,
						'multiple'  => false,
						'required'  => false,
						'label' => 'task.sizeName',
					'required' => false
				))
			->add('Product', 'entity', array(
						'class' => 'AppBundle:Product',
						'group_by' => 'wearType',
						'placeholder' => 'Elige una opcion',
						'label' => 'task.product'))
			->add('Falla', 'entity', array(
						'class' => 'AppBundle:Falla',
						'choice_label' => 'name',
						'label' => 'task.falla',
						'placeholder' => 'Elige una opcion'
				))
												
		->add('save', 'submit', array('label'=>'save'))
			
		->add('saveAndAdd', 'submit', array('label'=>'saveAndAdd'))
			
		->getForm();
		$form->handleRequest($request);
		
		if($form->isValid()){
			$em = $this->getDoctrine()->getManager();
			$em->persist($task);
			$em->flush();
		
			return $this->redirectToRoute('list_task');
		}
		return $this->render('Task/NewTask.html.twig', array('form'=>$form->createView()));;
		}
		
		public function searchTaskAction(Request $request){
			$task = new Task();
		
			$data = array();
		
			$form = $this->createFormBuilder($data, ['translation_domain' => 'AppBundle'])
				->add('id', 'text', array(
							'label' => 'task.id',
							'required'=> false
					))
				/*->add('falla', 'text', array(
							'label' => 'falla',
							'required'=> false
					))
				->add('cliente', 'text', array(
							'label' => 'cliente',
							'required'=> false
					))*/
				->add('send', SubmitType::class, array('label'=>'task.search.searchTask'))
					
				->getForm();
						
			$form->handleRequest($request);
					
			if ($form->isValid()) {	
				$data = $form->getData();
				$id = $data['id'];
				//$falla =$data['falla'];
				//$cliente = $data['cliente];
				//var_dump($data);
				//var_dump($id);
				$repository = $this->getDoctrine()
				->getRepository('AppBundle:Task');
				$query = $repository->createQueryBuilder('t')
				->where('t.id = :task')
				->setParameter('task', $id)
				
				->getQuery();
				//$task = $query->getResult();
				$task = $query->setMaxResults(1)->getOneOrNullResult();
				
				
				if(!$task){
					return new Response('La tarea no encontrada');
				}
				return $this->redirectToRoute('show_task', array('id' => $task->getId()), 301);
				//return $this->render('Task/ListSearchTask.html.twig', array('task'=>$task));;
			}
		return $this->render('Task/SearchTask.html.twig', array('form'=>$form->createView()));;
		}
}
