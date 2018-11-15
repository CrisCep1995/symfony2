<?php

namespace ProductoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
	/**
     * @Route("/products/view/{id}", name="Product_view")
     */
    public function viewAction($id)
    {

    	$producto = $this->getDoctrine()-> getRepository('ProductoBundle:Producto')->find($id);
    	// echo json_encode($producto);
   		$this->get('app.cart');
        return $this->render('ProductoBundle:Default:view.html.twig',
        						[
                                    'producto'=> $producto,
                                    'cart_config' => $this->container->getParameter('cart_config')
                                ]);  
    }

    /**
     * @Route("/products/cart/add/", name="Product_add_cart")
     */
    //$id, $quantity
    public function addToCartAction(Request $r)
    {

        $requestType = strtolower($r->headers->get('X-Requested-With'));
        $isAjax = 'xmlhttprequest' === $requestType;

        $id = $r->get('id');
        $quantity = $r->get('quantity');

    	$producto = $this->getDoctrine()-> getRepository('ProductoBundle:Producto')->find($id);
    	if(null === $producto)
    	{
    		throw new \Exception("Producto not found");
    	}
    
        $cartService = $this->get('app.cart');

        $cartService->add($producto);

        if(true === $isAjax){
            $response = new Response();
            $response->headers->add([
                    'Content-Type'=>'application/json'
                ]);
            $response->setContent(json_encode($cartService->getAll()));
            return $response;
        }
        $this->redirect(
            $this->generateUrl('Product_view_cart')
        );
        //die();
    }

   /**
     * @Route("/products/cart/view", name="Product_view_cart")
     */
    public function viewCartAction()
    {
        $cartService = $this->get('app.cart');
        $productos =  $cartService->getAll();

        return $this->render('ProductoBundle:Product:cart.html.twig',
                                ['productos'=> $productos]);  

    }
}

