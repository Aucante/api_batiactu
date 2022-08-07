<?php

namespace App\Controller;

use App\Service\CallApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/contact/{id}", name="item")
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

    /**
     * @Route("/login", name="login")
     */
    public function login(
        CallApiService $callApiService,
        Request $request
    ): Response
    {
        $data = null;

        $username = $request->request->get('username');
        $password = $request->request->get('password');

        if ($username !== null && $password !== null) {
            $data = $callApiService->getLogin($username, $password);
            if ($data === Response::HTTP_UNAUTHORIZED) {
                $this->addFlash('danger', 'Les données de connexion sont fausses.');
                return $this->redirectToRoute('contact_login');
            }
        }

        return $this->render('home/login.html.twig', [
            'data' => $data
        ]);

    }
}
