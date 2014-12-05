<?php

namespace AppVentus\AviaryBundle\Controller;

use AppVentus\AviaryBundle\Handler\UploadHandler;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function saveAction(Request $request)
    {
        $urlFrom = $request->request->get('urlFrom');
        $urlTo = $this->get('kernel')->getRootDir().'/../web'.$request->request->get('urlTo');
        try {
            $image_data = file_get_contents($urlFrom);
            file_put_contents($urlTo, $image_data);

            return new Response('');
        } catch (\Exception $e) { }

    }
    public function uploadAction(Request $request)
    {
        $options = array(
            'script_url' => $request->getUri(),
            'upload_dir' => $this->container->getParameter('aviary.upload_dir'),
            'upload_url' => $this->container->getParameter('aviary.upload_url'),
        );
        new UploadHandler($options);

        return new Response('');

    }
}
