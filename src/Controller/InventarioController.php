<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


#[Route('/inventario')]
class InventarioController extends AbstractController
{
    #[Route('/', name: 'app_inventario')]
    public function index(): Response
    {
        return $this->render('logistica\inventario\index.html.twig');
    }
}
