<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
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
     * @ORM\Column(type="string", length=255)
     */
    private $slug;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Post",mappedBy="category")
     */
    private $post_id;

    public function __construct()
    {
        $this->post_id = new ArrayCollection();
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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection|Post[]
     */
    public function getPostId(): Collection
    {
        return $this->post_id;
    }

    public function addPostId(Post $postId): self
    {
        if (!$this->post_id->contains($postId)) {
            $this->post_id[] = $postId;
            $postId->setCategory($this);
        }

        return $this;
    }

    public function removePostId(Post $postId): self
    {
        if ($this->post_id->removeElement($postId)) {
            // set the owning side to null (unless already changed)
            if ($postId->getCategory() === $this) {
                $postId->setCategory(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->name;
    }
}
