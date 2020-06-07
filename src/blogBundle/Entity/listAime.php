<?php


namespace blogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 *@ORM\Entity()

 */
class listAime
{
    /**
     *@ORM\Column(type="integer")
     *@ORM\Id
     *@ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user",referencedColumnName="id")
     */
    private  $user;
    /**
     * @ORM\ManyToOne(targetEntity="Article")
     * @ORM\JoinColumn(name="article",referencedColumnName="id")
     */
    private $article;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
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

    public function getUser()
    {
        return $this->user;
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