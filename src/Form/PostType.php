<?php

namespace App\Form;

use App\Entity\Post;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormEvent;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title',TextType::class,[
                'attr'=>[
                    "placeholder"=>"title name",
                    "class"=>""
                ]
            ])
            ->add('info',TextareaType::class)
            ->add('category',EntityType::class,[
                "class"=>"App\Entity\Category",

            ])
            ->add("file",FileType::class,[
                "mapped"=>false ,
                "label"=>"Upload image post",
                'multiple' => true,
                'attr'=>[
                    "accept"=>"image/x-png,image/gif,image/jpeg",
                ]
           
                
            ])
            ->add("save",SubmitType::class,[
                'attr'=>[
                    "class"=>"btn btn-success"
                ]
            ]);
        // $builder->get("category")->addEventListener(
        //     FormEvents::POST_SUBMIT,
        //     function(FormEvent $event){
        //         $form=$event->getForm();
        //         $form->add("SubCategory",EntityType::class,[
        //             "class"=>"App\Entity\SubCategory",
        //             "placeholder"=>"Please select sub category",
        //             "chocies"=> $form->getData()->getSubCategories() // chocies => Options
        //         ]);
        //     }
        // );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
