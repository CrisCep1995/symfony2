<?php

namespace ProductoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/products/list", name="productlist")
     */
    public function indexAction()
    {
    	$Productos = $this->getDoctrine()-> getRepository('ProductoBundle:Producto')->findAll();
        return $this->render('producto/index.html.twig',
        						['productos'=> $Productos]);
    }
}
