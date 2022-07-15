<?php

namespace App\Controller;

use App\Service\CallApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/", name="contact_")
 */
class HomeController extends AbstractController
{
    /**
     * @Route(name="home")
     */
    public function index(
        CallApiService $callApiService
    ): Response
    {
        return $this->render('home/index.html.twig', [
            'datas' => $callApiService->getContacts(),
        ]);
    }

    /**
     * @Route("/{id}", name="item")
     */
    public function item(
        CallApiService $callApiService,
        int $id
    ): Response
    {
        return $this->render('home/item.html.twig', [
            'data' => $callApiService->getItem($id),
        ]);
    }
}
