<?php
namespace App\Entity;

class ProductSearch {
    /**
     * @var string|null
     */
    private $city;

    public function getCity(): ?string{
		return $this->city;
	}

    public function setCity(string $city): self
    {
        $this->city = $city;
        return $this;
    }
}