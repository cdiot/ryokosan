<?php

namespace App\Service;

use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;

class ActivitySearch
{
    private ?ArrayCollection $destinations = null;

    private $startDate = null;

    private $minAge = null;

    private $maxAge = null;

    private $gender = null;

    public function __construct()
    {
        $this->destinations = new ArrayCollection();
    }

    /**
     * @return ArrayCollection
     */
    public function getDestinations(): ArrayCollection
    {
        return $this->destinations;
    }

    /**
     * @return ArrayCollection $destinations
     */
    public function setDestinations(ArrayCollection $destinations): void
    {
        $this->destinations = $destinations;
    }

    public function getStartDate()
    {
        return $this->startDate;
    }

    public function setStartDate($startDate): ActivitySearch
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getMinAge()
    {
        return $this->minAge;
    }

    public function setMinAge($minAge): ActivitySearch
    {
        $today = new \DateTime();
        $year = $today->modify("-$minAge year");

        $this->minAge = $year->format('Y-m-d');

        return $this;
    }

    public function getMaxAge()
    {
        return $this->maxAge;
    }

    public function setMaxAge($maxAge): ActivitySearch
    {
        $today = new \DateTime();
        $year = $today->modify("-$maxAge year");
        $this->maxAge = $year->format('Y-m-d');

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): ActivitySearch
    {
        $this->gender = $gender;

        return $this;
    }
}
