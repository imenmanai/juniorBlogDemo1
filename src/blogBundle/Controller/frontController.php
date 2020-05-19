<?php

namespace blogBundle\Controller;

use blogBundle\Entity\Article;
use blogBundle\Entity\Categorie;
use blogBundle\Entity\commentaire;
use blogBundle\Form\CategorieType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class frontController extends Controller
{
    public function indexAction()
    {
        return $this->render('@blog/Default/index.html.twig');
    }
    public function frontAction(Request $request)
    {$liste=$this->getDoctrine()->getRepository(Categorie::class)->findAll();

        return $this->render('@blog/Default/index.html.twig',array('infos'=>$liste));
    }
    public function afficherPostsAction(Request $request,$id)
    {$liste1=   $tasks = $this->getDoctrine()->getManager()
        ->getRepository(Article::class)
        ->findBy(['categorie' => $id]);;
        $liste=$this->getDoctrine()->getRepository(Categorie::class)->findAll();
        $nom=$this->getDoctrine()->getRepository(Categorie::class)->find($id);

        //   var_dump($liste1);
        return $this->render('@blog/Default/categorie.html.twig',array('infos'=>$liste,'info'=>$liste1,'nom'=>$nom));
    }

    public function afficherPostDetailAction(Request $request,$id)
{        $liste=$this->getDoctrine()->getRepository(Categorie::class)->findAll();

    $nom=$this->getDoctrine()->getRepository(Article::class)->find($id);
    return $this->render('@blog/Default/postDetail.html.twig',array('infos'=>$liste,'info'=>$nom));

}

/*****************************/

    public function ajoutCommentAction(Request $request)
    {
        $com = new commentaire();
       // $form->handleRequest($request);

          /*  $date=new \DateTime('now');
            $liste=$this->getDoctrine()->getRepository(Categorie::class)->findAll();

            $em=$this->getDoctrine()->getManager();

            $em->persist($cat);
            $em->flush();*/

        if($request->isXmlHttpRequest()){
            if ($request->isMethod('POST'))
            {$em=$this->getDoctrine()->getManager();
                $comm = $request->request->get("commentaire");
                $com->setCommentaire($comm);
$id= $request->request->get("id");
var_dump($id);
$com->setArticle($this->getDoctrine()->getRepository(Article::class)->find($id));
                $em->persist($com);
                $em->flush();
               // $post = $request->request->get("name_field");
                $liste=$this->getDoctrine()->getRepository(Categorie::class)->findAll();

                $nom=$this->getDoctrine()->getRepository(Article::class)->find($id);
                return $this->render('@blog/Default/postDetail.html.twig',array('infos'=>$liste,'info'=>$nom));

            }else

                return $this->redirectToRoute('front');} return $this->redirectToRoute('front');

    }











}
