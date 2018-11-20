<?php

namespace ProductoBundle\Controller;

use ProductoBundle\Entity\Producto;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
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

        


    /**
     * Creates a new producto entity.
     *
     * @Route("/product/api/product/new", name="product_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $r)
    {
       /* $producto = new Producto();
        $form = $this->createForm('ProductoBundle\Form\ProductoApiType', $producto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($producto);
            $em->flush();

            //return $this->redirectToRoute('producto_show', array('id' => $producto->getId()));
            $response=new Response();
            $response->headers->add([
                'Content-Type'=>'application/json'
            ]);
            $response->setContent(json_encode($producto));
            
            return $response;
        }

        $response=new Response();
        $response->headers->add([
            'Content-Type'=>'application/json'
        ]);
        $response->setContent(json_encode($producto));
            
        return $response;*/
        $product = new Producto();
        $form = $this->createForm(
            'ProductoBundle\Form\ProductoApiType',
            $product,
            [
                'csrf_protection' => false
            ]
        );
        $form->bind($r);
        $valid = $form->isValid();
        $response = new Response();
        if(false === $valid){
            $response->setStatusCode(400);
            $response->setContent(json_encode($this->getFormErrors($form)));
            return $response;
        }
        if (true === $valid) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();
            $response->setContent(json_encode($product));
        }
        return $response;

    }
    public function getFormErrors($form){
        $errors = [];
        if (0 === $form->count()){
            return $errors;
        }
        foreach ($form->all() as $child) {
            if (!$child->isValid()) {
                $errors[$child->getName()] = (string) $form[$child->getName()]->getErrors();
            }
        }
        return $errors;
    }

    /**
     * Finds and displays a producto entity.
     *
     * @Route("/product/api/product/show/{id}", name="product_show")
     * @Method("GET")
     */
    public function showAction(Producto $producto)
    {
        $deleteForm = $this->createDeleteForm($producto);

        /*$product = $this->render('producto/show.html.twig', array(
            'producto' => $producto,
            'delete_form' => $deleteForm->createView(),
        ));*/

        $response=new Response();
        $response->headers->add([
            'Content-Type'=>'application/json'
        ]);
        $response->setContent(json_encode($producto));
            
        return $response;

        /*return $this->render('producto/show.html.twig', array(
            'producto' => $producto,
            'delete_form' => $deleteForm->createView(),
        ));*/
    }
    

    /**
     * Creates a form to delete a producto entity.
     *
     * @param Producto $producto The producto entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Producto $producto)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('producto_delete', array('id' => $producto->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
   
}
	

