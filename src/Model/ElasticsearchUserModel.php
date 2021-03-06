<?php

namespace App\Model;

use App\Model\AbstractAppModel;

class ElasticsearchUserModel extends AbstractAppModel
{
    private $username;

    private $enabled;

    private $email;

    private $fullName;

    private $changePassword;

    private $password;

    private $roles;

    private $metadata;

    public function __construct()
    {
        $this->enabled = true;
        $this->changePassword = false;
        $this->roles = [];
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getChangePassword(): ?bool
    {
        return $this->changePassword;
    }

    public function setChangePassword(?bool $changePassword): self
    {
        $this->changePassword = $changePassword;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(?string $fullName): self
    {
        $this->fullName = $fullName;

        return $this;
    }

    public function getRoles(): ?array
    {
        return array_values($this->roles);
    }

    public function setRoles(?array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }

    public function setEnabled(?bool $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }

    public function getMetadata(): ?string
    {
        return $this->metadata;
    }

    public function setMetadata(?string $metadata): self
    {
        $this->metadata = $metadata;

        return $this;
    }

    public function convert(?array $user): self
    {
        $this->setUsername($user['username']);
        $this->setFullName($user['full_name']);
        $this->setEmail($user['email']);
        $this->setRoles($user['roles']);
        if (true == isset($user['metadata']) && 0 < count($user['metadata'])) {
            $this->setMetadata(json_encode($user['metadata'], JSON_PRETTY_PRINT));
        }
        return $this;
    }
}
