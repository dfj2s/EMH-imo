<?php

namespace App\Controller;

use App\Entity\Option;
use App\Form\OptionType;
use App\Repository\OptionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/option")
 */
class AdminOptionController extends AbstractController
{
    /**
     * @Route("/", name="admin.option.index", methods={"GET"})
     */
    public function index(OptionRepository $optionRepository): Response
    {
        return $this->render('admin/option/index.html.twig', [
            'options' => $optionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin.option.new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $option = new Option();
        $form = $this->createForm(OptionType::class, $option);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($option);
            $entityManager->flush();

            return $this->redirectToRoute('admin.option.index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/option/new.html.twig', [
            'option' => $option,
            'form' => $form,
        ]);
    }


    /**
     * @Route("/{id}/edite", name="admin.option.edite", methods={"GET", "POST"})
     */
    public function edit(Request $request, Option $option, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(OptionType::class, $option);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('admin.option.index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/option/edite.html.twig', [
            'option' => $option,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/admin/option/{id}", name="admin.option.delete", methods="DELETE")

     */
    public function delete(Request $request, Option $option, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$option->getId(), $request->request->get('_token'))) {
            $entityManager->remove($option);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin.option.index', [], Response::HTTP_SEE_OTHER);
    }
}
