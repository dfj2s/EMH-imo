<?php

namespace App\Controller;

use App\Entity\Property;
use App\Entity\RechercheBiens;
use App\Form\RechercheBiensType;
use App\Repository\PropertyRepository;
use Knp\Component\Pager\PaginatorInterface;
use PhpParser\Node\Expr\Cast\String_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController
{
    /**
     * @Var PropertyRepository
     */
    
    private $repository ;

    public function __construct(PropertyRepository $repository)
    {
        
         $this->repository= $repository;
    }

    /**
     * @Route("/biens", name="property.index")
     */
    public function index(PaginatorInterface $paginator ,HttpFoundationRequest $request): Response
    {
        $recherche= new RechercheBiens();
        $form= $this->createForm(RechercheBiensType::class,$recherche);
        $form->handleRequest($request);
        $properties = $paginator->paginate(
            $this->repository->findAllVIsibleQuery($recherche),
        $request->query->getInt('page',1),
        12
        );
    
        return $this->render('property/index.html.twig', [
            'current_menu' => 'properties',
            'properties'=>$properties ,
            'form' =>$form->createView()
        ]);
    }
    /** 
    * @Route("/biens/{slug}-{id}",name="property.show", requirements={"slug": "[a-z0-9\-]*"})
    */
    public function show(Property $property ,string $slug):Response
    {
        if($property->getSlug()!==$slug)
        {
        return $this->redirectToRoute("property.show",[
            'id'=>$property->getId(),
            'slug'=>$property->getSlug()],301);
       }
   
        return $this->render("property/show.html.twig",[
            "property"=>$property,
            'current_menu' => 'properties',
    ]);
        
   }

}
