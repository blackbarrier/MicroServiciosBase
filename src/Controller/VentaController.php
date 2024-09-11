<?php

namespace App\Controller;

use App\Repository\ProductoRepository;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Encoder\JsonEncode;

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

    #[Route('/obtenerProductos', name: 'app_venta_ajax_producto', methods: ['POST'])]
    public function obtenerProductos(Request $request, ProductoRepository $productoRepository)
    {
        $productos = $productoRepository->findAll();
        return $this->json($productos);        
    }
}
