<?php

namespace OptimeBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use OptimeBundle\Entity\Product;
use Symfony\Component\HttpFoundation\Request;


class ProductController extends Controller
{
	public function createProductAction(Request $request)
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

		$code = $productData["code"];		
		$name = $productData["name"];
		$description = $productData["description"];		
		$mark = $productData["mark"];
		$category = $productData["category"];
		$price = $productData["price"];
	   	
	   	$product->setCode($code);
		$product->setName($name);
		$product->setDescription($description);
		$product->setMake($mark);
		$product->setCategory($category);
		$product->setPrice($price);

	    $em = $this->getDoctrine()->getManager();
	    if(!$isUpdate){
	    	$em->persist($product);	
	    }	    
	    $em->flush();
	    $productData["id"] = $product->getId();
		
	    return new JsonResponse($productData);
	    //return new Response('Created product id mmm');
	}

	public function listProductAction(Request $request)
	{	
		$repository = $this->getDoctrine()->getRepository(Product::class);
		$products = $repository->findAll();
		$arrayproducts = array();

		foreach ($products as $key => $value) {
			$product = array();
			$product["id"] = $value->getId();
			$product["code"] = $value->getCode();
			$product["name"] = $value->getName();
			$product["description"] = $value->setDescription();
			$product["mark"] = $value->getMark();
			$product["category"] = $value->getCategory();
			$product["price"] = $value->getPrice();
			$arrayproducts[] = $product;
		}
	    return new JsonResponse($arrayproducts);
	}

	public function deleteProductAction($id) {
 
 
        //Entity Manager
        $em = $this->getDoctrine()->getEntityManager();
        $posts = $em->getRepository("OptimeBundle:Product");
 
        $post = $posts->find($id);
        $em->remove($post);
        $flush=$em->flush();
 
        if ($flush == null) {
            echo "Producto se ha borrado correctamente";
        } else {
            echo "El Producto no se ha borrado";
        }
 
 
        die();
    }

	
}