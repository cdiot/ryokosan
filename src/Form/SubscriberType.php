<?php

namespace App\Form;

use App\Entity\Subscriber;
use App\Entity\Rubric;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\NotBlank;

class SubscriberType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
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
            ->add('rubrics', EntityType::class, [
                'label' => 'label.rubrics',
                'class' => Rubric::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true
            ])
            ->add('is_rgpd', CheckboxType::class, [
                'constraints' => [
                    new IsTrue([
                        'message' => 'constraints.true_agree_terms'
                    ])
                ],
                'label' => 'label.agree_terms'
            ])
            ->add('send', SubmitType::class, [
                'label' => 'action.send',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Subscriber::class,
        ]);
    }
}
