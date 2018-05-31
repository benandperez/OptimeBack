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

		$em = $this->getDoctrine()->getManager();
		$content = $request->getContent();
		$productData = json_decode($content, true);
		$product = null;
		$isUpdate = false;
		$id = null;
		$repositoryCategory = $em->getRepository('OptimeBundle:Category');
        
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
		$make = $productData["make"];
		$category = $repositoryCategory->findOneById($productData["category"]); 
		$price = $productData["price"];

	   	
	   	$product->setCode($code);
		$product->setName($name);
		$product->setDescription($description);
		$product->setMake($make);
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
		$em = $this->getDoctrine()->getManager();
		$repository = $this->getDoctrine()->getRepository(Product::class);
		$products = $repository->findAll();
		$arrayproducts = array();
		$arrayCategoryProduct = array();
		$repositoryCategory = $em->getRepository('OptimeBundle:Category');
		$valueCate = null;


		foreach ($products as $key => $value) {
			$valueCate = $repositoryCategory->find($value->getCategory()->getId());
			$arrayCategoryProduct["id"] =$valueCate->getId();
			$arrayCategoryProduct["code"] =$valueCate->getCode();
			$arrayCategoryProduct["name"] =$valueCate->getName();
			$arrayCategoryProduct["active"] =$valueCate->getActive();

			$product = array();
			$product["id"] = $value->getId();
			$product["code"] = $value->getCode();
			$product["name"] = $value->getName();
			$product["description"] = $value->getDescription();
			$product["make"] = $value->getMake();
			$product["category"] = $arrayCategoryProduct;
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