<?php

namespace App\Entity;

class Post extends Entity
{
    public string $name;
    public string $content;
    public string $created_at;
    public bool   $is_online;

    /**
     * Get the value of name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of content
     *
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @param string $content
     *
     * @return self
     */
    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the value of created_at
     *
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @param string $created_at
     *
     * @return self
     */
    public function setCreatedAt(string $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the value of is_online
     *
     * @return int
     */
    public function getIsOnline(): int
    {
        return (int) $this->is_online;
    }

    /**
     * Set the value of is_online
     *
     * @param bool $is_online
     *
     * @return self
     */
    public function setIsOnline(bool $is_online): self
    {
        $this->is_online = $is_online;

        return $this;
    }
}
