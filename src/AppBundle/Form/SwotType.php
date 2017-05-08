<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\Swot;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class SwotType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('strengths', CollectionType::class, [
                'allow_add' => true,
                'allow_delete' => true,
                'label'=> false,
                'entry_type' => SwotItemType::class,
            ])
            ->add('weaknesses', CollectionType::class, [
                'allow_add' => true,
                'allow_delete' => true,
                'label'=> false,
                'entry_type' => SwotItemType::class,
            ])
            ->add('save', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Swot::class,
        ));
    }
}