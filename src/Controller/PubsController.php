<?php

namespace App\Controller;

use App\MenuProvider;
use App\PubsProvider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Psr\Log\LoggerInterface;

class PubsController extends AbstractController
{
    private PubsProvider $pubsProvider;
    private MenuProvider $menuProvider;
    private LoggerInterface $logger;

    public function __construct(PubsProvider $provider, MenuProvider $menuProvider, LoggerInterface $logger)
    {
        $this->pubsProvider = $provider;
        $this->menuProvider = $menuProvider;
        $this->logger = $logger;
    }

    #[Route('/', name: 'pubs')]
    public function index(): Response
    {
        $pubs = [];
        try {
            $pubs = $this->pubsProvider->getPubs();

        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
        }
        if (empty($pubs)) {
            $this->addFlash('error', 'No results found!');
        }
        return $this->render('pubs/index.html.twig', [
            'controller_name' => 'PubsController',
            'pubs' => $pubs
        ]);
    }

    #[Route('/pub/{id}', name: 'menu')]
    public function show(int $id): Response
    {
        $menu = [];
        $pub = '';
        try {
            $pub = $this->pubsProvider->getPub($id);
            $menu = $this->menuProvider->getMenu($id);

        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
        }
        if (empty($menu)) {
            $this->addFlash('error', 'No results found!');
        }
        return $this->render('pubs/show.html.twig', [
            'controller_name' => 'PubsController',
            'menu' => $menu,
            'pub' => $pub
        ]);
    }
}
