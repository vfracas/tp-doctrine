<?php

namespace App\Entity;

use App\Repository\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TagRepository::class)
 */
class Tag
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=Article::class, inversedBy="tags")
     */
    private $ArticleTag;

    public function __construct()
    {
        $this->ArticleTag = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Article[]
     */
    public function getArticleTag(): Collection
    {
        return $this->ArticleTag;
    }

    public function addArticleTag(Article $articleTag): self
    {
        if (!$this->ArticleTag->contains($articleTag)) {
            $this->ArticleTag[] = $articleTag;
        }

        return $this;
    }

    public function removeArticleTag(Article $articleTag): self
    {
        $this->ArticleTag->removeElement($articleTag);

        return $this;
    }
}
