<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Peliculas;
use App\Form\CrearPelicula;

class PeliculasController extends AbstractController
{
    /**
     * @Route("/peliculas", name="app_peliculas")
     */
    public function crear(Request $request): Response
    {

        $pelicula = new Peliculas();
        $form = $this->createForm(CrearPelicula::class, $pelicula);
        $form->handleRequest($request);
        if($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pelicula);
            $em->flush();

            return $this->redirectToRoute('crearPeli');

        }

        $peliRepo = $this->getDoctrine()->getRepository(Peliculas::class);
        $peliculas = $peliRepo->findAll();


        return $this->render('peliculas/crear.html.twig', [
            'form' => $form->createView(),
            'peliculas' => $peliculas
        ]);
    }

    public function editar(Request $request, Peliculas $peliculas)
    {
       
        $form = $this->createForm(CrearPelicula::class, $peliculas);
        $form->handleRequest($request);
        if($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($peliculas);
            $em->flush();

            return $this->redirectToRoute('crearPeli');

        }

        return $this->render('peliculas/crear.html.twig',[
            'edit' => true,
            'form' => $form->createView(),
            'peliculas' => $peliculas
        ]);
    }

    public function borrar(Peliculas $peliculas){
        $em = $this->getDoctrine()->getManager();
        $em->remove($peliculas);
        $em-> flush();

        return $this->redirectToRoute('crearPeli');
    }
}
