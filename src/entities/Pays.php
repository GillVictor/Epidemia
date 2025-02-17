<?php

namespace App;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
#[ORM\Table(name: 'pays')]
class Pays {

    #[ORM\Id, ORM\Column(type: 'integer'), ORM\GeneratedValue]
    private int $id;

    #[ORM\Column(type: 'string', length: 100)]
    private string $nom;

    #[ORM\OneToMany(targetEntity: Zone::class, cascade: ['persist', 'remove'], mappedBy: 'pays')]
    private Collection $zones;

    public function __construct() {
        $this->nom = ""; 
        $this->zones = new ArrayCollection();
    }

    public function getId(): ?int {
        return $this->id ?? null;  
    }
    

    public function getNom(): ?string {
        return $this->nom;
    }

    public function setNom(string $nom): self {
        $this->nom = $nom;
        return $this;
    }


    public function getZones(): Collection {
        return $this->zones;
    }

    public function addZone(Zone $zone): self {
        if (!$this->zones->contains($zone)) {
            $this->zones[] = $zone;
            $zone->setPays($this);
        }
        return $this;
    }

    public function removeZone(Zone $zone): self {
        if ($this->zones->removeElement($zone)) {
            if ($zone->getPays() === $this) {
                $zone->setPays(null);
            }
        }
        return $this;
    }
    
    public function clearZones(): void {
        $this->zones->clear(); // Supprime toutes les zones associées
    }
}

?>