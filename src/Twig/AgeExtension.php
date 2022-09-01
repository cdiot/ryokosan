<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AgeExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('age', [$this, 'formatAge']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('age', [$this, 'formatAge'], ['is_safe' => ['html']]),
        ];
    }

    public function formatAge($birthday)
    {
        $today = new \DateTime();
        $birthday = new \DateTime($birthday);
        $age = $today->diff($birthday, true)->y;

        return $age;
    }
}
