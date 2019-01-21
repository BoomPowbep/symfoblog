<?php
/**
 * Created by PhpStorm.
 * User: robinsimonklein
 * Date: 21/01/2019
 * Time: 09:59
 */

namespace App\Controller;


use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PostController extends AbstractController
{
    public function indexAction(){

        $posts = $this->getPostRepository()->findAll();

        return $this->render("post/index.html.twig", ['posts'=>$posts]);
    }

    public function addAction(Request $request){


        $post = new Post();

        $form = $this->createFormBuilder($post)
                ->add("title", TextType::class)
                ->add("content", TextareaType::class)
                ->add("author", TextType::class)
                ->add("submit", SubmitType::class)
                ->getForm();

        //$em = $this->getDoctrine()->getManager();

        //$em->flush();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $post = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute("index");
        }

        return $this->render("post/add.html.twig", ['form'=>$form->createView()]);
    }

    public function showAction(Post $post){
        return $this->render("post/show.html.twig", ['post'=>$post]);
    }

    private function getPostRepository(){
        return $this->getDoctrine()->getRepository(Post::class);

    }
}