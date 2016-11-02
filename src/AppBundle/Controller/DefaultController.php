<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Task;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Client;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{

    public function indexAction()
    {	
    	//Mostrar los ultimo 5 pedidos.
    	$repository = $this->getDoctrine() // en repository guardamos la tabla task
    	->getRepository('AppBundle:Task'); 

		$query = $repository->createQueryBuilder('t') //configuramos la busqueda
		->setMaxResults(5)	//maximo 5 resultados
    	->orderBy('t.id', 'DESC')	// orden descendente de id
    	->getQuery();

		$tasks = $query->getResult();
		return $this->render('index/index.html.twig', array('tasks'=>$tasks));; //mediante un array lo mandamos al index
    }
	public function adminAction(){
		$em = $this->getDoctrine()->getRepository('AppBundle:Falla');
		$fallas = $em->findAll();
	
		return $this->render('Admin/ListFalla.html.twig', array('fallas'=>$fallas));;
	
	}
	public function adminListFallaAction(){
		$em = $this->getDoctrine()->getRepository('AppBundle:Falla');
		$fallas = $em->findAll();
	
		return $this->render('Admin/ListFalla.html.twig', array('fallas'=>$fallas));;
	
	}
	public function adminListProductAction(){
		$em = $this->getDoctrine()->getRepository('AppBundle:Product');
		$productos = $em->findAll();
	
		return $this->render('Admin/ListProducts.html.twig', array('productos'=>$productos));;
	
	}
	/*public function searchAction(Request $request){
	
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
					
			$nombre= $cliente->getName();
			//$phone = $cliente->getPhone();
			$repository = $this->getDoctrine()->getRepository('AppBundle:Task');

			$query = $repository->createQueryBuilder('t')
				->where('t. > :price')
    			->getQuery();

				$tasks = $query->getResult();
							
			if (!$client) {
									
				return new Response('El cliente con el '.$nombre. ' no encontrado');
			}
							
		return $this->render('Client/ShowClient.html.twig', array('cliente'=>$client));;
								
		}
	return $this->render('index/NewClient.html.twig', array('form'=>$form->createView()));;
	}*/
	
}
	

