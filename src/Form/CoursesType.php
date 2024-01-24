<?php

namespace App\Form;

use App\Entity\Courses;
use App\Entity\documents;
use App\Entity\multimedia;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CoursesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', null, ['label' => 'Название '],)
            ->add('description', null, ['label' => 'Описание '],)
            ->add('duration', null, ['label' => 'Длительность  (час) '],)
            ->add('fk_id_document', EntityType::class, [
                'class' => documents::class,
                'choice_label' => 'title',
                'label' => 'Документ ',
            ])
            ->add('fk_id_media', EntityType::class, [
                'class' => multimedia::class,
                'choice_label' => 'title',
                'label' => 'Мультимедиа ',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Courses::class,
        ]);
    }
}
