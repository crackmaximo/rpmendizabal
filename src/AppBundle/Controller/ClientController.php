<?php

namespace AppBundle\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Client;
use AppBundle\Entity\Task;


class ClientController extends Controller
{
	
	public function newAction(Request $request){
		
		$cliente = new  Client();
		
	
		$form = $this->createFormBuilder($cliente, ['translation_domain' => 'AppBundle'])
			->add('name', 'text', array(
				'label' => 'client.name'))
			->add('phone', 'text',array(
				'label' => 'client.phone'))
			
			->add('save', 'submit', array('label'=>'client.form.save'))
			
			->add('saveAndAdd', 'submit', array('label'=>'client.form.saveAndAdd'))
			
			->getForm();
			
		$form->handleRequest($request);
	
				if($form->isValid()){
					
					$em = $this->getDoctrine()->getManager();
				
					$em->persist($cliente);
					
					$em->flush();
					$id= $cliente->getId();
					
					if($form->get('saveAndAdd')->isClicked()){
					
						return $this->redirectToRoute('new_task_client', array('id' => $id), 301);
			
					}
					return $this->redirectToRoute('list_client');
					
					
				}
		return $this->render('Client/NewClient.html.twig', array('form'=>$form->createView()));;
	}
	
	public function showAction($id){
		 
		$client = $this->getDoctrine()
		->getRepository('AppBundle:Client')
		->find($id);
		
		$repository = $this->getDoctrine()
		->getRepository('AppBundle:Task');
		$query = $repository->createQueryBuilder('p')
    		->where('p.client = :client')
    		->setParameter('client', $id)
    		->getQuery();
			$task = $query->getResult();
		
		if (!$client) {
			
			return new Response('El cliente id: '.$id. ' no encontrado');
		}
		
		return $this->render('Client/ShowClient.html.twig', array('task'=>$task, 'client'=>$client));;
	}
	
	public function listAction(){
		$em = $this->getDoctrine()->getRepository('AppBundle:Client');
		$clientes = $em->findAll();
	
		return $this->render('Client/ListClient.html.twig', array('clientes'=>$clientes));;
	
	}
	
	public function deleteAction($id){
	
		$em = $this->getDoctrine()->getManager();
		$cliente = $em->getRepository('AppBundle:Client')->find($id);
		$em->remove($cliente);
		$em->flush();
	
		return $this->render('Client/DeleteClient.html.twig', array('client'=>$cliente));
	}
	public function editAction($id, Request $request){
	
		$em = $this->getDoctrine()->getManager();
		$cliente = $em->getRepository('AppBundle:Client')->find($id);
		
		$form = $this->createFormBuilder($cliente, ['translation_domain' => 'AppBundle'])
				
				->add('name', 'text', array('label' => 'client.name'))
				->add('phone', 'text',array('label' => 'client.phone'))
				->add('save', 'submit', array('label'=>'client.save'))
							
				->add('saveAndAdd', 'submit', array('label'=>'client.saveAndAdd'))
							
		->getForm();
		$form->handleRequest($request);
				
		if($form->isValid()){
			$em = $this->getDoctrine()->getManager();
			$em->persist($cliente);
			$em->flush();
				
			return $this->redirectToRoute('list_client');
		}
		return $this->render('Client/NewClient.html.twig', array('form'=>$form->createView()));
	}
	public function searchAction(Request $request){
	
		$cliente = new  Client();
	
	
		$form = $this->createFormBuilder($cliente, ['translation_domain' => 'AppBundle'])
				->add('name', 'text', array(
						'label' => 'client.name',
						'required'=>false
				))
				->add('phone', 'text',array(
						'label' => 'client.phone',
						'required'=>false
				))
				->add('save', 'submit', array('label'=>'client.form.search'))
				
							
				->getForm();
							
				$form->handleRequest($request);
	
				if($form->isValid()){
					$name = $cliente->getName();
					$phone = $cliente->getPhone();
				/*	$repository = $this->getDoctrine()
					->getRepository('AppBundle:Client');
					$cliente = $repository->findOneByName($name);*/
					
					$repository = $this->getDoctrine()
					->getRepository('AppBundle:Client');
					$query = $repository->createQueryBuilder('c')
					->where('LOWER(c.name) LIKE :client OR c.phone = :cliphone')
					->setParameter('client',strtolower('%'.$name.'%'))
					->setParameter('cliphone', $phone)
					->getQuery();
					$cliente = $query->getResult();
					//$cliente = $query->setMaxResults(1)->getOneOrNullResult();
						
					
					if(!$cliente){
						return new Response('El cliente  no encontrado');
					}
					//return $this->redirectToRoute('show_client', array('id' => $cliente->getId()), 301);
					return $this->render('Client/ListSearchClient.html.twig', array('cliente'=>$cliente));;
				}
	return $this->render('Client/SearchClient.html.twig', array('form'=>$form->createView()));;
	}
	
}		
