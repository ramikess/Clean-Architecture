<?php

declare(strict_types=1);

namespace App\Catalog\UserInterface\Command;

use App\Catalog\Application\UseCase\ImportProducts\ImportProductsRequest;
use App\Catalog\Application\UseCase\ImportProducts\ImportProductsUseCase;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[AsCommand(
    name: 'app:import:products',
    description: 'Importe les produits depuis DummyJSON'
)]
class ImportProductsCommand extends Command
{
    public function __construct(
        private readonly ImportProductsUseCase $importProductsUseCase,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $count = $this->importProductsUseCase->execute(
            new ImportProductsRequest(limit: 100, skip: 0)
        );

        $output->writeln(sprintf('%d produits importés.', $count));

        return Command::SUCCESS;
    }
}