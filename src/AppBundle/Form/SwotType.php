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
    private $builder = null;
    private $translator = null;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->translator = $options['translator'];
        $this->builder = $builder;

        $this->builder
            ->add('name', null, [
                'label' => $this->translator->trans('Name'),
                'required' => true,
            ])->add('save', SubmitType::class);

        $this
            ->addField('a2', 'Helpful')
            ->addField('a3', 'Harmful')
            ->addField('b1', 'Internal')
            ->addField('b2', 'Strengths')
            ->addItems('b2')
            ->addField('b3', 'Weaknesses')
            ->addItems('b3')
            ->addField('c1', 'External')
            ->addField('c2', 'Opportunities')
            ->addItems('c2')
            ->addField('c3', 'Threats')
            ->addItems('c3');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
                'data_class' => Swot::class,
            )
        )->setRequired('translator');
    }

    private function addField(string $name, string $placeholder = '')
    {
        $options = [
            'label' => false,
        ];
        if ($placeholder) {
            $options['attr'] = ['placeholder' => $this->translator->trans($placeholder)];
        }
        $this->builder->add($name.'_field', null, $options);

        return $this;

    }

    private function addItems(string $name)
    {
        $this->builder->add($name.'_items', CollectionType::class, [
            'allow_add' => true,
            'allow_delete' => true,
            'entry_type' => ItemType::class,
            'label' => false,
        ]);

        return $this;
    }
}