<?php

namespace App\Form;

use App\Entity\PlannedTrainings;
use App\Entity\courses;
use App\Entity\employee;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlannedTrainingsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateTrain', null, ['label' => 'Дата начала курса '],)
            ->add('fk_id_course', EntityType::class, [
                'class' => courses::class,
                'choice_label' => 'title',
                'label' => 'Курс ',
            ])
            ->add('fk_id_employee', EntityType::class, [
                'class' => employee::class,
                'choice_label' => 'surname',
                'label' => 'Сотрудник ',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PlannedTrainings::class,
        ]);
    }
}
