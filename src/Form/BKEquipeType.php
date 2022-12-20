<?php

namespace App\Form;

use App\Entity\BKEquipe;
use App\Entity\Tag;
use App\Entity\Type;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BKEquipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $years = [];
        for ($i=1850;$i<2020;$i++) // faisable avec un simple array_fill()
        {
            $years[]=$i;
        }

        $builder
            ->add('nom')
            ->add('images')
            ->add('dateEquipe',DateType::class,[
                'widget' => 'single_text',
                'years'=> $years,
                'label' => 'Date de création de l\'équipe',

            ])
            ->add('text', CKEditorType::class, [
                'label'=>'Histore de l\'équipe'
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
            'data_class' => BKEquipe::class,
        ]);
    }
}
