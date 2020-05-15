<?php


namespace blogBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert ;

/**
 *@ORM\Entity(repositoryClass="blogBundle\Repository\articleRepository")

 */
class Article
{
    /**
     *@ORM\Column(type="integer",name="id")
     *@ORM\Id
     *@ORM\GeneratedValue(strategy="AUTO")
     */
private $id;
    /**
     * @ORM\Column(type="string",length=255)
     *
     */
private $titre;
    /**
     * @ORM\Column(type="string",length=4000)
     *
     */
private $description;

    /**
     * @ORM\Column(type="datetime")
     */
private $dateAjout;
    /**
     * @ORM\Column(type="string",length=255,nullable=true)
     */
private $etat;
    /**
     * @ORM\ManyToOne(targetEntity="Categorie")
     * @ORM\JoinColumn(name="idCat",referencedColumnName="id")
     */
    private $categorie;

    /**
     * @ORM\OneToMany(targetEntity="Image", mappedBy="article")
     */
private $images;

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }
    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=false)
     * @Assert\File(mimeTypes={ "image/jpeg" , "image/png","image/jpg","image/GIF" })
     *  @Assert\NotBlank(message="veuillez remplir le champs")
     */
private $image;
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
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @param mixed $categorie
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
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
     * @return mixed
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param mixed $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }



}