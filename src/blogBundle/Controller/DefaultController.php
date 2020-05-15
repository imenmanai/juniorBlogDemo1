<?php

namespace blogBundle\Controller;

use blogBundle\Entity\Article;
use blogBundle\Entity\Categorie;
use blogBundle\Form\ArticleType;
use blogBundle\Form\CategorieType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@blog/Default/index.html.twig');
    }
    public function index1Action()
    {
        return $this->render('@blog/back/index.html.twig');
    }
public function ajoutCategorieAction(Request $request)
{
    $cat = new Categorie();
    $form=$this->createForm(CategorieType::class,$cat);
    $form->handleRequest($request);
    if($form->isValid())
    { $date=new \DateTime('now');
        $liste=$this->getDoctrine()->getRepository(Categorie::class)->findAll();

        $em=$this->getDoctrine()->getManager();
        $cat->setDateAjout($date);
        $em->persist($cat);
        $em->flush();
        return $this->redirectToRoute('afficherCat');

    }        return $this->render('@blog/back/ajoutCat.html.twig',array('f'=>$form->createView()));

}

public function afficherCatAction(Request $request)
{

    $liste=$this->getDoctrine()->getRepository(Categorie::class)->findAll();


        return $this->render('@blog/back/afficherCat.html.twig',array('infos'=>$liste));


}


public function modifierCatAction(Request $request,$id)
{
$cat=$this->getDoctrine()->getRepository(Categorie::class)->find($id);
    $form=$this->createForm(CategorieType::class,$cat);
    $form->handleRequest($request);
    if($form->isValid())
    { $date=new \DateTime('now');

        $em=$this->getDoctrine()->getManager();
        $cat->setDateAjout($date);
        $em->persist($cat);
        $em->flush();
        return $this->redirectToRoute('afficherCat');

    }        return $this->render('@blog/back/modifierCat.html.twig',array('f'=>$form->createView()));

}

public function suppCatAction($id)
{
    $cat=$this->getDoctrine()->getRepository(Categorie::class)->find($id);
    var_dump($cat);
    $em=$this->getDoctrine()->getManager();
    $em->remove($cat);
    $em->flush();
    return $this->redirectToRoute('afficherCat');

}
/************ajouterArticle********************/
    public function ajoutArticleAction(Request $request)
    {
    $article=new Article();
        $form=$this->createForm(ArticleType::class,$article);
        $form->handleRequest($request);
        if($form->isValid())
        {            /** @var UploadedFile $file */
            $file = $article->getImage();
            $filename = $this->generateUniqueFileName().'.'.$file->guessExtension();
          //  $file->move($this->getParameter('photos_directory'), $filename);
            $img=$file->getClientOriginalName();
            $directory = $this->container->getParameter('kernel.root_dir') . '/../web/Back/images';
            $file->move($directory, $img);

            $article->setImage($img);

            $date=new \DateTime('now');
           // $liste=$this->getDoctrine()->getRepository(Categorie::class)->findAll();
            $liste=$this->getDoctrine()->getRepository(Article::class)->findAll();

            $em=$this->getDoctrine()->getManager();
            $article->setDateAjout($date);
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('afficherArticle');
        }
        return $this->render('@blog/back/ajoutArticle.html.twig',array('f'=>$form->createView()));

    }
    private function generateUniqueFileName()
    {
        return md5(uniqid());
    }

    public function afficherArticleAction(Request $request)
{

    $liste=$this->getDoctrine()->getRepository(Article::class)-> findAll();
   // var_dump($liste);
//$nomcat=$this->getDoctrine()->getRepository(Categorie ::class)->findAll();

    return $this->render('@blog/back/afficherArticle.html.twig',array('infos'=>$liste));


}
    public function detailArticleAction(Request $request,$id)
    {

        $liste=$this->getDoctrine()->getRepository(Article::class)->find($id);


        return $this->render('@blog/back/detailArticle.html.twig',array('infos'=>$liste));


    }
    public function modifierArticleAction(Request $request,$id)
    {
        $article=$this->getDoctrine()->getRepository(Article::class)->find($id);
        $form=$this->createForm(ArticleType::class,$article);
        $form->handleRequest($request);
        if($form->isValid())
        {            /** @var UploadedFile $file */
            $file = $article->getImage();
            $filename = $this->generateUniqueFileName().'.'.$file->guessExtension();
            //  $file->move($this->getParameter('photos_directory'), $filename);
            $img=$file->getClientOriginalName();
            $directory = $this->container->getParameter('kernel.root_dir') . '/../web/Back/images';
            $file->move($directory, $img);

            $article->setImage($img);

            $date=new \DateTime('now');
            // $liste=$this->getDoctrine()->getRepository(Categorie::class)->findAll();
            $liste=$this->getDoctrine()->getRepository(Article::class)->findAll();

            $em=$this->getDoctrine()->getManager();
            $article->setDateAjout($date);
            $em->persist($article);
            $em->flush();
            return $this->render('@blog/back/afficherArticle.html.twig',array('infos'=>$liste));

        }        return $this->render('@blog/back/modifierArticle.html.twig',array('f'=>$form->createView()));

    }

    public function suppArticleAction($id)
    {
        $cat=$this->getDoctrine()->getRepository(Article::class)->find($id);
        //var_dump($cat);
        $em=$this->getDoctrine()->getManager();
        $em->remove($cat);
        $em->flush();
        return $this->redirectToRoute('afficherArticle');

    }

}
