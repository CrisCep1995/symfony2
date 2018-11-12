<?php

namespace ProductoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/product/list")
     */
    public function indexAction()
    {

    	$productos = $this->getDoctrine()
    	->getRepository('ProductoBundle:Producto')
    	->findAll();
		//return var_dump($productos);
        return $this->render(
            /*'Producto:index.html.twig'*/
            'ProductoBundle:Default:index.html.twig',

            [
                'productos' => $productos
            ]
            //return var_dump($productos);
        );
            
    }
}
