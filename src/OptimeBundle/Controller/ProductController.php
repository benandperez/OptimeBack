<?php

namespace OptimeBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use OptimeBundle\Entity\Product;
use Symfony\Component\HttpFoundation\Request;


class ProductController extends Controller
{
	public function createAction(Request $request)
	{

		$content = $request->getContent();
		$productData = json_decode($content, true);
		$product = null;
		$isUpdate = false;
		$id = null;
		if (isset($productData["id"])) {
			$id = $productData["id"];
			# code...
		}
		if($id != null){			
			$repository = $this->getDoctrine()->getRepository(Product::class);
			$product = $repository->findOneById($id);  
			$isUpdate = false;
		}else{
			$product = new Product();
		}
		$nombres = $productData["nombres"];		
		$apellidos = $productData["apellidos"];
		$correo = $productData["correo"];		
		$telefono = $productData["telefono"];
		$tipo_de_cliente = $productData["tipo_de_cliente"];
		$comentarios = $productData["comentarios"];
	   	
	   	$product->setNombre($nombres);
		$product->setApellido($apellidos);
		$product->setTelefono($telefono);
		$product->setCorreo($correo);
		$product->setTipoDeCliente($tipo_de_cliente);
		$product->setComentarios($comentarios);

	    $em = $this->getDoctrine()->getManager();
	    if(!$isUpdate){
	    	$em->persist($product);	
	    }	    
	    $em->flush();
	    $productData["id"] = $product->getId();
		
	    return new JsonResponse($productData);
	    //return new Response('Created product id mmm');
	}

	public function listAction(Request $request)
	{		
		$repository = $this->getDoctrine()->getRepository(Product::class);
		$products = $repository->findAll();
		$arrayproducts = array();

		foreach ($products as $key => $value) {
			$product = array();
			$product["id"] = $value->getId();
			$product["nombre"] = $value->getNombre();
			$product["apellido"] = $value->getApellido();
			$product["telefono"] = $value->getTelefono();
			$product["correo"] = $value->getCorreo();
			$product["tipo_de_cliente"] = $value->getTipoDeCliente();
			$product["comentarios"] = $value->getComentarios();
			$arrayproducts[] = $product;
		}
	    return new JsonResponse($arrayproducts);
	}

	public function borrarAction($id) {
 
 
        //Entity Manager
        $em = $this->getDoctrine()->getEntityManager();
        $posts = $em->getRepository("OptimeBundle:Product");
 
        $post = $posts->find($id);
        $em->remove($post);
        $flush=$em->flush();
 
        if ($flush == null) {
            echo "Producto se ha borrado correctamente";
        } else {
            echo "El post no se ha borrado";
        }
 
 
        die();
    }

	
}