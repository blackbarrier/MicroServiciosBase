<?php

namespace App\Controller;

use App\Entity\CierreCaja;
use App\Entity\Producto;
use App\Entity\RegistroVenta;
use App\Form\CierreCajaType;
use App\Repository\CierreCajaRepository;
use App\Repository\PagoRepository;
use App\Repository\ProductoRepository;
use App\Repository\RegistroVentaRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Validator\Constraints\Date;

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
            ];
        }

        $venta = new RegistroVenta;
        $hoy = new DateTime();
        $venta->setProductos($productos);
        $venta->setMontoTotal($total);
        $venta->setFecha($hoy);
        $registroVentaRepository->agregar($venta, true);

        return $this->json($carrito);
    }

    #[Route('/cierreCaja', name: 'app_cierre_caja', methods: ['POST','GET'])]
    public function cerrarCaja(RegistroVentaRepository $ventasR, PagoRepository $pagosR, Request $request, CierreCajaRepository $cierreCajaR, EntityManagerInterface $entityManager)
    {
        $cierreCaja = new CierreCaja();
        $ingresos=0;
        $egresos=0;

        $registrosVenta = $ventasR->findBy(['cerrada' => false]);
        $registrosEgresos = $pagosR->findBy(['cerrado' => false]);

        foreach($registrosVenta as $venta){
            $ingresos+=$venta->getMontoTotal();
        }
        foreach($registrosEgresos as $egreso){
            $egresos+= $egreso->getMonto();
        }
        $balance = $ingresos-$egresos;

        $form = $this->createForm(CierreCajaType::class, $cierreCaja, [
            'balance' => $balance,
        ]);        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            foreach($registrosVenta as $venta){
                $venta->setCerrada(true);
                $entityManager->flush();
            }    
            foreach($registrosEgresos as $egreso){
                $egreso->setCerrado(true);
                $entityManager->flush();
            }
            $cierreCajaR->agregar($cierreCaja, true);
            return $this->redirectToRoute('app_cierre_caja', [], Response::HTTP_SEE_OTHER);
        }
       
        return $this->render('venta/cierreCaja.html.twig',[
            'ventas' => $registrosVenta,
            'gastos' => $registrosEgresos,
            'form' => $form
        ]);
      
    }

    #[Route('/consultarCierres', name: 'app_consulta_cierres', methods: ['GET'])]
    public function consultarCierres()
    {
       
    }


}
