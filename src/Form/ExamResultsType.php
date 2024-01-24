<?php

namespace App\Form;

use App\Entity\ExamResults;
use App\Entity\employee;
use App\Entity\exams;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExamResultsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateExam', null, ['label' => 'Дата проведения экзамена '],)
            ->add('result', null, ['label' => 'Результат '],)
            ->add('isComplete', null, ['label' => 'Экзамен сдан? '],)
            ->add('fk_id_employee', EntityType::class, [
                'class' => employee::class,
                'choice_label' => 'surname',
                'label' => 'Сдающий сотрудник',
            ])
            ->add('fk_id_exam', EntityType::class, [
                'class' => exams::class,
                'choice_label' => 'id',
                'label' => 'Экзамен',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ExamResults::class,
        ]);
    }
}
