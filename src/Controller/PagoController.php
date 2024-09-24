<?php

namespace App\Controller;

use App\Entity\Pago;
use App\Entity\Proveedor;
use App\Form\PagoType;
use App\Form\ProveedorType;
use App\Repository\PagoRepository;
use App\Repository\ProveedorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/pagos')]
class PagoController extends AbstractController

{
    #[Route('/', name: 'app_pagos_proveedor', methods: ['POST','GET'])]
    public function registrarPago(Request $request, PagoRepository $pagoRepository): Response
    {
        $pago = new Pago;

        $form = $this->createForm(PagoType::class, $pago);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $pagoRepository->agregar($pago, true);
            return $this->redirectToRoute('app_proveedor_index', [], Response::HTTP_SEE_OTHER);
        }


        return $this->render('venta/pagosProveedores.html.twig',[
            'form' => $form            
        ]);
    }
       

}
