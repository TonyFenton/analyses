<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use AppBundle\Entity\Matrix\Forms\SwotForm;
use Symfony\Component\Validator\Constraints\Valid;

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
                'required' => true,
                'label' => false,
                'attr' => ['placeholder' => $this->translator->trans('matrix.name')],
            ])
            ->add('save', SubmitType::class, [
                'label' => 'button.save',
                'attr' => ['class' => 'btn btn-success'],
            ])
            ->add('text', SubmitType::class, [
                'label' => 'button.text',
                'attr' => ['class' => 'btn btn-default'],
            ])
            ->add('json', SubmitType::class, [
                'label' => 'button.json',
                'attr' => ['class' => 'btn btn-default'],
            ])
            ->add('jpg', SubmitType::class, [
                'label' => 'button.jpg',
                'attr' => ['class' => 'btn btn-default jpg'],
            ])
            ->add('png', SubmitType::class, [
                'label' => 'button.png',
                'attr' => ['class' => 'btn btn-default png'],
            ])
            ->add('html', SubmitType::class, [
                'label' => 'button.html',
                'attr' => ['class' => 'btn btn-default'],
            ])
            ->add('canvas', HiddenType::class, [
                'attr' => ['class' => 'canvas'],
            ]);

        $this
            ->addField('a2', 'helpful')
            ->addField('a3', 'harmful')
            ->addField('b1', 'internal')
            ->addField('b2', 'strengths')
            ->addItems('b2')
            ->addField('b3', 'weaknesses')
            ->addItems('b3')
            ->addField('c1', 'external')
            ->addField('c2', 'opportunities')
            ->addItems('c2')
            ->addField('c3', 'threats')
            ->addItems('c3');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
                'data_class' => SwotForm::class,
            )
        )->setRequired('translator');
    }

    private function addField(string $name, string $data = ''): SwotType
    {
        $options = [
            'label' => false,
        ];
        if ($data) {
            $options['empty_data'] = $this->translator->trans('swot.'.$data);
            $options['attr']['placeholder'] = 'swot.'.$data;
        }
        $this->builder->add($name.'field', null, $options);

        return $this;
    }

    private function addItems(string $name): SwotType
    {
        $this->builder->add($name.'items', CollectionType::class, [
            'allow_add' => true,
            'allow_delete' => true,
            'entry_type' => ItemType::class,
            'label' => false,
            'constraints' => array(new Valid()),
            'delete_empty' => true,
            'required' => false,
        ]);

        return $this;
    }
}