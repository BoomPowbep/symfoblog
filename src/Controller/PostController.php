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
use Symfony\Component\HttpFoundation\Response;

class PostController extends AbstractController
{
    public function indexAction(){

        $posts = $this->getPostRepository()->findAll();

        return $this->render("post/index.html.twig", ['posts'=>$posts]);
    }

    public function addAction(){


        $post = new Post();
        $post->setTitle('La climatisation');
        $post->setContent("Faites comme si j'étais pas là");
        $post->setAuthor("Gwyddou");

        $em = $this->getDoctrine()->getManager();
        $em->persist($post);

        $em->flush();

        return new Response('nouveau post');
    }

    public function showAction($id){
        $post = $this->getPostRepository()->findOneBy(['id' => $id]);

        return $this->render("post/show.html.twig", ['post'=>$post]);
    }

    private function getPostRepository(){
        return $this->getDoctrine()->getRepository(Post::class);

    }
}