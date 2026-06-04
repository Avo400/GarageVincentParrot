<?php

namespace App\Service;
use App\Entity\Vehicule;

class CurrentVehiculeService
{
    private ?Vehicule $vehicule = null;
    public function getCurrentVehicule(): ?Vehicule
    {
        return $this->vehicule;
    }

    public function setCurrentVehicule(Vehicule $vehicule)
    {
        $this->vehicule= $vehicule;
    }
}