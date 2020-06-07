<?php


namespace blogBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 *@ORM\Entity()

 */
class commentaire
{
    /**
     *@ORM\Column(type="integer",name="id")
     *@ORM\Id
     *@ORM\GeneratedValue(strategy="AUTO")
     */
private $id;
    /**
     * @ORM\Column(type="string",length=255)
     */
private $commentaire;

    /**
     * @ORM\ManyToOne(targetEntity="Article")
     * @ORM\JoinColumn(name="article",referencedColumnName="id")
     */
    private $article;
    /**
     * @ORM\Column(type="string",length=255)
     */
    private $mail;
    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user",referencedColumnName="id")
     */
    private $user;
    /**
     * @ORM\Column(type="datetime")
     */
    private $dateAjout;
    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return mixed
     */
    public function getDateAjout()
    {
        return $this->dateAjout;
    }

    /**
     * @param mixed $dateAjout
     */
    public function setDateAjout($dateAjout)
    {
        $this->dateAjout = $dateAjout;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param mixed $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * @param mixed $commentaire
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;
    }

    /**
     * @return mixed
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * @param mixed $article
     */
    public function setArticle($article)
    {
        $this->article = $article;
    }





}