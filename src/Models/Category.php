<?php

namespace App\Models;
class Category {
    public $id;
    public $name;
    public $description;

    public function __construct($id, $name, $description) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
    }

                public function getId() {
        return $this->id;
    }
    public function getName() {
        return $this->name;
    }

    public function getDescription() {
        return $this->description;
    }

public function getDetails()
{
    return $this->name . ' - ' . $this->description;
}



    public function setName($name) {
        $this->name = $name;
    }

    public function setDescription($description) {
        $this->description = $description;
    }
}