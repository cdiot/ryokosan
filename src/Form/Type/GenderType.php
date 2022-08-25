<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GenderType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'choices' => [
                'gender.female' => 'f',
                'gender.male' => 'm',
                'gender.other' => 'o',
            ],
        ]);
    }

    public function getParent(): string
    {
        return ChoiceType::class;
    }
}
