<?php

namespace App\Controller;

if (!isset($_SESSION)) {
    session_start();
}

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\BrowserKit\Request;
use App\Entity\Telephony;

class TelephonyController extends AbstractController
{
    /**
     * @Route("/telephony/", name="telephony", methods="GET")
     */
    public function index(): Response
    {
        return $this->render('telephony/index.html.twig');
    }

    /**
     * @Route("/telephony/create", name="createTelephony", methods="POST")
     */
    public function create()
    {
        $telephony = new Telephony();
        $telephony->setMinutes($_POST['minutes']);
        $telephony->setPrice($_POST['price']);

        try {
            $newTelephony = $this->getDoctrine()->getManager();
            $newTelephony->persist($telephony);
            $newTelephony->flush();

            return $this->render('telephony/create.html.twig');
        } catch (\Throwable $th) {
            return $this->render('telephony/errorCreate.html.twig');
        }
    }
}
