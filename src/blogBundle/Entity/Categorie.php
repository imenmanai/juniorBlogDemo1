<?php


namespace blogBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 *@ORM\Entity()

 */
class Categorie
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
private $titre;
    /**
     * @ORM\Column(type="string",length=4000)
     *
     */
    private $description;
    /**
     * @ORM\Column(type="string",length=255)
     */
    private $images;
    /**
     * @ORM\Column(type="datetime")
     */
private $dateAjout;

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param mixed $images
     */
    public function setImages($images)
    {
        $this->images = $images;
    }

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
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param mixed $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
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




}