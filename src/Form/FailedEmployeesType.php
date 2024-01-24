<?php

namespace App\Form;

use App\Entity\FailedEmployees;
use App\Entity\courses;
use App\Entity\employee;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FailedEmployeesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateFail', null, ['label' => 'Дата проваленного экзамена '],)
            ->add('fk_id_employee', EntityType::class, [
                'class' => employee::class,
                'choice_label' => 'surname',
                'label' => 'Сотрудник ',
            ])
            ->add('fk_id_course', EntityType::class, [
                'class' => courses::class,
                'choice_label' => 'title',
                'label' => 'Курс '
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FailedEmployees::class,
        ]);
    }
}
