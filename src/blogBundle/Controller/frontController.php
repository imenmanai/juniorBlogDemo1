<?php

namespace blogBundle\Controller;

use blogBundle\Entity\Article;
use blogBundle\Entity\Categorie;
use blogBundle\Entity\commentaire;
use blogBundle\Entity\listAime;
use blogBundle\Entity\listVue;
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
    {$liste1= $this->getDoctrine()->getManager()
        ->getRepository(Article::class)
        ->findBy(['categorie' => $id]);;
        $liste=$this->getDoctrine()->getRepository(Categorie::class)->findAll();
        $nom=$this->getDoctrine()->getRepository(Categorie::class)->find($id);
/************/
        $dql   = "SELECT a FROM blogBundle:Article a where a.categorie =".$id;
        $em = $this->getDoctrine()->getManager();

        $query = $em->createQuery($dql);
        $paginator = $this->get('knp_paginator');

        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1),8 /*page number*/
        );
        //   var_dump($liste1);
        return $this->render('@blog/Default/categorie.html.twig',array('infos'=>$liste,'info'=> $pagination,'nom'=>$nom));
    }

    public function afficherPostDetailAction(Request $request,$id)
{$article=$this->getDoctrine()->getRepository(Article::class)->find($id);
    $nbrCom=$this->getDoctrine()->getRepository(Article::class)->count($id);
    $liste=$this->getDoctrine()->getRepository(Categorie::class)->findAll();
    $user=$this->getUser();
    $nom=$this->getDoctrine()->getRepository(Article::class)->find($id);
    $listcom=$this->getDoctrine()->getRepository(commentaire::class)->findBy(array('article'=>$id));
 $test=false;
    $listeAime = $this->getDoctrine()->getRepository(listAime::class)->findAll();

    foreach ($listeAime as $liste) {
        if($article->getId() == $liste->getArticle()->getId() && $liste->getUser() ==$this->getUser())
           $test=true;
        else $test=false;
    }
    $dql   = "SELECT a FROM blogBundle:commentaire a where a.article =".$id;
    $em = $this->getDoctrine()->getManager();

    $query = $em->createQuery($dql);
    $paginator = $this->get('knp_paginator');

    $pagination = $paginator->paginate(
        $query, /* query NOT result */
        $request->query->getInt('page', 1),4 /*page number*/
    );

    /***********************/
    $listeVue = $this->getDoctrine()->getRepository(listVue::class)->findAll();
    $test1=false;
    foreach ($listeVue as $liste) {
        if($article->getId() == $liste->getArticle()->getId() && $this->getUser()==$liste->getUser())
        {
            $test1=true;
            break;
        }
    }
if($test1==false)
{
    $vue= new listVue();
    $vue->setUser($this->getUser());
    $vue->setArticle($article);
    $c2=$this->getDoctrine()->getManager();
    $c2->persist($vue);
    $c2->flush();
    $c=$this->getDoctrine()->getManager();
    $c->persist($vue);
    $c->flush();

}

    $nbrVue=$this->getDoctrine()->getRepository(Article::class)->count1($id);

    if($request->isMethod("POST"))
{$test=$this->Like($article);

    if($test==false)
{$test=true;
$aime=new listAime();
$aime->setUser($this->getUser());
$aime->setArticle($this->getDoctrine()->getRepository(Article::class)->find($id));
    $c=$this->getDoctrine()->getManager();
$c->persist($aime);
$c->flush();

    return $this->render('@blog/Default/postDetail.html.twig',array('infos'=>$liste,'info'=>$nom,'list'=> $pagination ,'nbr'=>$nbrCom,'test'=>$test,'nbrVue'=>$nbrVue));

}
else if ($test==true) {
    $aimee=$this->getDoctrine()->getRepository(listAime::class)->findBy(array('article'=>$id,'user'=>$this->getUser()));
    $c=$this->getDoctrine()->getManager();
    $c->remove($aimee[0]);
    $c->flush();
    $test=false;
    return $this->render('@blog/Default/postDetail.html.twig',array('infos'=>$liste,'info'=>$nom,'list'=> $pagination ,'nbr'=>$nbrCom,'test'=>$test,'nbrVue'=>$nbrVue));

}
} else
    if($request->isXmlHttpRequest()){
        $nbrCom1=$this->getDoctrine()->getRepository(Article::class)->count($id);
        $liste1=$this->getDoctrine()->getRepository(Categorie::class)->findAll();
        $user1=$this->getUser();
        $nom1=$this->getDoctrine()->getRepository(Article::class)->find($id);
        $listcom1=$this->getDoctrine()->getRepository(commentaire::class)->findBy(array('article'=>$id));
        $com = new commentaire();
        $date=new \DateTime('now');
        $com->setDateAjout($date);
        $em=$this->getDoctrine()->getManager();
        $comm = $request->get('cMessage');

        $com->setCommentaire($comm);
        $com->setUser($user1);
        $com->setArticle($this->getDoctrine()->getRepository(Article::class)->find($id));
        $mail=  $request->get("cEmail");
        $com->setMail($mail);
        $em->persist($com);
        $em->flush();
        /*****************/

        // $post = $request->request->get("name_field");

        return $this->render('@blog/Default/postDetail.html.twig',array('infos'=>$liste1,'info'=>$nom1,'list'=>$pagination,'nbr'=> $pagination ,'test'=>$test,'nbrVue'=>$nbrVue));

    }

    /******************************************************/
    return $this->render('@blog/Default/postDetail.html.twig',array('infos'=>$liste,'info'=>$nom,'list'=> $pagination ,'nbr'=>$nbrCom,'test'=>$test,'nbrVue'=>$nbrVue));


}

/*****************************/
    public function Like($article)
    {
        $listeAime = $this->getDoctrine()->getRepository(listAime::class)->findAll();

        foreach ($listeAime as $liste) {
            if($article->getId() == $liste->getArticle()->getId() && $liste->getUser() ==$this->getUser())
                return true;
        }

        return false;

    }

    public function ajoutCommentAction(Request $request)
    {

       // $form->handleRequest($request);

          /*  $date=new \DateTime('now');
            $liste=$this->getDoctrine()->getRepository(Categorie::class)->findAll();

            $em=$this->getDoctrine()->getManager();

            $em->persist($cat);
            $em->flush();*/
         // $request = $this->get('request');

        if($request->isXmlHttpRequest()){
            $com = new commentaire();
           $em=$this->getDoctrine()->getManager();
                $comm = $request->request->get("cMessage");
                $com->setCommentaire($comm);
$id= $request->request->get("id");
$com->setArticle($this->getDoctrine()->getRepository(Article::class)->find($id));
$mail=  $request->request->get("cEmail");
$com->setMail($mail);
$em->persist($com);
                $em->flush();
               // $post = $request->request->get("name_field");
                $liste=$this->getDoctrine()->getRepository(Categorie::class)->findAll();

                $nom=$this->getDoctrine()->getRepository(Article::class)->find($id);
                return $this->render('@blog/Default/postDetail.html.twig',array('infos'=>$liste,'info'=>$nom));

            }else

             return $this->redirectToRoute('front');

    }





/***************************************aime****************/






}
