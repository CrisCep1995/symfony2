<?php

namespace ProductoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
class ProductController extends Controller
{
	/**
     * @Route("/product/view/{id}", name="Product_view")
     */
	public function viewAction($id)
	{
		
		
		$this->get('app.cart');
		$product=$this->getDoctrine()
		->getRepository('ProductoBundle:Producto')
		->find($id);
		
		//echo json_encode($product);
		//die();
		return $this->render(
			'ProductoBundle:Producto:view.html.twig',
			[
				'producto'    => $product,
				'cart_config' => $this->container->getParameter('cart_config')
			]
		);
	}
	/**
     * @Route("/add", name="Product_add_cart" )
     */
	public function addToCartAction(Request $r)
	{

		$id=$r->get('id');
        $quantity=$r->get('quantity');
        $requestType=strToLower($r->headers->get('X-Requested-With'));
		$isAjax='xmlhttprequest'===$requestType;

        $producto= $this->getDoctrine()
        ->getRepository('ProductoBundle:Producto')
        ->find($id);

        if(null===$producto){
            throw new \Exception("Product not found");
        }

        $cartService = $this->get('app.cart');
        $cartService->add($producto); 

        if (true===$isAjax) {
        	$response=new Response();
        	$response->headers->add([
        			'Content-Type'=>'application/json'
			]);
        	$response->setContent(json_encode($cartService->getAll()));
        	return $response;
        }

        return $this->redirect(
			$this->generateUrl('Product_view_cart')
		);


    }
	/**
     * @Route("/product/cart/view", name="Product_view_cart")
     */
	public function viewCartAction()
	{
		
		$cartService=$this->get('app.cart');
		$items=$cartService->getAll();

		return $this->render('ProductoBundle:Producto:cart.html.twig',
				[
				'cart'=>$items
				]
        	);	
		
	
		
	}

}
