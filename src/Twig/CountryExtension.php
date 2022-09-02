<?php

namespace App\Twig;

use Symfony\Component\Intl\Countries;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class CountryExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('country', [$this, 'countryName']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('country', [$this, 'countryName'], ['is_safe' => ['html']]),
        ];
    }

    public function countryName($languageCode)
    {
        $country = Countries::getName($languageCode);

        return $country;
    }
}
