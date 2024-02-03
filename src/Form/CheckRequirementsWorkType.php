<?php

namespace App\Form;

use App\Entity\CheckRequirementsWork;
use App\Entity\depts;
use App\Entity\Employee;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CheckRequirementsWorkType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('plannedCheckDate', null, [
                'label' => 'Планируемая дата проверки ',
            ])
            ->add('factCheckDate', null, [
                'label' => 'Фактическая дата проверки ',
            ])
            ->add('result', null, [
                'label' => 'Результат ',
            ])
            ->add('comments', null, [
                'label' => 'Комментарий ',
            ])
            ->add('fk_id_dept', EntityType::class, [
                'class' => depts::class,
                'choice_label' => 'dept_name',
                'label' => 'Проверяемый отдел ',
            ])
            ->add('fk_id_employee', EntityType::class, [
                'class' => Employee::class,
                'choice_label' => 'surname',
                'label' => 'Сотрудник ',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CheckRequirementsWork::class,
        ]);
    }
}
