<?php

namespace App\Entity;

use App\Repository\SortiesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Collection;

/**
 * @ORM\Entity(repositoryClass=SortiesRepository::class)
 */
class Sorties
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $nom;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datedebut;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $duree;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datecloture;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbinscriptionsmax;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $descriptioninfos;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $etatsortie;

    /**
     * @ORM\Column(type="string", length=250, nullable=true)
     */
    private $urlphoto;




    /**
     * @ORM\ManyToOne (targetEntity="App\Entity\Lieux",inversedBy="sorties")
     */
    private $lieux;
    /**
     * @ORM\ManyToOne (targetEntity="App\Entity\Etats",inversedBy="sorties")
     */
    private $etat;
    /**
     * @ORM\ManyToOne (targetEntity="App\Entity\Campus",inversedBy="sorties")
     */
    private $campus;

    /**
     * @ORM\ManyToOne(targetEntity=Participants::class)
     */
    private $organisateur;

    /**
     * @ORM\ManyToMany(targetEntity=Participants::class)
     */
    private $participants;


    public function __construct()
    {
        //$this->lieux=new ArrayCollection();
        //$this->participant=new ArrayCollection();
        $this->participants = new ArrayCollection();
    }




    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDatedebut(): ?\DateTimeInterface
    {
        return $this->datedebut;
    }

    public function setDatedebut(\DateTimeInterface $datedebut): self
    {
        $this->datedebut = $datedebut;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(?int $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getDatecloture(): ?\DateTimeInterface
    {
        return $this->datecloture;
    }

    public function setDatecloture(\DateTimeInterface $datecloture): self
    {
        $this->datecloture = $datecloture;

        return $this;
    }

    public function getNbinscriptionsmax(): ?int
    {
        return $this->nbinscriptionsmax;
    }

    public function setNbinscriptionsmax(int $nbinscriptionsmax): self
    {
        $this->nbinscriptionsmax = $nbinscriptionsmax;

        return $this;
    }

    public function getDescriptioninfos(): ?string
    {
        return $this->descriptioninfos;
    }

    public function setDescriptioninfos(?string $descriptioninfos): self
    {
        $this->descriptioninfos = $descriptioninfos;

        return $this;
    }

    public function getEtatsortie(): ?int
    {
        return $this->etatsortie;
    }

    public function setEtatsortie(?int $etatsortie): self
    {
        $this->etatsortie = $etatsortie;

        return $this;
    }

    public function getUrlphoto(): ?string
    {
        return $this->urlphoto;
    }

    public function setUrlphoto(?string $urlphoto): self
    {
        $this->urlphoto = $urlphoto;

        return $this;
    }




    /**
     * @return mixed
     */
    public function getLieux(): Collection
    {
        return $this->lieux;
    }

    /**
     * @param mixed $lieux
     */
    public function setLieux($lieux): void
    {
        $this->lieux = $lieux;
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
    public function setEtat($etat): void
    {
        $this->etat = $etat;
    }

    /**
     * @return mixed
     */
    public function getCampus()
    {
        return $this->campus;
    }

    /**
     * @param mixed $campus
     */
    public function setCampus($campus): void
    {
        $this->campus = $campus;
    }

    public function getOrganisateur(): ?Participants
    {
        return $this->organisateur;
    }

    public function setOrganisateur(?Participants $organisateur): self
    {
        $this->organisateur = $organisateur;

        return $this;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection|Participants[]
     */
    public function getParticipants(): \Doctrine\Common\Collections\Collection
    {
        return $this->participants;
    }

    public function addParticipant(Participants $participant): self
    {
        if (!$this->participants->contains($participant)) {
            $this->participants[] = $participant;
        }

        return $this;
    }

    public function removeParticipant(Participants $participant): self
    {
        if ($this->participants->contains($participant)) {
            $this->participants->removeElement($participant);
        }

        return $this;
    }


}
