<?php

namespace App\Form;

use App\Entity\Employee;
use App\Entity\depts;
use App\Entity\employeePosts;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmployeeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('surname', null, [
                "label" => "Фамилия ",
            ])
            ->add('name', null, [
                "label" => "Имя ",
            ])
            ->add('midName', null, [
                "label" => "Отчество ",
            ])
            ->add('birthDate', null, ["label" => "Дата рождения ",], array(
                'widget' => 'choice',
                'years' => range(date('Y')-90, date('Y')),
                'months' => range(date('m'), 12),
                'days' => range(1, 31)))
            ->add('startWorkDate' , null, [
                "label" => "Дата устройства на работу ",
            ], array(
                'widget' => 'choice',
                'years' => range(date('Y')-90, date('Y')),
                'months' => range(date('m'), 12),
                'days' => range(1, 31)))
            ->add('numberPhone', null, [
                "label" => "Номер телефона ",
            ])
            ->add('fk_id_employeePost', EntityType::class, [
                "label" => "Должность ",
                'class' => EmployeePosts::class,
                'choice_label' => 'name_post',
            ])
            ->add('fk_id_dept', EntityType::class, [
                "label" => "Отдел ",
                'class' => Depts::class,
                'choice_label' => 'dept_name',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Employee::class,
        ]);
    }
}
