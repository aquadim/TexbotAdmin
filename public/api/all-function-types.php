<?php
// Возвращает все типы функций из БД
// Валидация не требуется
/*
[
    {    
        "name": "Расписание",
        "id": 1
    },
    ...
]
*/
require_once '../../bootstrap.php';
require root_dir.'/api-auth.php';

use TexAdmin\Database;
use TexAdmin\Entities\TexbotFunction;

$em = Database::getEM();
$repo = $em->getRepository(TexbotFunction::class);
$data = $repo->findAll();

$output = [];
foreach ($data as $f) {
    $output[] = ["id" => $f->getId(), "name"=> $f->getName()];
}

echo json_encode($output);