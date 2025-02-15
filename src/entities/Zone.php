<?php
namespace App;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
#[ORM\Table(name: 'zones')]
class Zone {

    #[ORM\Id, ORM\Column(type: 'integer'), ORM\GeneratedValue]
    private int $id;

    #[ORM\Column(type: 'string')]
    private string $nom;

    #[ORM\Column(type: 'string')]
    private string $statut;

    #[ORM\Column(type: 'integer')]
    private int $nb_positifs;

    #[ORM\ManyToOne(targetEntity: Pays::class, inversedBy: 'zones')]
    #[ORM\JoinColumn(nullable: false, onDelete: "CASCADE")]
    private ?Pays $pays;

    #[ORM\OneToMany(targetEntity: PointSurveillance::class, mappedBy: 'zone', cascade: ['persist', 'remove'])]
    private Collection $pointSurveillance;

    #[ORM\Column(type: 'integer')]
    private int $nb_symptomatiques;

    #[ORM\Column(type: 'integer')]
    private int $nb_habitants;

    public function __construct() {
        $this->nom = "";
        $this->pointSurveillance = new ArrayCollection();
        $this->nb_positifs = 0;  
        $this->nb_symptomatiques = 0;
        $this->nb_habitants = 0;
        $this->statut = " ";
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getNom(): ?string {
        return $this->nom;
    }

    public function setNom(string $nom): self {
        $this->nom = $nom;
        return $this;
    }

    public function calculStatut(): void {
        if ($this->nb_habitants > 0) {
            $taux = ($this->nb_positifs * 100) / $this->nb_habitants;
            if ($taux < 5) {
                $this->statut = "Vert";
            } else if ($taux <= 15) {
                $this->statut = "Orange";
            } else {
                $this->statut = "Rouge";
            }
        } else {
            $this->statut = 'Indéterminé'; //Dans le cas où il n'y aurait aucun habitant
        }
    }
    public function getStatut(): ?string {
        return $this->statut;
    }
    
    public function getNbrSymptomatiques(): ?int {
        return $this->nb_symptomatiques;
    }

    public function setNbrSymptomatiques(int $nb_symptomatiques): self {
        $this->nb_symptomatiques = $nb_symptomatiques;
        return $this;
    }

    public function getNbrHabitants(): ?int {
        return $this->nb_habitants;
    }

    public function setNbrHabitants(int $nb_habitants): self {
        $this->nb_habitants = $nb_habitants;
        return $this;
    }

    public function getNbrPositifs(): ?int {
        return $this->nb_positifs;
    }

    public function setNbrPositifs(int $nb_positifs): self {
        $this->nb_positifs = $nb_positifs;
        return $this;
    }

    public function getPays(): ?Pays {
        return $this->pays;
    }

    public function setPays(?Pays $pays): self {
        $this->pays = $pays;
        return $this;
    }

    public function getPointSurveillance(): Collection {
        return $this->pointSurveillance;
    }

    public function ajoutPointSurveillance(Pointsurveillance $pointSurveillance): self {
        if (!$this->pointSurveillance->contains($pointSurveillance)) {
            $this->pointSurveillance[] = $pointSurveillance;
            $pointSurveillance->setZone($this);
        }
        return $this;
    }

    public function suppPointSurveillance(PointSurveillance $pointSurveillance): self {
        if ($this->pointSurveillance->removeElement($pointSurveillance)) {
            if ($pointSurveillance->getZone() === $this) {
                $pointSurveillance->setZone(null);
            }
        }
        return $this;
    }

    public function nombrePointSurveillance(): int {
        return $this->pointSurveillance->count();
    }

    public function __toString(): string {
        return sprintf(
            "Zone: %s | Statut: %s | Habitants: %d | Positifs: %d | Symptomatiques: %d | Points de Surveillance: %d",
            $this->nom,
            $this->statut,
            $this->nb_habitants,
            $this->nb_positifs,
            $this->nb_symptomatiques,
            $this->pointSurveillance->count()
        );
    }    
    
}

?>