#!/usr/bin/env php
<?php
// Скрипт консольного взаимодействия с Doctrine
// https://www.doctrine-project.org/

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;
use TexAdmin\Database;

require "bootstrap.php";

$em = Database::getEM();
ConsoleRunner::run(
    new SingleManagerProvider($em)
);