<?php

namespace ProductoBundle\Controller;

use ProductoBundle\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;



class CategoryApiController extends Controller
{
    /**
     * Lists all category entities.
     *
     * @Route("/category/api/list", name="category_api_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('ProductoBundle:Category')->findAll();

        $response=new Response();
         $response->headers->add([
            'Content-Type'=>'application/json'
        ]);
        $response->setContent(json_encode($categories));
            
            return $response;
    }

    /**
     * Creates a new category entity.
     *
     * @Route("/category/api/new", name="category_api_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $category = new Category();
        $form = $this->createForm('ProductoBundle\Form\CategoryApiType', $category);
        $form->handleRequest($request);



        if($form->gerErrors() != 200){
        $errors=[];
        foreach($form->getErrors() as $error){

            $error[]=$error->getMessage();

        }
        $response=new Response();
            $response->setStatus(405);
            $response->setContent(json_encode($$errors));
            
            return $response;

        }
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            $response=new Response();
            $response->headers->add([
                'Content-Type'=>'application/json'
            ]);
            $response->setContent(json_encode($category));
            
            return $response;

        }

        $response=new Response();
        $response->headers->add([
            'Content-Type'=>'application/json'
        ]);
        $response->setContent(json_encode($category));
            
        return $response;

    }
    
}