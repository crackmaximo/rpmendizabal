<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Falla;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;

class LoadFallaData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface{
	
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
		
		$sym = $this->container->getParameter('kernel.root_dir') .'/Resources/data/fallas.csv';
		$manager;
		$fd = fopen($sym, "r"); 
		if ($fd) { 
			while (($data = fgetcsv($fd)) !== false) { 
				
					$falla = new Falla();
					$falla->setName($data[0]);
					$manager->persist($falla);
					$this->addReference($data[0], $falla);
					
 			} 
 			fclose($fd);
		}
		$manager->flush();    
	}
	/**
	 * {@inheritDoc}
	 * @see \Doctrine\Common\DataFixtures\OrderedFixtureInterface::getOrder()
	 */
	public function getOrder() {
		return 2;

	}

}