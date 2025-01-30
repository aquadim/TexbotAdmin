<?php
// Общий файл инициализации

// Старт сессии
session_start();

// Полезные переменные
define('public_dir', realpath(__DIR__ . '/public'));
define('root_dir', realpath(__DIR__));

// Загрузка сторонних пакетов
require_once root_dir . '/vendor/autoload.php';

// Сбор переменных окружения (из /.env)
$dotenv = \Dotenv\Dotenv::createImmutable(root_dir);
$dotenv->load();

// Установка временной зоны (ВПМТ - Кировская область)
date_default_timezone_set('Europe/Kirov');