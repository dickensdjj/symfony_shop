<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\Entity\Product;
use Symfony\Component\Serializer\SerializerInterface;

class ProductCrudController extends AbstractController
{
    // Testing Purpose
    public function hello(): JsonResponse {
        $response = new JsonResponse();
        $response->headers->set('Content-Type', 'application/json');
        $response->setData(['hello' => 'world']);
        return $response;
    }

    // Testing Purpose
    public function phpinfo(Request $request) {
        return phpinfo();
    }

    /**
     * New Product Api
     * Associate with URL /api/v1/product in routes.yaml
     * @param Request $request
     * @param ValidatorInterface $validator
     * @return JsonResponse
     */
    public function create(Request $request, ValidatorInterface $validator): JsonResponse
    {
        $response = new JsonResponse();
        $response->headers->set('Content-Type', 'application/json');
        $responsePayload = [
            'success' => '',
            'payload' => [],
            'error' => []
        ];

        try {
            $body = $request->getContent();

            // Validate if the request contains header 'Content_Type'
            if ( false === strpos($request->headers->get('Content_type'), 'application/json')) {
                $responsePayload['success'] = false;
                $responsePayload['error'] = 'Request header does not have application/json';
                return $response->setData($responsePayload);
            }

            $entityManager = $this->getDoctrine()->getManager();

            // Validate if the request body are empty
            if (!$body) {
                $responsePayload['success'] = false;
                $responsePayload['error'] = ['No params provided'];
                return $response->setData($responsePayload);
            }

            $params = json_decode($body, true);
            $now = new \DateTime();
            // New a doctrine object and set the corresponding attributes from post request
            $newProduct = new Product();
            $newProduct->setSku($params['sku'])
                ->setName($params['name'])
                ->setPrice((int)$params['price'])
                ->setDescription($params['description'])
                ->setHotsale($params['hotsale'])
                ->setFeatured($params['feature'])
                ->setCreatedAt($now);

            // Validate the doctrine object if it contains correct attributes set
            // Constraints are defined in config/validator/validation.yaml
            $errors = $validator->validate($newProduct);
            if(count($errors) > 0) {
                foreach($errors as $error) {
                    array_push($responsePayload['error'], $error->getMessage());
                }

                $responsePayload['success'] = false;

                return $response->setData($responsePayload);
            } else {
                $entityManager->persist($newProduct);
                $entityManager->flush();

                // retrieve product to check if it is saved successfull
                // TODO: finLastInserted fn is not fully implemented, need to further update.
                /** @var  $product */
//                $product = $this->getDoctrine()->getRepository(Product::class)->findLastInserted();
//                if ($product) {
//                    $responsePayload['payload'] = [
//                        'name' => $product->getName(),
//                        'sku' => $product->getSku(),
//                        'description' => $product->getDescription(),
//                        'price' => $product->getPrice(),
//                        'feature' => $product->getFeatured(),
//                        'hotsale' => $product->getHotsale()
//                    ];
//                    $responsePayload['success'] = true;
//                    return $response->setData($responsePayload);
//                } else {
//                    $responsePayload['success'] = false;
//                    $responsePayload['error'] = 'Unexpected error while retrieving the just saved product';
//                }
                $responsePayload['success'] = true;
                return $response->setData($responsePayload);
            }
        } catch (\Exception $e) {
            $responsePayload['success'] = false;
            $responsePayload['error'] = $e->getMessage();
            return $response->setData($responsePayload);
        }
    }

    public function update(): JsonResponse
    {
        // TODO: update
    }

    public function get_product(): JsonResponse
    {
        // TODO: get
    }

    public function get_products(): JsonResponse
    {
        // TODO: get all
    }

    public function delete(): JsonResponse
    {
        // TODO: delete
    }
}