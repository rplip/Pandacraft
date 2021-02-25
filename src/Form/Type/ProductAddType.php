<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

class ProductAddType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Name', TextType::class, array(
                //'required' => 'required',
                'attr' => array(
                    'placeholder' => 'Ex : 1952 Alpine Renault 1300 '
                ),
                'label' => 'Nom'
            ))
            ->add('Line', ChoiceType::class, array(
                //'required' => 'required',
                'choices' => [
                    'Classic Cars' => 'Classic Cars',
                    'Vintage Cars' => 'Vintage Cars',
                    'Planes' => 'Planes',
                    'Ships' => 'Ships',
                    'Trains' => 'Trains',
                    'Trucks and Buses' => 'Trucks and Buses',
                    'Motorcycles' => 'Motorcycles',
                ],
                'label' => 'Catégorie'
            ))
            ->add('Scale', TextType::class, array(
                //'required' => 'required',
                'attr' => array(
                    'placeholder' => 'Ex : 1:14'
                ),
                'label' => 'Echelle'
            ))
            ->add('Vendor', TextType::class, array(
                //'required' => 'required',
                'attr' => array(
                    'placeholder' => 'Ex : Pandacraft Holding '
                ),
                'constraints' => array(
                     new Assert\Regex(array(
                        'pattern' => '/^[A-zÀ-ÿ\ \-]*$/',
                        'message' => 'The field "Vendor" is not correctly filled in'
                    )),
                ),
                'label' => 'Vendeur'
            ))
            ->add('Description', TextareaType::class, array(
               // 'required' => 'required',
                'attr' => array(
                    'placeholder' => 'Ex : Modèle ancien, roues immobiles .. '
                ),
            ))
            ->add('Stock', IntegerType::class, array(
               // 'required' => 'required',
                'attr' => array(
                    'placeholder' => 'Ex : 2185'
                ),
            ))
            ->add('BuyPrice', NumberType::class, array(
                // 'required' => 'required',
                 'attr' => array(
                     'placeholder' => 'Ex : 52.23'
                 ),
                 'label' => 'Prix d\'achat'
             ))            
            ->add('MSRP', NumberType::class, array(
                // 'required' => 'required',
                 'attr' => array(
                     'placeholder' => 'Ex : 109.99'
                 ),
                 'label' => 'Prix de vente conseillé'
             ))
            ->add('save', SubmitType::class, array(
                'label' => 'Ajouter'
            ))
        ;
    }
}

