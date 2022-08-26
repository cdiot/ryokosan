<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'label.email',
                'attr' => [
                    'placeholder' => 'label.email'
                ],
                'constraints' => [
                    new Email([
                        'message' => 'constraints.type_email',
                    ]),
                ]
            ])
            ->add('subject', TextType::class, [
                'label' => 'label.subject',
                'attr' => [
                    'placeholder' => 'label.subject'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'constraints.blank_subject',
                    ])
                ]
            ])
            ->add('content', TextareaType::class, [
                'label' => 'label.message',
                'attr' => [
                    'placeholder' => 'label.message'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'constraints.blank_message',
                    ])
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
