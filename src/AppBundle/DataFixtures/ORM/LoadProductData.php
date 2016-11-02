<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Product;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;

class LoadProductData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface{
	
	/**
	 * {@inheritDoc}
	 * @see \Symfony\Component\DependencyInjection\ContainerAwareInterface::setContainer()
	 */
	private $container;
	public function setContainer(ContainerInterface $container = null) {
		$this->container = $container;
	
	}
	/**
	 * {@inheritDoc}
	 * @see \Doctrine\Common\DataFixtures\FixtureInterface::load()
	 */
	public function load(ObjectManager $manager) {
		
		$sym = $this->container->getParameter('kernel.root_dir') .'/Resources/data/products.csv';
		$manager;
		$row=0;
		$fd = fopen($sym, "r"); 
		if ($fd) { 
			while (($data = fgetcsv($fd)) !== false) { 
				if($row > 0){
					$product = new Product();
					$product->setWearType($data[0]);
					$product->setColour($data[1]);
					$product->setSize($data[2]);
					$product->setSex($data[3]);
					$product->setPrice($data[4]);
					$manager->persist($product);
					$nombrepro = implode($data);
					$this->addReference($nombrepro, $product);
				}
				$row++;
 			} 
 			fclose($fd);
 			$manager->flush();
 			
		}    
	}
	/**
	 * {@inheritDoc}
	 * @see \Doctrine\Common\DataFixtures\OrderedFixtureInterface::getOrder()
	 */
	public function getOrder() {
		return 3;

	}

}