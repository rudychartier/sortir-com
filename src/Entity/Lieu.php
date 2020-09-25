<?php

namespace App\Entity;

use App\Repository\LieuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LieuRepository", repositoryClass=LieuRepository::class)
 */
class Lieu
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column (type="string")
     */
    private $nom_lieu;

    /**
     * @ORM\Column (type="string", nullable=true)
     */
    private $rue;

    /**
     * @ORM\Column (type="decimal", nullable=true)
     */

    private $latitude;

    /**
     * @ORM\Column (type="decimal", nullable=true)
     */
    private $longitude;

    /**
     * @ORM\Column (type="string")
     * @ORM\ManyToOne(targetEntity="App\Entity\Ville", inversedBy="lieus")
     */
    private $ville_no_ville;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Sortie", mappedBy="lieu")
     */
    private $sorties;

    public function  __construct()
    {
        $this->sorties =new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

  /*  /**
     * @param mixed $id
     */
 /*   public function setId($id): void
    {
        $this->id = $id;
    }*/

    /**
     * @return mixed
     */
    public function getNomLieu()
    {
        return $this->nom_lieu;
    }

    /**
     * @param mixed $nom_lieu
     */
    public function setNomLieu($nom_lieu): void
    {
        $this->nom_lieu = $nom_lieu;
    }

    /**
     * @return mixed
     */
    public function getRue()
    {
        return $this->rue;
    }

    /**
     * @param mixed $rue
     */
    public function setRue($rue): void
    {
        $this->rue = $rue;
    }

    /**
     * @return mixed
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param mixed $latitude
     */
    public function setLatitude($latitude): void
    {
        $this->latitude = $latitude;
    }

    /**
     * @return mixed
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param mixed $longitude
     */
    public function setLongitude($longitude): void
    {
        $this->longitude = $longitude;
    }

    /**
     * @return mixed
     */
    public function getVilleNoVille()
    {
        return $this->ville_no_ville;
    }

    /**
     * @param mixed $ville_no_ville
     */
    public function setVilleNoVille($ville_no_ville): void
    {
        $this->ville_no_ville = $ville_no_ville;
    }

}
