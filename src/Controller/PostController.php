<?php
/**
 * Created by PhpStorm.
 * User: robinsimonklein
 * Date: 21/01/2019
 * Time: 09:59
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PostController extends AbstractController
{
    public function indexAction(){
        return $this->render("post/index.html.twig", ['title' => "Picon Bière 🍺"]);
    }
}