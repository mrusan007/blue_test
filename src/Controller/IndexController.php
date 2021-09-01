<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Meals;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class IndexController extends AbstractController
{   

    private function categoryFilter($param){
        
        
       if ($param == 'NULL'){
           
        $meals = $this->getDoctrine()
        ->getRepository(Meals::class)
        ->findCategoryNull();
       }
       elseif($param == "!NULL"){
        $meals = $this->getDoctrine()
        ->getRepository(Meals::class)
        ->findCategoryNotNull();
        
       }
       else{
        $meals = $this->getDoctrine()
        ->getRepository(Meals::class)
        ->findCategoryInt($param);
       }

       return $meals;

    }

    private function jsonService()
    {

        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        return new Serializer($normalizers, $encoders);

    }

    #[Route('/', name: 'index')]
    public function index(Request $request): Response
    {

        $serializer = self::jsonService();
        $category_id = $request->query->get('category');

        
        $meals = self::categoryFilter($category_id);

        return new JsonResponse($serializer->serialize($meals, 'json'), 200, [], true);
    }
}
