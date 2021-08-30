<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Meals;

class IndexController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(Request $request): Response
    {

        $category_id = $request->query->get('category');
        $meals= $this->getDoctrine()
        ->getRepository(Meals::class)
        ->findCategory($category_id);

        
       

        return $this->render('index.html.twig',['meals'=>$meals]);
    }
}
