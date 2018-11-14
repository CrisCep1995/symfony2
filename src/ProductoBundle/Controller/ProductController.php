<?php

namespace ProductoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ProductController extends Controller
{

	/**
     * @Route("/product/view/{id}", name="product_view")
     */

	public function productViewAction($id)
	{
		$this->get('app.cart');
			$producto= $this->getDoctrine()
    	->getRepository('ProductoBundle:Producto')
    	->find($id);
    	//echo json_encode($productos);
        return $this->render('ProductoBundle:Default:view.html.twig',['producto'=>$producto]);
	}

	/**
     * @Route("/product/cart/add/{id}/quantity/{quantity}", name="product_add_cart")
     */

	public function addToCartAction($id,$quantity){
		$producto= $this->getDoctrine()
    	->getRepository('ProductoBundle:Producto')
    	->find($id);

    	if(null===$producto){
    		throw new \Exception("Product not found");
    	}

    	$this->get('app.cart')->add($producto);
    	die();
	}

	/**
     * @Route("/product/cart/view", name="product_view_cart")
     */

	public function viewCartAction(){
		//var_dump($this->get('app.cart')->getAll());
		$cartService = $this->get('app.cart');
		$Products = $cartService->getAll();
		return $this->render(

				'ProductoBundle:Product:cart.html.twig',
				[
					'Products'=>$Products
				]

			);
	}

}
