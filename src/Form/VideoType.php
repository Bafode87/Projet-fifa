<?php

namespace App\Form;

use App\Entity\Tag;
use App\Entity\Type;
use App\Entity\Video;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VideoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Titre')
            ->add('lien')
            ->add('postedat',DateType::class,[
                'widget' => 'single_text',])
            ->add('author')
            ->add('description', CKEditorType::class,[
            'label'=>'Description de la vidéo'
                ])
            ->add('tags', EntityType::class,[
                'class' => Tag::class,
                'choice_label' => function (Tag $tag) {
                    return $tag->getNom();
                },
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('type', EntityType::class,[
                'class' => Type::class,
                'choice_label' => function (Type $type) {
                    return $type->getNom();
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Video::class,
        ]);
    }
}
