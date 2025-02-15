<?php

namespace App;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
#[ORM\Table(name: 'PointSurveillance')]
class PointSurveillance {

    #[ORM\Id, ORM\Column(type: 'integer'), ORM\GeneratedValue]
    private int $id;

    #[ORM\Column(type: 'string')]
    private string $nom;

    #[ORM\ManyToOne(targetEntity: Zone::class, inversedBy: 'pointSurveillance')]
    #[ORM\JoinColumn(nullable: false, onDelete: "CASCADE")]
    private Zone $zone;
 
    public function __construct() {
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getNom(): ?string {
        return $this->nom;
    }

    public function setNom($nom) {
        $this->nom = $nom;
        return $this;
    }

    public function getZone(){
        return $this->zone;
    }

    public function setZone($zone){
        $this->zone = $zone;
        return $this;
    }

}
?>