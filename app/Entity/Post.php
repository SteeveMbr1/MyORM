<?php

namespace App\Entity;

use MyORM\Entity\Entity;

class Post extends Entity
{
    public string   $title;
    public string   $content;
    public string   $created_at;
    public bool     $is_online;
    public int      $author;

    protected array $hasOne = [
        'Author' => User::class
    ];


    /**
     * Get the value of name
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Set the value of name
     *
     * @param string $title
     *
     * @return self
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

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
     * @return bool
     */
    public function getIsOnline(): bool
    {
        return $this->is_online;
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

    /**
     * Get the value of Author
     *
     * @return int
     */
    public function getAuthor(): User|int
    {
        return $this->author;
    }

    /**
     * Set the value of Author
     *
     * @param User|int $Author
     *
     * @return self
     */
    public function setAuthor(int $author): self
    {
        $this->author = $author;

        return $this;
    }
}
