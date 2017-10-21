<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Validator\Constraints\Valid;

abstract class AbstractMatrixType extends AbstractType
{
    /**
     * @var FormBuilderInterface
     */
    protected $builder;

    /**
     * @var Translator
     */
    protected $translator;

    abstract protected function getType(): string;

    abstract protected function templateBuildForm();

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
            ->add('canvas', HiddenType::class, [
                'attr' => ['class' => 'canvas'],
            ]);
        $this->templateBuildForm();
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $class = "AppBundle\Entity\Matrix\Forms\\".ucfirst($this->getType()).'Form';
        $resolver->setDefaults(array(
                'data_class' => $class,
            )
        )->setRequired('translator');
    }

    protected function addField(string $name, string $data = ''): AbstractType
    {
        $options = [
            'label' => false,
        ];
        if ($data) {
            $transId = $this->getType().".".$data;
            $options['empty_data'] = $this->translator->trans($transId);
            $options['attr']['placeholder'] = $transId;
        }
        $this->builder->add($name.'field', null, $options);

        return $this;
    }

    protected function addItems(string $name): AbstractType
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
