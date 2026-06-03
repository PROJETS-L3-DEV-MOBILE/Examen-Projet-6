<?php
namespace App\Services;

use App\Repositories\TransactionRepository;

class StatisticService
{
  public function __construct(private TransactionRepository $transactionRepository)
  {
  }

  public function getDepotDetails(\DateTime $startDate, \DateTime $endDate): array
  {
    return $this->transactionRepository->getDepotDetails($startDate, $endDate);
  }

  public function getMostActiveClients(int $limit): array
  {
    return $this->transactionRepository->getMostActiveAccount($limit);
  }

  public function getAvgSoldeByAccountType(): array
  {
    return $this->transactionRepository->getAvgSoldeByAccountType();
  }

}
