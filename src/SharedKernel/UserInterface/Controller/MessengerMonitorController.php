<?php

declare(strict_types=1);

namespace App\SharedKernel\UserInterface\Controller;

use Symfony\Component\Routing\Attribute\Route;
use Zenstruck\Messenger\Monitor\Controller\MessengerMonitorController as BaseMessengerMonitorController;

#[Route('/admin/messenger')]
final class MessengerMonitorController extends BaseMessengerMonitorController
{
}