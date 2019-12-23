<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog/{page<\d+>?1}", name="blog_index")
     */
    public function list(int $page = 1)
    {
        return $this->render("blog/index.html.twig",[
            "title" => "Titre 1",
            "body" => "Lorem Ipsum",
        ]);
    }
    /**
     * @Route("/blog/{slug}", name="blog_article")
     */
    public function show(string $slug)
    {
        return new Response(
            $slug
        );
    }
}