<?php

namespace App\Form;

use App\Entity\ViolationsRulesSafe;
use App\Entity\employee;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ViolationsRulesSafeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date_violation', null, ['label' => 'Дата нарушения '],)
            ->add('description', null, ['label' => 'Описание '], )
            ->add('fk_id_employee', EntityType::class, [
                'class' => employee::class,
                'choice_label' => 'surname',
                'label' => 'Сотрудник-нарушитель ',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ViolationsRulesSafe::class,
        ]);
    }
}
