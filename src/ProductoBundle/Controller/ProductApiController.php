<?php

namespace ProductoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class ProductApiController extends Controller
{
	/**
     * @Route("/product/api/product/list", name="Product_api_list")
     */
    public function indexAction()
    {
    	$productos=$this->getDoctrine()
    	->getRepository('ProductoBundle:Producto')->findAll();
    	//var_dump($productos);
    	$response=new Response();
    	 $response->headers->add([
        	'Content-Type'=>'application/json'
		]);
        $response->setContent(json_encode($productos));
        	
        	return $response;
    }

        /*return $this->render('ProductoBundle:ProductApi:index.html.twig',
				[
				'productos'=>$productos
				]
        	);*/
    

}
	

