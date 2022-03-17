<?php

namespace App\Controller;

use App\Entity\Property;
use App\Form\PropertyType;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminPropertyController extends AbstractController
{
    private $repository;
    private $em ;
    public function __construct(PropertyRepository $repository ,EntityManagerInterface $em)
    {
        
         $this->repository= $repository;
         $this->em=$em;
    }

    /**
     * @Route("/admin", name="admin.property.index")
     */
    public function index(): Response
    {
        $properties=$this->repository->findAll();
        return $this->render('admin/property/index.html.twig',compact("properties"));
    }
    /**
     * @Route("/admin/property/create", name="admin.property.new")
     */
    public function new(Request $request)
    {
        $property= new Property();
        $form=$this->createForm(PropertyType::class,$property);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){ 
            $this->em->persist($property);
            $this->em->flush();
            $this->addFlash("succes","Bien crèer avec succè");
            return $this->redirectToRoute('admin.property.index');
        }
        return $this->render('admin/property/new.html.twig',[
            "property"=>$property,"form"=>$form->createView()]
        );

    }
    /**
     * @Route("/admin/{id}",name="admin.property.edite",methods="POST|GET")
     */
    public function editer(Property $property , Request $request): Response
    {
        $form=$this->createForm(PropertyType::class,$property);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $this->em->flush();
            $this->addFlash("succes"," Bien modifier  avec succè");
            return $this->redirectToRoute('admin.property.index');

        }

        return $this->render('admin/property/edite.html.twig',[
            "property"=>$property,"form"=>$form->createView()]
        );
    }
    /**
     * @Route("/admin/{id}",name="admin.property.delete" ,methods="DELETE")
     */
    public function delete(Property $property ,Request $request)
    {
        if($this->isCsrfTokenvalid('delete'. $property->getId() , $request->get('_token'))){
    
        $this->em->remove($property);
        $this->em->flush();
        $this->addFlash("succes","Bien supprimer avec succè");

        
        }
        //$this->em->remove($property);
        //$this->em->flush();
        
        return $this->redirectToRoute("admin.property.index");


    }




}

