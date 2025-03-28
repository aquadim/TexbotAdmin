<?php
// Возвращает количество использований конкретной функции
// в формате JSON
/*
{
    "<id группы>": {
        "2024-10-31": 108,
        "2024-11-01": 21,
        "...": 150,
    },
    "...": {
        ...
    },
    ...
*/
require_once '../../bootstrap.php';
require root_dir."/auth.php";

use TexAdmin\Database;
use TexAdmin\Entities\UsedFunction;
use TexAdmin\Entities\TexbotFunction;

#region validation
if (!(
    isset($_POST["dateStart"])
    && isset($_POST["dateEnd"])
    && isset($_POST["functionTypeId"]))) {
    http_response_code(403);
    exit();
}
if ($_POST["dateStart"] === ""
    || $_POST["dateEnd"] === ""
    || $_POST["functionTypeId"] === "") {
    http_response_code(403);
    exit();
}
#endregion

// Получение данных
$em = Database::getEM();

$uf_repo = $em->getRepository(UsedFunction::class);

$start_date     = (new DateTimeImmutable($_POST["dateStart"]))->setTime(0,0,0);
$end_date       = (new DateTimeImmutable($_POST["dateEnd"]))->setTime(23,59,59);
$function_type  = $em->find(TexbotFunction::class, $_POST["functionTypeId"]);

$output     = [];
$data       = $uf_repo->getStatsByFunction($start_date, $end_date, $function_type);

// Сборка JSON
foreach ($data as $row) {
    $count      = $row["cnt"];
    $gr_id      = $row["grid"];
    $used_at    = $row["used_at"]->format("Y-m-d");

    if (!array_key_exists($gr_id, $output)) {
        $output[$gr_id] = [];
    }

    $output[$gr_id][$used_at] = $count;
}

echo json_encode($output);