<?php

namespace App\Controller;
use App\Entity\Name;
use App\Form\MovieType;
// package to work with queries
use Doctrine\Persistence\ManagerRegistry;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MoviesController extends AbstractController
{
    #[Route('/index', name: 'movies')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $movies=$doctrine->getRepository(Name:: class)->findAll();
        // dd($movies);
        return $this->render('movies/index.html.twig', [
           "movies"=>$movies
        ]);
    }

// create routes for all CRUD elements
    #[Route('/create', name: 'create-movie')]
    public function createAction(Request $request, ManagerRegistry $doctrine): Response
    {
        
        $movie=new Name();
        $form = $this->createForm(MovieType::class, $movie);

        // from documentation - 'Processing Forms'
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $movie = $form->getData();

            $em = $doctrine->getManager();

            $em->persist($movie);
            $em->flush();

            return $this->redirectToRoute('movies');
        }

        return $this->render('movies/create.html.twig', [
            'form' => $form->createView()
        ]);
    }


// to edit the record
    #[Route('/edit/{id}', name: 'edit-movie')]
    public function editAction(Request $request, ManagerRegistry $doctrine, $id): Response
    {
        $movie = $doctrine->getRepository(Name::class)->find($id);
      $form = $this->createForm(MovieType::class, $movie);
      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
        
          $movie = $form->getData();
          
          $em = $doctrine->getManager();
          $em->persist($movie);
          
            return $this->redirectToRoute('movies');
            }
        return $this->render('movies/edit.html.twig',[
            "form"=>$form->createView()
        ]);
    }

// query for details for every record from the database
    #[Route('/details/{id}', name: 'details-movie')]
    public function detailsAction(ManagerRegistry $doctrine, $id): Response
    {
        $movie=$doctrine->getRepository(Name::class)->find($id);
   
        return $this->render('movies/details.html.twig', [
            "movie"=>$movie
        ]);
    }


// to delete a record from the database
    #[Route('/delete/{id}', name: 'delete-movie')]
    public function deleteAction(ManagerRegistry $doctrine, $id): Response
    {
        $em=$doctrine->getManager();
        $movie=$doctrine->getRepository(Name:: class)->find($id);
        $em->remove($movie);
        $em->flush();

        return $this->redirectToRoute('movies');
    }

}
