<?php


namespace blogBundle\Repository;


class articleRepository  extends \Doctrine\ORM\EntityRepository
{
    public function afficherArticle()
    {
        $query=$this->getEntityManager()
            ->createQuery('SELECT  a.image,a.titre,a.description,a.etat,a.dateAjout,md FROM  blogBundle:Categorie md INNER JOIN blogBundle:Article a WITH md = a.categorie');


        return $queri=$query->getResult();

    }

}