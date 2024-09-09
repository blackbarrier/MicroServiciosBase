<?php

namespace App\Controller;

use App\Repository\ProductoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/venta')]
class VentaController extends AbstractController
{
    #[Route('/', name: 'app_venta_index', methods: ['GET'])]
    public function index(ProductoRepository $productoRepository): Response
    {
        $productos = $productoRepository->findAll();

        return $this->render('venta/moduloVentas.html.twig', [
            "productos" => $productos           
        ]);
    }
}
