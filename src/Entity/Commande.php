<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_heure_depart = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_heure_fin = null;

    #[ORM\Column]
    private ?int $prix_total = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_enregistrement = null;

   

    #[ORM\ManyToOne(inversedBy: 'membres')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Membre $membres = null;

    #[ORM\ManyToOne(inversedBy: 'commandes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Vehicule $vehicules = null;

    public function __construct()
    {
    }

    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateHeureDepart(): ?\DateTimeInterface
    {
        return $this->date_heure_depart;
    }

    public function setDateHeureDepart(\DateTimeInterface $date_heure_depart): static
    {
        $this->date_heure_depart = $date_heure_depart;

        return $this;
    }

    public function getDateHeureFin(): ?\DateTimeInterface
    {
        return $this->date_heure_fin;
    }

    public function setDateHeureFin(\DateTimeInterface $date_heure_fin): static
    {
        $this->date_heure_fin = $date_heure_fin;

        return $this;
    }

    public function getPrixTotal(): ?int
    {
        return $this->prix_total;
    }

    public function setPrixTotal(int $prix_total): static
    {
        $this->prix_total = $prix_total;

        return $this;
    }

    public function getDateEnregistrement(): ?\DateTimeInterface
    {
        return $this->date_enregistrement;
    }

    public function setDateEnregistrement(\DateTimeInterface $date_enregistrement): static
    {
        $this->date_enregistrement = $date_enregistrement;

        return $this;
    }

    


    public function getMembres(): ?Membre
    {
        return $this->membres;
    }

    public function setMembres(?Membre $membres): static
    {
        $this->membres = $membres;

        return $this;
    }

    public function getVehicules(): ?Vehicule
    {
        return $this->vehicules;
    }

    public function setVehicules(?Vehicule $vehicules): static
    {
        $this->vehicules = $vehicules;

        return $this;
    }


}
