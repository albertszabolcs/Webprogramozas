<?php

namespace Blog\Entity;

use Blog\Exception\ValidationException;

class Author
{
    private int $id;
    private string $name;
    private string $email;
    private string $bio;

    public function __construct(int $id, string $name, string $email, string $bio = "")
    {
        $this->id = $id;
        $this->name = $name;

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new ValidationException("Invalid email format");
        }
        $this->email = $email;
        $this->bio = $bio;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getBio(): string
    {
        return $this->bio;
    }

    public function __toString(): string
    {
        return "Author: {$this->name} ({$this->email})";
    }
}
?>
