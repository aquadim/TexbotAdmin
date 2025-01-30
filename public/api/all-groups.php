<?php
// Возвращает все группы из БД
// Валидация не требуется
/*
[
    {
        "id": <int>,
        "name": <string>
    },
    ...
]
*/
require_once '../../bootstrap.php';
require root_dir.'/api-auth.php';

use TexAdmin\Database;
use TexAdmin\Entities\CollegeGroup;

$em = Database::getEM();
$repo = $em->getRepository(CollegeGroup::class);
$data = $repo->findAll();

$output = [];
foreach ($data as $g) {
    $output[] = ["id" => $g->getId(), "name"=> $g->getHumanName()];
}

echo json_encode($output);