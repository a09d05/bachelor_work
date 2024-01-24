<?php

namespace App\Form;

use App\Entity\Multimedia;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MultimediaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', null, ['label' => 'Название '],)
            ->add('type', null, ['label' => 'Тип '],)
            ->add('description', null, ['label' => 'Описание '],)
            ->add('content', null, ['label' => 'Содержимое '],)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Multimedia::class,
        ]);
    }
}
