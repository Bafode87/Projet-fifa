<?php


namespace App\Form;

use App\Controller\ContactMessageController;
use App\Entity\ContactMessage;
use App\Entity\User;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /** @var User|null $user */
        $user = $options['user'] instanceof User ? $options['user'] : null;
        $builder
            ->add('mail', NULL, [
                'label' => 'Adresse Email :',
                'attr' => ['class' => 'espaceCustom'],
                'data' => $user?->getEmail()
            ])
            ->add('sujet', NULL, [
                'label' => 'Sujet :',
                'attr' => ['class' => 'espaceCustom']
            ])
            ->add('message', CKEditorType::class, [
                'attr' => ['class' => 'espaceCustom', 'rows' => 5],
                'label' => 'Message :'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ContactMessageController::class,
            'user' => null,
        ]);
    }
}