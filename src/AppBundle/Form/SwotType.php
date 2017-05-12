<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\Swot;


class SwotType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, [
                'required' => false,
                'label' => false,
            ])->add('a2_field', null, [
                'required' => false,
                'label' => false,
                'attr' => ['placeholder' => 'Helpful'],
            ])->add('a3_field', null, [
                'required' => false,
                'label' => false,
                'attr' => ['placeholder' => 'Harmful'],
            ])->add('b1_field', null, [
                'required' => false,
                'label' => false,
                'attr' => ['placeholder' => 'Internal'],
            ])->add('b2_field', null, [
                'required' => false,
                'label' => false,
                'attr' => ['placeholder' => 'Strengths'],
            ])->add('b2_items', CollectionType::class, [
                'allow_add' => true,
                'allow_delete' => true,
                'entry_type' => ItemType::class,
                'label' => false,
            ])->add('b3_field', null, [
                'required' => false,
                'label' => false,
                'attr' => ['placeholder' => 'Weaknesses'],
            ])->add('b3_items', CollectionType::class, [
                'allow_add' => true,
                'allow_delete' => true,
                'entry_type' => ItemType::class,
                'label' => false,
            ])->add('c1_field', null, [
                'required' => false,
                'label' => false,
                'attr' => ['placeholder' => 'External'],
            ])->add('c2_field', null, [
                'required' => false,
                'label' => false,
                'attr' => ['placeholder' => 'Opportunities'],
            ])->add('c2_items', CollectionType::class, [
                'allow_add' => true,
                'allow_delete' => true,
                'entry_type' => ItemType::class,
                'label' => false,
            ])->add('c3_field', null, [
                'required' => false,
                'label' => false,
                'attr' => ['placeholder' => 'Threats'],
            ])->add('c3_items', CollectionType::class, [
                'allow_add' => true,
                'allow_delete' => true,
                'entry_type' => ItemType::class,
                'label' => false,
            ])->add('save', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Swot::class,
        ));
    }
}