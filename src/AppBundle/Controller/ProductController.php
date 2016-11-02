<?php

namespace AppBundle\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Product;
use Symfony\Component\HttpFoundation\Request;


class ProductController extends Controller
{
	
	public function newAction(Request $request){
		
		$producto = new  Product();
		
	
		$form = $this->createFormBuilder($producto, ['translation_domain' => 'AppBundle'])
			->add('wearType', 'choice', array(
					'choices'   => array(
							'Polar' => 'Polar',
							'Parka' => 'Parka',
							'SoftShell' => 'SoftShell',
					),
				'placeholder' => 'Elige una opcion',
				'label' => 'product.type'))
			->add('colour', 'choice',array(
					'choices'   => array(
							'Rojo' => 'Rojo',
							'Pistacho' => 'Pistacho',
							'Royal' => 'Royal',
							'Azul Marino' => 'Azul Marino',
							'Gris' => 'Gris',
							'Negro' => 'Negro',
					),
				'placeholder' => 'Elige una opcion',
				'label' => 'product.colour'))
			->add('size', 'choice',array(
					'choices'   => array(
							'S' => 'S',
							'M' => 'M',
							'L' => 'L',
							'XL' => 'XL',
							'XXL' => 'XXL',
							'XXXL' => 'XXXL',
					),
				'placeholder' => 'Elige una opcion',
				'label' => 'product.size'))
			->add('sex', 'choice', array(
						'choices'   => array(
								'Unisex' => 'Unisex',
								'Mujer' => 'product.form.woman',
					),
					'expanded' =>true,
					'multiple'  => false,
					'label' => 'product.sex',
					'attr' => array(
							'class' => 'u-full-width',)
				))
			->add('price', 'money', array(
				'label' => 'product.price',
				'invalid_message'=>'priceinvalid'
				))
			
			->add('save', 'submit', array('label'=>'product.form.save'))
			
			->add('saveAndAdd', 'submit', array('label'=>'product.form.saveAndAdd'))
			
			->getForm();
		
		$form->handleRequest($request);
	
				if($form->isValid()){
					
					$em = $this->getDoctrine()->getManager();
				
					$em->persist($producto);
					
					$em->flush();
						
					if($form->get('saveAndAdd')->isClicked()){
						
						return $this->redirectToRoute('admin_new_product');
						
					}
					return $this->redirectToRoute('admin_list_product');
					
				}
		return $this->render('Admin/NewProduct.html.twig', array('form'=>$form->createView()));;
	}
	
	public function showAction($id){
		 
		$product = $this->getDoctrine()
		->getRepository('AppBundle:Product')
		->find($id);
		
		if (!$product) {
			
			return new Response('El producto id: '.$id. ' no encontrado');
		}
	
		return $this->render('Product/ShowProduct.html.twig', array('producto'=>$product));;
	}
	
	public function listAction(){
		$em = $this->getDoctrine()->getRepository('AppBundle:Product');
		$productos = $em->findAll();
	
		return $this->render('Product/ListProducts.html.twig', array('productos'=>$productos));;
	
	}
	
	public function deleteAction($id){
	
		$em = $this->getDoctrine()->getManager();
		$producto = $em->getRepository('AppBundle:Product')->find($id);
		$em->remove($producto);
		$em->flush();
	
		return $this->render('Product/deleteProduct.html.twig', array('product'=>$producto));
	}
	public function editAction($id, Request $request){
	
		$em = $this->getDoctrine()->getManager();
		$producto = $em->getRepository('AppBundle:Product')->find($id);
	
		$form = $this->createFormBuilder($producto, ['translation_domain' => 'AppBundle'])
			->add('wearType', 'text', array(
				'label' => 'product.type'))
			->add('colour', 'text',array(
				'label' => 'product.colour'))
			->add('size', 'text',array(
				'label' => 'product.size'))
			->add('sex', 'choice', array(
				'choices'   => array(
				'Unisex' => 'Unisex',
				'Mujer' => 'Mujer',
				),
				'expanded' =>true,
				'multiple'  => false,
				'label' => 'product.sex',
				'attr' => array('class' => 'u-full-width',)
								))
			->add('price', 'money', array('label' => 'product.price',
				'invalid_message'=>'Formato de moneda incorrecto'))
											
			->add('save', 'submit', array('label'=>'product.form.save'))
											
			->add('saveAndAdd', 'submit', array('label'=>'product.form.saveAndAdd'))
											
		->getForm();
		$form->handleRequest($request);
	
		if($form->isValid()){
		$em = $this->getDoctrine()->getManager();
		$em->persist($producto);
		$em->flush();
		
		return $this->redirectToRoute('admin_list_product');
		}
	return $this->render('Admin/NewProduct.html.twig', array('form'=>$form->createView()));;
	}
}		
