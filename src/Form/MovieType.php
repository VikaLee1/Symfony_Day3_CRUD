<?php

// this code is from the symfony documentation-building forms
namespace App\Form;

use App\Entity\Name;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

// the name of the class should match the file name
class MovieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, 
            ["attr"=>["placeholder"=>"type the name of the movie", "class"=>"form-control mb-2"]])
            ->add('description', TextareaType::class,
            ["attr"=>["placeholder"=>"type the short description of the movie", "class"=>"form-control mb-2"]])
            ->add('category', ChoiceType::class,[
                'choices'  => [
                    'movie' => "movie",
                    'series' => "series",
                    'documentary' => "documentary",
                ],
            ])
            ->add('release_date', DateTimeType::class,
            ["attr"=>["class"=>"form-control mb-2"]])
            ->add('genre', TextType::class,
            ["attr"=>["placeholder"=>"type the name of the movie", "class"=>"form-control mb-2"]])
            ->add('picture', TextType::class,
            ["attr"=>["placeholder"=>"add an image", "class"=>"form-control mb-2"]])
            ->add('create', SubmitType::class, ["attr"=>[ "class"=>"btn btn-primary mb-2"]])
        ;
    }



// the function is taken from the documentation
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Name::class,
        ]);
    }

}