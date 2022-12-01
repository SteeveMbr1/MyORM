<?php

namespace App\Entity;

class User extends Entity {

    protected ?string $login = '';
    protected ?string $password = '';

    /**
     * Undocumented function
     *
     * @param integer|null $id
     * @param string|null $login
     * @param string|null $password
     */
    public function __construct(protected int $id = -1)
    {
        parent::__construct($id);
    }

    /**
     * Get the value of login
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set the value of login
     */
    public function setLogin($login): self
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     */
    public function setPassword($password): self
    {
        $this->password = $password;

        return $this;
    }
}