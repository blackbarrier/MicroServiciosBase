<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductoController extends AbstractController
{
    #[Route('/productos', name: 'app_productos')]
    public function index(): Response
    {
        // dd("productos");
        return $this->render('logistica/productos/index.html.twig', [
           
        ]);
    }
}
