<?php

namespace App\Filter;

use App\Entity\User;

class BlogFilter
{
    private ?string $title = null;

    public function __construct(private ?User $user = null)
    {
        
    }

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }
    
    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     */
    public function setTitle(?string $title): static
    {
        $this->title = $title;

        return $this;
    }

}