<?php

namespace App\Controller;

use App\Entity\Producto;
use App\Form\ProductoCargaType;
use App\Repository\ProductoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


#[Route('/inventario')]
class InventarioController extends AbstractController
{
    #[Route('/', name: 'app_inventario_index', methods: ['GET'])]
    public function index(ProductoRepository $productoRepository): Response
    {
        return $this->render('logistica/inventario/index.html.twig', [
            'productos' => $productoRepository->findAll(),
        ]);
    }

    #[Route('/carga', name: 'app_inventario_carga', methods: ['GET', 'POST'])]
    public function carga(Request $request, ProductoRepository $productoRepository, EntityManagerInterface $entityManager): Response
    {
        $productoId = $request->get('productoId');
        $stock_total= $request->get('stock_total');   
        $producto = $productoRepository->find($productoId);

        $producto->setStock($stock_total);        
        $entityManager->flush();
    }
}
