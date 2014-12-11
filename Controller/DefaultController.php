<?php

namespace AppVentus\AviaryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function saveAction(Request $request)
    {
        $urlFrom = $request->request->get('urlFrom');
        $urlTo = $this->get('kernel')->getRootDir().'/../web'.$request->request->get('urlTo');

        $uploadHandler = $this->get('appventus.aviary.upload_handler');
        $file = $uploadHandler->uploadFromLink($urlTo, $urlFrom);
        $uploadHandler->handle_image_file($urlTo, $file);

        return new JsonResponse($file);
    }

    public function uploadAction(Request $request)
    {
        $this->container->get('appventus.aviary.upload_handler')->initialize();

        return new Response('');
    }
}
