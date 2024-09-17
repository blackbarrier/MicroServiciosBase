<?php

namespace App\Controller;

use App\Entity\Producto;
use App\Entity\RegistroVenta;
use App\Repository\ProductoRepository;
use App\Repository\RegistroVentaRepository;
use DateTime;
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

    #[Route('/registrarVenta', name: 'app_registrar_venta_ajax', methods: ['POST'])]
    public function registrarVenta(Request $request, ProductoRepository $productoRepository, RegistroVentaRepository $registroVentaRepository)
    {
        $carrito = $request->get('carrito');
    
        $total = $request->get('total'); //Utilizo el total de la venta. No el parcial de cada producto.
        $productos=[];

        foreach ($carrito as $item) {
            $producto = $productoRepository->find($item["producto"]["id"]);            
            //ModificaStock
            $cantidadVendida = $item["cantidad"];
            $producto->bajarStock($cantidadVendida);
            $productoRepository->agregar($producto, true);

            //Crea variable para RegistroVenta
            $productos[] = [
                "id" =>  $producto->getId(),
                "cantidad" => $cantidadVendida,
                "subtotal" => $producto->getPrecio() * $cantidadVendida
            ]        ;
        }
        

        $venta = new RegistroVenta;
        $hoy = new DateTime();
        $venta->setProductos($productos);
        $venta->setMontoTotal($total);
        $venta->setFecha($hoy);
        $registroVentaRepository->agregar($venta, true);

        return $this->json($carrito);
    }

    #[Route('/cierreCaja', name: 'app_cierre_caja', methods: ['GET'])]
    public function cerrarCaja()
    {

        return $this->render('venta/cierreCaja.html.twig',[
            
        ]);
      
    }

    #[Route('/consultarCierres', name: 'app_consulta_cierres', methods: ['GET'])]
    public function consultarCierres()
    {
       
    }


}
