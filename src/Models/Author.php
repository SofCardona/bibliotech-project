<?php

namespace App\Models;
class Author {
    private $id;
    private $name;
    private $biography;

    public function __construct($id, $name, $biography) {
        $this->id = $id;
        $this->name = $name;
        $this->biography = $biography;
    }

            public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getBiography() {
        return $this->biography;
    }

    public function getDetails() {
        return [
            'name' => $this->getName(),
            'biography' => $this->getBiography(),
        ];
    }
}