<?php

namespace App\Form;

use App\Entity\User;
use App\Form\Type\GenderType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\LessThanOrEqual;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
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
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'constraints.true_agree_terms',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => [
                    'autocomplete' => 'new-password',
                    'placeholder' => 'label.password'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'constraints.blank_password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'constraints.length_password',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
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
            ])
            ->add('sponsorship', TextType::class, [
                'label' => 'label.sponsorship',
                'required'   => false,
                'empty_data' => 'no sponsor',
                'attr' => [
                    'placeholder' => 'label.sponsorship'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'constraints.blank_sponsorship',
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
