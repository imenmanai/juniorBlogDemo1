<?php

namespace blogBundle\Controller;

use blogBundle\Entity\Categorie;
use blogBundle\Form\CategorieType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class frontController extends Controller
{
    public function indexAction()
    {
        return $this->render('@blog/Default/index.html.twig');
    }
    public function frontAction()
    {
        return $this->render('@blog/Default/index.html.twig');
    }

}
