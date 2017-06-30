<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType as FormFileType;
use AppBundle\Entity\Matrix\Forms\FileForm;

class FileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file', FormFileType::class, [
                'label' => false,
            ])
            ->add('upload', SubmitType::class, [
                'label' => 'matrix.upload_file',
                'attr' => ['class' => 'btn btn-success form-control'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
                'data_class' => FileForm::class,
            )
        );
    }
}