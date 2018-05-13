<?php

namespace App\Controller;

use App\Entity\Sprint;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/svelte")
 */
class SvelteBoardController extends Controller
{
    /**
     * @Route("/", name="svelte_board")
     */
    public function index()
    {
        $sprint = $this->getDoctrine()
            ->getRepository(Sprint::class)
            ->findOneBy([], ['number' => 'DESC']);

        return $this->redirectToRoute('svelte_board_sprint', ['sprint' => $sprint->getId()]);
    }

    /**
     * @Route("/{sprint}", name="svelte_board_sprint")
     */
    public function boardForSprint($sprint)
    {
        $sprint = $this->getDoctrine()
            ->getRepository(Sprint::class)
            ->find($sprint);

        $messages = $sprint->getMessages();
        $sprintMessage = [];
        foreach ($messages as $message) {
            $sprintMessage[] = [
                'id'         => $message->getId(),
                'message'    => $message->getMessage(),
                'likesCount' => count($message->getLikes())
            ];
        }


        return $this->render('svelte_board/index.html.twig',
            [
                'sprint' => json_encode([
                  'number'   => $sprint->getNumber(),
                  'messages' => $sprintMessage
                ]),
                'id'     => $sprint->getId()
            ]
          );
    }
}
