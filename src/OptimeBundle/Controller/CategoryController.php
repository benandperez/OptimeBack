<?php

namespace OptimeBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use OptimeBundle\Entity\Product;
use OptimeBundle\Entity\Category;
use Symfony\Component\HttpFoundation\Request;


class CategoryController extends Controller
{
	public function createCategoryAction(Request $request)
	{

		$content = $request->getContent();
		$categoryData = json_decode($content, true);
		$category = null;
		$isUpdate = false;
		$id = null;

		if (isset($categoryData["id"])) {
			$id = $categoryData["id"];
			# code...
		}

		if($id != null){			
			$repository = $this->getDoctrine()->getRepository(Category::class);
			$category = $repository->findOneById($id);  
			$isUpdate = false;
		}else{
			$category = new Category();
		}

		$code = $categoryData["code"];		
		$name = $categoryData["name"];
		$description = $categoryData["description"];		
		$active = $categoryData["active"];
	   	
	   	$category->setCode($code);
		$category->setName($name);
		$category->setDescription($description);
		$category->setActive($active);

	    $em = $this->getDoctrine()->getManager();
	    if(!$isUpdate){
	    	$em->persist($category);	
	    }	    
	    $em->flush();
	    $categoryData["id"] = $category->getId();
		
	    return new JsonResponse($categoryData);
	    //return new Response('Created category id mmm');
	}

	public function listCategoryAction(Request $request)
	{	
		$repository = $this->getDoctrine()->getRepository(Category::class);
		$categorys = $repository->findAll();
		$arraycategorys = array();

		foreach ($categorys as $key => $value) {
			$category = array();
			$category["id"] = $value->getId();
			$category["code"] = $value->getCode();
			$category["name"] = $value->getName();
			$category["description"] = $value->getDescription();
			$category["active"] = $value->getActive();
			$arraycategorys[] = $category;
		}
	    return new JsonResponse($arraycategorys);
	}

	public function deleteCategoryAction($id) {
 
 
        //Entity Manager
        $em = $this->getDoctrine()->getEntityManager();
        $posts = $em->getRepository("OptimeBundle:Category");
 
        $post = $posts->find($id);
        $em->remove($post);
        $flush=$em->flush();
 
        if ($flush == null) {
            echo "Categoria se ha borrado correctamente";
        } else {
            echo "La categoria no se ha borrado";
        }
 
 
        die();
    }

    public function searchCategoryAction(Request $request)
	{	
		$repository = $this->getDoctrine()->getRepository(Category::class);
		$content = $request->getContent();
		$categoryData = json_decode($content, true);
		$categoryOne = $repository->findOneBy(array('code' => $categoryData["code"]));

		if ($categoryOne) {
			$category = array();
			$category["id"] = $categoryOne->getId();
			$category["code"] = $categoryOne->getCode();
			$category["name"] = $categoryOne->getName();
			$category["description"] = $categoryOne->getDescription();
			$category["active"] = $categoryOne->getActive();
			# code...
		}
			

	    return new JsonResponse($category);
	}

	
}