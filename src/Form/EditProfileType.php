<?php

namespace App\Form;

use App\Entity\User;
use App\Form\Type\GenderType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\LessThanOrEqual;
use Symfony\Component\Validator\Constraints\NotBlank;

class EditProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('files', FileType::class, [
                'label' => 'Upload photo',
                'required' => false,
                'mapped' => false,
                'multiple' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '5M',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/svg+xml'
                        ],
                        'mimeTypesMessage' => 'constraints.valid_profile_picture',
                    ])
                ],
            ])
            ->add('firstname', TextType::class, [
                'label' => 'label.firstname',
                'attr' => [
                    'placeholder' => 'label.firstname'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'constraints.blank_firstname',
                    ])
                ]
            ])
            ->add('email', EmailType::class, [
                'disabled' => true,
                'attr' => [
                    'placeholder' => 'label.email'
                ],
                'constraints' => [
                    new Email([
                        'message' => 'constraints.type_email',
                    ]),
                    new NotBlank([
                        'message' => 'constraints.blank_email',
                    ]),
                ],
            ])
            ->add('gender', GenderType::class, [
                'label' => 'label.gender',
                'placeholder' => 'placeholder.select',
                'constraints' => [
                    new NotBlank([
                        'message' => 'constraints.blank_gender',
                    ])
                ]
            ])
            ->add('birthday', BirthdayType::class, [
                'label' => 'label.birthday',
                'placeholder' => 'placeholder.select',
                'constraints' => [
                    new NotBlank([
                        'message' => 'constraints.blank_birthday',
                    ]),
                    new LessThanOrEqual([
                        'value' => '-15 years',
                        'message' => 'constraints.lessthanorequal_birthday',
                    ]),
                ]
            ])
            ->add('geolocalisation', CountryType::class, [
                'label' => 'label.geolocalisation',
                'placeholder' => 'placeholder.select',
                'constraints' => [
                    new NotBlank([
                        'message' => 'constraints.blank_geolocalisation',
                    ])
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
