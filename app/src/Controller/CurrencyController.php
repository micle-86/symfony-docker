<?php

namespace App\Controller;

use App\Entity\Currency;
use App\Repository\CurrencyRepository;
use App\Service\DailyCurrency;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
   * @return Response
   * @Route("/currency", name="currency", methods={"GET"})
   */
  public function getCurrency(CurrencyRepository $CurrencyRepository): Response
  {
    $data = $CurrencyRepository->findAll();
    return $this->response($data);
  }

  /**
   * @param EntityManagerInterface $entityManager
   * @param CurrencyRepository $currencyRepository
   * @param DailyCurrency $dailyCurrency
   * @return Response
   * @Route("/currency_parse", name="currency_add", methods={"GET"})
   */
  public function addCurrency(EntityManagerInterface $entityManager, CurrencyRepository $currencyRepository, DailyCurrency $dailyCurrency): Response
  {
    try {
      $dailyCurrency->setUrl($_SERVER['CURRENCY_URL']);
      foreach ($dailyCurrency->getCurrency() as $currency) {
        $this->addToDb($entityManager, $currencyRepository, $currency);
      }
    } catch (\Exception $e) {
      return $this->response(['errors' => 'Data no valid'], 422);
    }
    return $this->response(['success' => 'Post added successfully']);
  }

  /**
   * @param EntityManagerInterface $entityManager
   * @param CurrencyRepository $currencyRepository
   * @param Currency $currency
   * @return void
   */
  private function addToDb(EntityManagerInterface $entityManager, CurrencyRepository $currencyRepository, Currency $currency): void
  {
    $currencyInDb = $currencyRepository->findOneBy(['name' => $currency->getName()]);
    if (!$currencyInDb) {
      $entityManager->persist($currency);
    } else {
      $currencyInDb->setRate($currency->getRate());
    }
    $entityManager->flush();
  }

  /**
   * Returns a JSON response
   *
   * @param array $data
   * @param int $status
   * @return Response
   */
  private function response(array $data, int $status = 200): Response
  {
    $serializer = $this->container->get('serializer');
    $reports = $serializer->serialize($data, 'json');
    return new Response($reports, $status);
  }

}