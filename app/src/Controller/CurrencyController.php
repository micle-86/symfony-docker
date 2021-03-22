<?php

namespace App\Controller;

use App\Entity\Currency;
use App\Repository\CurrencyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CurrencyController
 * @package App\Controller
 * @Route("/api", name="currency_api")
 */
class CurrencyController extends AbstractController
{
  /**
   * @param CurrencyRepository $CurrencyRepository
   * @return JsonResponse
   * @Route("/currency", name="currency", methods={"GET"})
   */
  public function getCurrency(CurrencyRepository $CurrencyRepository): JsonResponse
  {
    $data = $CurrencyRepository->findAll();
    return $this->response($data);
  }
//
//  /**
//   * @param Request $request
//   * @param EntityManagerInterface $entityManager
//   * @param CurrencyRepository $CurrencyRepository
//   * @return JsonResponse
//   * @throws \Exception
//   * @Route("/posts", name="posts_add", methods={"POST"})
//   */
//  public function addCurrency(Request $request, EntityManagerInterface $entityManager, CurrencyRepository $CurrencyRepository)
//  {
//
//    try {
//      $request = $this->transformJsonBody($request);
//
//      if (!$request
//          || !$request->get('id_base')
//          || !$request->request->get('name')
//          || !$request->request->get('rate')
//      ) {
//        throw new \Exception();
//      }
//
//      $post = new Post();
//      $post->setName($request->get('name'));
//      $post->setDescription($request->get('description'));
//      $entityManager->persist($post);
//      $entityManager->flush();
//
//      $data = [
//        'status' => 200,
//        'success' => "Post added successfully",
//      ];
//      return $this->response($data);
//
//    } catch (\Exception $e) {
//      $data = [
//        'status' => 422,
//        'errors' => "Data no valid",
//      ];
//      return $this->response($data, 422);
//    }
//
//  }
//
//  /**
//   * @param CurrencyRepository $CurrencyRepository
//   * @param $id
//   * @return JsonResponse
//   * @Route("/posts/{id}", name="posts_get", methods={"GET"})
//   */
//  public function getPost(CurrencyRepository $CurrencyRepository, $id)
//  {
//    $post = $CurrencyRepository->find($id);
//
//    if (!$post) {
//      $data = [
//        'status' => 404,
//        'errors' => "Post not found",
//      ];
//      return $this->response($data, 404);
//    }
//    return $this->response($post);
//  }
//
//  /**
//   * @param Request $request
//   * @param EntityManagerInterface $entityManager
//   * @param CurrencyRepository $CurrencyRepository
//   * @param $id
//   * @return JsonResponse
//   * @Route("/posts/{id}", name="posts_put", methods={"PUT"})
//   */
//  public function updatePost(Request $request, EntityManagerInterface $entityManager, CurrencyRepository $CurrencyRepository, $id)
//  {
//
//    try {
//      $post = $CurrencyRepository->find($id);
//
//      if (!$post) {
//        $data = [
//          'status' => 404,
//          'errors' => "Post not found",
//        ];
//        return $this->response($data, 404);
//      }
//
//      $request = $this->transformJsonBody($request);
//
//      if (!$request || !$request->get('name') || !$request->request->get('description')) {
//        throw new \Exception();
//      }
//
//      $post->setName($request->get('name'));
//      $post->setDescription($request->get('description'));
//      $entityManager->flush();
//
//      $data = [
//        'status' => 200,
//        'errors' => "Post updated successfully",
//      ];
//      return $this->response($data);
//
//    } catch (\Exception $e) {
//      $data = [
//        'status' => 422,
//        'errors' => "Data no valid",
//      ];
//      return $this->response($data, 422);
//    }
//
//  }
//
//  /**
//   * @param CurrencyRepository $CurrencyRepository
//   * @param $id
//   * @return JsonResponse
//   * @Route("/posts/{id}", name="posts_delete", methods={"DELETE"})
//   */
//  public function deletePost(EntityManagerInterface $entityManager, CurrencyRepository $CurrencyRepository, $id)
//  {
//    $post = $CurrencyRepository->find($id);
//
//    if (!$post) {
//      $data = [
//        'status' => 404,
//        'errors' => "Post not found",
//      ];
//      return $this->response($data, 404);
//    }
//
//    $entityManager->remove($post);
//    $entityManager->flush();
//    $data = [
//      'status' => 200,
//      'errors' => "Post deleted successfully",
//    ];
//    return $this->response($data);
//  }
//
//  protected function transformJsonBody(Request $request)
//  {
//    $data = json_decode($request->getContent(), true);
//
//    if ($data === null) {
//      return $request;
//    }
//
//    $request->request->replace($data);
//
//    return $request;
//  }

  /**
   * Returns a JSON response
   *
   * @param array $data
   * @param $status
   * @param array $headers
   * @return JsonResponse
   */
  public function response($data, $status = 200, $headers = []): JsonResponse
  {
    return new JsonResponse($data, $status, $headers);
  }

}