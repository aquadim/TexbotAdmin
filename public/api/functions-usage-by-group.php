<?php
// Возвращает количество использований функций группой
// в формате JSON
/*
{
    "<id функции>": {
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
use TexAdmin\Entities\CollegeGroup;

#region validation
if (!(
    isset($_POST["dateStart"])
    && isset($_POST["dateEnd"])
    && isset($_POST["groupId"]))) {
    http_response_code(403);
    exit();
}
if ($_POST["dateStart"] === ""
    || $_POST["dateEnd"] === ""
    || $_POST["groupId"] === "") {
    http_response_code(403);
    exit();
}
#endregion

$em = Database::getEM();

$uf_repo = $em->getRepository(UsedFunction::class);

$start_date     = (new DateTimeImmutable($_POST["dateStart"]))->setTime(0,0,0);
$end_date       = (new DateTimeImmutable($_POST["dateEnd"]))->setTime(23,59,59);
$group      = $em->find(CollegeGroup::class, $_POST["groupId"]);

$output     = [];
$data       = $uf_repo->getStatsByGroup($start_date, $end_date, $group);

foreach ($data as $row) {
    $count = $row["cnt"];
    $fn_id = $row["fnid"];
    $used_at = $row["used_at"]->format("Y-m-d");

    if (!array_key_exists($fn_id, $output)) {
        $output[$fn_id] = [];
    }

    $output[$fn_id][$used_at] = $count;
}

echo json_encode($output);