<?php

namespace AppBundle\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Falla;


class FallaController extends Controller
{
	
	public function newAction(Request $request){
		
		$falla = new  Falla();
		
		$form = $this->createFormBuilder($falla, ['translation_domain' => 'AppBundle'])
			->add('name', 'text', array(
				'label' => 'falla.name'))

			->add('save', 'submit', array('label'=>'falla.form.save'))
			
			->add('saveAndAdd', 'submit', array('label'=>'falla.form.saveAndAdd'))
			
			->getForm();
		
		$form->handleRequest($request);
	
		if($form->isValid()){
					
			$em = $this->getDoctrine()->getManager();
			$em->persist($falla);	
			$em->flush();
						
			if($form->get('saveAndAdd')->isClicked()){
				
				return $this->redirectToRoute('admin_new_falla');
						
			}
		return $this->redirectToRoute('admin_list_falla');
					
		}
	return $this->render('Admin/NewFalla.html.twig', array('form'=>$form->createView()));;
	}
	
	public function showAction($id){
		 
		$falla = $this->getDoctrine()
		->getRepository('AppBundle:Falla')
		->find($id);
		
		if (!$falla) {
			
			return new Response('El falla id: '.$id. ' no encontrado');
		}
	
		return $this->render('Falla/ShowFalla.html.twig', array('falla'=>$falla));;
	}
	
	public function listAction(){
		$em = $this->getDoctrine()->getRepository('AppBundle:Falla');
		$fallas = $em->findAll();
	
		return $this->render('Falla/ListFalla.html.twig', array('fallas'=>$fallas));;
	
	}
	public function deleteAction($id){
	
		$em = $this->getDoctrine()->getManager();
		$falla = $em->getRepository('AppBundle:Falla')->find($id);
		$em->remove($falla);
		$em->flush();
	
		return $this->render('Admin/DeleteFalla.html.twig', array('falla'=>$falla));
	}
	
	public function editAction($id, Request $request){
	
		$em = $this->getDoctrine()->getManager();
		$falla = $em->getRepository('AppBundle:Falla')->find($id);
		
		$form = $this->createFormBuilder($falla, ['translation_domain' => 'AppBundle'])
			
			->add('name', 'text', array('label' => 'falla.name'))
			->add('save', 'submit', array('label'=>'falla.form.save'))
			->add('saveAndAdd', 'submit', array('label'=>'falla.form.saveAndAdd'))
					
		->getForm();
		$form->handleRequest($request);
		
		if($form->isValid()){
			$em = $this->getDoctrine()->getManager();
			$em->persist($falla);
			$em->flush();
		
			return $this->redirectToRoute('admin_list_falla');
		}
	return $this->render('Admin/NewFalla.html.twig', array('form'=>$form->createView()));
	}
	
}		
