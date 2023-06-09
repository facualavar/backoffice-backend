<?php

namespace Src\Backoffice\Application\Controllers;

use Src\Shared\Domain\IRepository;

class Controller
{
    protected $repository;

    public function __construct(IRepository $repository)
    {
        $this->repository = $repository;
    }
}