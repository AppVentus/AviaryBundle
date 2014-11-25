<?php

namespace AppVentus\AviaryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

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
}
