<?php

namespace App\Controller;

use App\Repository\PostsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/post')]
class PostController extends AbstractController
{
    // Ici on instancie le repository de post dans ce constructeur, l'instance sera donc disponnible sur toutes les méthodes de la classe.
    private $postRepo;
    public function __construct(PostsRepository $postRepo){
        $this->postRepo = $postRepo;
    }

    #[Route('/', name: 'app_posts')]
    public function index(): Response
    {
        $posts = $this->postRepo->findAll();

        return $this->render('post/index.html.twig', [
            'allMyPosts' => $posts,
        ]);
    }


    #[Route('/details', name: 'app_details')]
    public function show(): Response
    {
        $posts = $this->postRepo->findAll();
        dd('page détails');

        return $this->render('post/details.html.twig', [
            'allMyPosts' => $posts,
        ]);
    }
}
