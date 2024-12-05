<?php

namespace App\Controller;

use App\Entity\Posts;
use App\Repository\PostsRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
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
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        // requête pour récupérer tous les posts publiés en utilisant la méthode findBy fournie par le repository
        // $posts = $this->postRepo->findBy(['state'=>'STATE_PUBLISHED'], ['createdAt'=>'DESC']);

        // requête pour récupérer tous les posts publiés en utilisant une méthode perso définie dans le repository
        $page = $request->query->getInt('page', 1);
        $posts = $this->postRepo->findPublished($page, $paginator);

        return $this->render('post/index.html.twig', [
            'allMyPosts' => $posts,
        ]);
    }


    #[Route('/details/{slug}', name: 'app_details')]
    // Ici on récupère un post particulier en passant associant l'id passé en param à une instance de posts ( entity) grace au parameter converter de symfony dans les param de la méthode show
    public function show(Posts $post): Response
    {
        return $this->render('post/details.html.twig', [
            'onePost' => $post,
        ]);
    }
}
