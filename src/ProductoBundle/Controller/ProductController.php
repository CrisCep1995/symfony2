<?php

namespace ProductoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ProductController extends Controller
{
	/**
     * @Route("/product/view/{id}", name="product_view")
     */
    public function verProducto($id)
    {

    	$producto = $this->getDoctrine()
    	->getRepository('ProductoBundle:Producto')
    	->find($id);
		//return var_dump($productos);
        return $this->render(
            
            'ProductoBundle:Default:view.html.twig',

            [
                'producto' => $producto
            ]
            //return var_dump($productos);
        );
        //return var_dump($producto);
            
    }
    
}
