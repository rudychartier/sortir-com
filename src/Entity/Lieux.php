<?php

namespace App\Entity;

use App\Repository\LieuxRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LieuxRepository", repositoryClass=LieuxRepository::class)
 */
class Lieux
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
     * @ORM\ManyToOne (targetEntity="App\Entity\Villes", inversedBy="lieux")
     */
    private $ville;
    /**
     * @ORM\OneToMany (targetEntity="App\Entity\Sorties", mappedBy="lieux")
     */
    private $sorties;

    public function __construct()
    {
        $this->sorties=new ArrayCollection();

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
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * @param mixed $ville
     */
    public function setVille($ville): void
    {
        $this->ville = $ville;
    }

    /**
     * @return ArrayCollection
     */
    public function getSorties(): ArrayCollection
    {
        return $this->sorties;
    }

    /**
     * @param ArrayCollection $sorties
     */
    public function setSorties(ArrayCollection $sorties): void
    {
        $this->sorties = $sorties;
    }

}