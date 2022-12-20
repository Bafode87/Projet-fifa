<?php

namespace App\Controller;

use App\Entity\BKEquipe;
use App\Entity\Tag;
use App\Entity\User;
use App\Entity\Video;
use App\Repository\BKEquipeRepository;
use App\Repository\TagRepository;
use App\Repository\TypeRepository;
use App\Repository\VideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class FifaFrontController extends AbstractController
{
    #[Route('/fifa/front', name: 'fifa_front')]
    public function index(): Response
    {
        return $this->render('fifa_front/index.html.twig', [
            'controller_name' => 'FifaFrontController',
        ]);
    }

    #[Route('/', name: 'accueil')]
    public function accueil(): Response
    {
        return $this->render('fifa_front/index.html.twig');
    }

    #[Route('/autres', name: 'autres')]
    public function autres(): Response
    {
        $repo=$this->getDoctrine()->getManager()->getRepository(BKEquipe::class);
        $equipe=$repo->findBy([], ['dateEquipe' => 'ASC']);
        return $this->render('fifa_front/equipe.html.twig',[
            'equipes' => $equipe,

        ]);
    }





    #[Route('/video', name: 'video')]
    public function video(): Response
    {
        $repo=$this->getDoctrine()->getManager()->getRepository(Video::class);
        $video=$repo->findBy([],['postedat' => 'DESC']);
        return $this->render('fifa_front/video.html.twig',[
            'videos' => $video,

        ]);
    }


    #[Route('/video/{id}', name: 'visualiserVideo')]
    public function visualiserVideo(Video $vid): Response
    {
        return $this->render('fifa_front/visualiserVideo.html.twig',[
            'video' => $vid,
        ]);
    }

    #[Route('/equipe/{id}', name: 'visualiserEquipe')]
    public function visualiserEquipe(BKEquipe $equ): Response
    {
        return $this->render('fifa_front/visualiserEquipe.html.twig',[
            'equipe' => $equ,
        ]);
    }

    #[Route('/club', name: 'club')]
    public function club(BKEquipeRepository $repo,TypeRepository $repoType): Response
    {

        $type = $repoType->findBy(
            ['nom' => 'Club']
        );

        $equipe = $repo->findBy(
            ['type' => $type], ['dateEquipe' => 'ASC']
        );

        return $this->render('fifa_front/equipe.html.twig',[
            'equipes' => $equipe
        ]);
    }

    #[Route('/equipe', name: 'equipe')]
    public function equipe(BKEquipeRepository $repo,TypeRepository $repoType): Response
    {

        $type = $repoType->findBy(
            ['nom' => 'Equipe']
        );

        $equipe = $repo->findBy(
            ['type' => $type], ['dateEquipe' => 'ASC']
        );

        return $this->render('fifa_front/equipe.html.twig',[
            'equipes' => $equipe
        ]);
    }







}

