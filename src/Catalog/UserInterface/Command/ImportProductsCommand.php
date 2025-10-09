<?php

declare(strict_types=1);

namespace App\Catalog\UserInterface\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:import-products',
    description: 'Tache à lancer pour importer les produits dans la base de données'
)]
class ImportProductsCommand extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        return Command::SUCCESS;
    }
}