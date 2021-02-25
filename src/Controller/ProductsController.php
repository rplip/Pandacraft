<?php

namespace App\Controller;

use App\Entity\Products;
use App\Form\Type\ProductAddType;
use App\Form\Type\ProductEditType;
use App\Repository\ProductsRepository;
use App\Repository\ProductlinesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Annotation\Groups;

class ProductsController extends AbstractController
{
    /**
     * Affichage liste des produits
     * @Route("/products/list", name="productsList", methods={"GET"})
     */
    public function list(ProductsRepository $productsRepository,Request $request, SerializerInterface $serializer): Response
    {

        $products = $productsRepository->findAll();
        $data = $serializer->normalize($products, null, ['groups' => 'group1']);

        $delete = false;
        $getParams = $request->query->all();
        if (array_key_exists('delete', $getParams)) {
            $delete = true;
        }
        

        return $this->render('products/list.html.twig', array(
            'datas' => $data,
            'delete' => $delete,
        ));
    }

    /**
     * Ajout d'un produit
     * @Route("/products/add", name="productAdd")
     */
    public function add(ProductlinesRepository $plr, Request $request) {
        $form = $this->createForm(ProductAddType::class);
        $success = false;
    
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $success = true;

            // On cherche la catégorie du produit dans la collection
            $selectedProductLine = $data["Line"];
            $productLine = $plr->findByName($selectedProductLine);

            //On genere un nombre aleatoire
            $random = random_int(10000, 99999);
            $code = "S99_"."$random";

            $em = $this->getDoctrine()->getManager();

            $product = new Products;
            $product->setProductcode($code);
            $product->setProductname($data["Name"]);
            $product->setProductscale($data["Scale"]);
            $product->setProductline($productLine);
            $product->setProductvendor($data["Vendor"]);
            $product->setProductdescription($data["Description"]);
            $product->setQuantityinstock($data["Stock"]);
            $product->setBuyprice($data["BuyPrice"]);
            $product->setMsrp($data["MSRP"]);

            $em->persist($product);
            $em->flush();
    
            $form = $this->createForm(ProductAddType::class);
    
            return $this->render('products/add.html.twig', array(
                'form' => $form->createView(),
                'success' => $success
            ));
        } else if ($form->isSubmitted() && !$form->isValid()) {
            return $this->render('products/add.html.twig', array(
                'form' => $form->createView(),
                'success' => $success
            ), new Response('', 400));
        }
    
        return $this->render('products/add.html.twig', array(
            'form' => $form->createView(),
            'success' => $success
        ));
    }


    /* Précision :
                    Les routes comportant un {id} sont placées après
                    sinon elle interceptent les demandes
                    (exemple le /products/add, "add" passe pour un id)
    */


    /**
     * Affichage d'un produit
     * @Route("/products/{id}", name="productItem", methods={"GET"})
     */
    public function item(string $id, ProductsRepository $pr,Request $request, SerializerInterface $serializer)
    {

        $product = $pr->find($id);

        $form = $this->createForm(ProductEditType::class, $product, array(
            'action' => '/products/'.$id.'/update',
            'method' => 'PUT'
        ));

        return $this->render('products/item.html.twig', array(
            'product' => $product,
            'id' => $id,
            'form' => $form->createView(),
            'edit' => false,
        ));
    }

    /**
     * Supression d'un produit
     * @Route("/products/{id}/delete", name="productItemDelete")
     */
    public function delete(string $id, Request $request, SerializerInterface $serializer, ProductsRepository $pr)
    {
        //Suppression d'un produit
        $product = $pr->find($id);

        $em = $this->getDoctrine()->getManager();

        if (!$product) {
            throw $this->createNotFoundException('No product found for id '.$id);
        }
        
        $em->remove($product);
        $em->flush();

        return $this->redirectToRoute('productsList', array(
            'delete' => true,
        ));
      
    }

    /**
     * Modification d'un produit
     * @Route("/products/{id}/update", name="productItemUpdate")
     */
    public function update(string $id, ProductsRepository $pr,ProductlinesRepository $plr, Request $request)
    {
        $data = $request->request->get('product_edit');

        $selectedProductLine = $data["productline"];
        $productLine = $plr->findByName($selectedProductLine);
            
            $em = $this->getDoctrine()->getManager();

            $product = $pr->find($id);
            $product->setProductname($data['productname']);
            $product->setProductscale($data['productscale']);
            $product->setProductline($productLine);
            $product->setProductvendor($data['productvendor']);
            $product->setProductdescription($data['productdescription']);
            $product->setQuantityinstock($data['quantityinstock']);
            $product->setBuyprice($data["buyprice"]);
            $product->setMsrp($data["msrp"]);

            $em->persist($product);
            $em->flush();
            

        $form = $this->createForm(ProductEditType::class, $product, array(
            'action' => '/products/'.$id.'/update',
            'method' => 'PUT'
        ));

        return $this->render('products/item.html.twig', array(
            'product' => $product,
            'id' => $id,
            'form' => $form->createView(),
            'edit' => true,
        ));
    }
    
}
