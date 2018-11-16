<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class TestController extends Controller
{
	/**
	* @Route("/test",name="AppBundle:TestController:indexAction")
	*/

	public function indexAction()
	{
		return $this->render(
			'test/index.html.twig',
			[
				'nombre'=>'Juan',
				'apellido'=>'Fernandez',
				'productos'=>[
								[
								 'nombre'=> 'televisor',
								 'precio'=>'19000'
								],
								[
								 'nombre'=>'cafetera',
								 'precio'=>'4500'
								]
							 ]
			]
		);
	}
}
