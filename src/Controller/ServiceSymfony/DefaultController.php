<?php

namespace App\Controller\ServiceSymfony;

use App\Helper\Checker;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/service", name="service_symfony_default")
     */
    public function index(Checker $check): Response
    {
        $html="";
        $val=["A",'B','C','D'];
        foreach($val as $i){
            $html.="Default :".json_encode($check->get())."<br>";
            $isValid=$check->isValid($i);
            $html.="IS valid :".json_encode($isValid)."<br>";
        }
      
        return $this->render('service_symfony/default/index.html.twig', [
            'html' => $html,
        ]);
    }
}
