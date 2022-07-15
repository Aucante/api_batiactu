<?php

namespace App\Controller;

use App\Service\CallApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/real-estate", name="property")
 */
class PropertyController extends AbstractController
{
    /**
     * @Route("/{id}", name="_item")
     */
    public function item(
        CallApiService $callApiService,
        int $id
    ): Response
    {
        return $this->render('property/item.html.twig', [
            'data' => $callApiService->getItem($id),
        ]);
    }
}
