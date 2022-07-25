<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Clientes;
use App\Entity\Alquiler;
use App\Entity\Peliculas;
use App\Form\CrearAlquiler;

class AlquilerController extends AbstractController
{
    /**
     * @Route("/alquiler", name="app_alquiler")
     */
    public function crear(Request $request): Response
    {
        $alquiler = new Alquiler();
        $form = $this->createForm(CrearAlquiler::class, $alquiler);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            $em = $this->getDoctrine()->getManager();
            $idPeli = $alquiler->getIdPeliculas();
            $dias = $this->dias($alquiler);
            $precioTotal = $this->calcular($idPeli, $dias);
            $alquiler->setValorTotal($precioTotal);
            $em->persist($alquiler);
            $em->flush();

            return $this->redirectToRoute('alquilarPeli');

        }
        $alquilerRepo = $this->getDoctrine()->getRepository(Alquiler::class);
        $alquilerList = $alquilerRepo->findAll();

        $clienteRepos = $this->getDoctrine()->getRepository(Clientes::class);
        $clientes = $clienteRepos->findAll();

        $peliRepo = $this->getDoctrine()->getRepository(Peliculas::class);
        $peliculas = $peliRepo->findAll();

        return $this->render('alquiler/crear.html.twig', [
            'form' => $form->createView(),
            'alquileres' => $alquilerList,
            'clientes' => $clientes,
            'peliculas' => $peliculas,
        ]);
    }

    public function dias($alquiler){
        $fechaIni = $alquiler->getFechaInicio();
        $fechaFin = $alquiler->getFechaFin();
        $diff = $fechaIni->diff($fechaFin);
        $dias = $diff->days;

        return $dias;
    }

    public function calcular($idPeli, $dias){

        $peliRepo = $this->getDoctrine()->getRepository(Peliculas::class);
        $peliculas = $peliRepo->findById($idPeli);
        
        $precio = $peliculas[0]->getPrecioUnitario();
        $categoria = $peliculas[0]->getCategoria();
        switch($categoria){
            case 'Estreno':
                    $precioTotal = ($precio * $dias);
                break;
            case 'Normal': 
                    if ($dias <= '3'){
                        $precioTotal = ($precio * $dias);
                    } else {
                        $diasTot = ($dias - 3);
                        $precioUni = ($precio * 3);
                        $porcentaje = ($precio * 15)/100;
                        $precioNuevo = $precio + $porcentaje;
                        $precioTotal = ($precioUni + ($precioNuevo * $diasTot));
                    }
                break;
            case 'Clasica':
                    if ($dias <= '5'){
                        $precioTotal = ($precio * $dias);
                    } else {
                        $diasTot = ($dias - 5);
                        $precioUni = ($precio * 5);
                        $porcentaje = ($precio * 10)/100;
                        $precioNuevo = $precio + $porcentaje;
                        $precioTotal = ($precioUni + ($precioNuevo * $diasTot));
                    }
                break;
        }
        return $precioTotal;

    }


}
