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

class ProductEditType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('productname', TextType::class, array(
                //'required' => 'required',
                'label' => 'Nom du produit'
            ))
            ->add('productline', ChoiceType::class, array(
                //'required' => 'required',
                'label' => 'Catégorie',
                'choices' => [
                    'Classic Cars' => 'Classic Cars',
                    'Vintage Cars' => 'Vintage Cars',
                    'Planes' => 'Planes',
                    'Ships' => 'Ships',
                    'Trains' => 'Trains',
                    'Trucks and Buses' => 'Trucks and Buses',
                    'Motorcycles' => 'Motorcycles',
                ],
            ))
            ->add('productscale', TextType::class, array(
                //'required' => 'required',
                'label' => 'Echelle'
            ))
            ->add('productvendor', TextType::class, array(
                //'required' => 'required',
                'label' => 'Nom du vendeur',
                'constraints' => array(
                     new Assert\Regex(array(
                        'pattern' => '/^[A-zÀ-ÿ\ \-]*$/',
                        'message' => 'The field "Vendor" is not correctly filled in'
                    )),
                )
            ))
            ->add('productdescription', TextareaType::class, array(
               // 'required' => 'required',
               'label' => 'Description'
            ))
            ->add('quantityinstock', IntegerType::class, array(
               // 'required' => 'required',
               'label' => 'Stock'
            ))
            ->add('buyprice', NumberType::class, array(
                // 'required' => 'required',
                'label' => 'prix d\'achat '
             ))            
            ->add('msrp', NumberType::class, array(
                // 'required' => 'required',
                'label' => 'Prix de vente conseillé'
             ))
            ->add('save', SubmitType::class, array(
                'label' => 'Valider',
            ))
        ;
    }
}