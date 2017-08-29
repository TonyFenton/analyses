<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use AppBundle\Entity\Contact;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('from', EmailType::class, [
                'label' => 'contact.from',
            ])
            ->add('subject', null, [
                'label' => 'contact.subject',
            ])
            ->add('content', TextareaType::class, [
                'label' => 'contact.content',
            ])
            ->add('send', SubmitType::class, [
                'attr' => ['class' => 'btn btn-primary delete-button'],
                'label' => 'contact.send',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
                'data_class' => Contact::class,
            )
        );
    }
}