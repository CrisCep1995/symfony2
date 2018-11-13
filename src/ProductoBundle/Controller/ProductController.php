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
        new \ecommarg\cart\Cart();
        /*var_dump($this->get('app.session'));
        die();*/
    	$producto = $this->getDoctrine()
    	->getRepository('ProductoBundle:Producto')
    	->find($id);
        //echo json_encode($producto);
        //die();
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
