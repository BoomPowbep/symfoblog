<?php
/**
 * Created by PhpStorm.
 * User: robinsimonklein
 * Date: 21/01/2019
 * Time: 09:59
 */

namespace App\Controller;


use App\Entity\Post;
use App\Form\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class PostController extends AbstractController
{
    public function indexAction(){

        $posts = $this->getPostRepository()->findAll();

        return $this->render("post/index.html.twig", ['posts'=>$posts]);
    }

    public function addAction(Request $request){


        $post = new Post();
        $form = $this->createForm(PostType::class, $post);

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

    public function editAction(Request $request, Post $post){
        $form = $this->createForm(PostType::class, $post);

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

    public function deleteAction(Request $request, Post $post){
        $form = $this->createFormBuilder()
        ->add("submit", SubmitType::class)
        ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($post);
            $em->flush();

            return $this->redirectToRoute("index");
        }

        return $this->render("post/delete.html.twig", ['form'=>$form->createView()]);
    }

    private function getPostRepository(){
        return $this->getDoctrine()->getRepository(Post::class);
    }

    private function likeAction(){

    }
    private function unlikeAction(){

    }
}