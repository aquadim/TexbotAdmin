<?php
// Возвращает количество зарегистрированных студентов в разрезе групп
// в формате JSON
// [{
//      "group_id": <int>,
//      "group_name": <str>,
//      "vk.com": <int>
//      "telegram.org": <int>
// }, {...}, {...}]
require_once '../../bootstrap.php';
require root_dir."/auth.php";

use TexAdmin\Database;
use TexAdmin\Entities\Student;
use TexAdmin\Entities\User;
use TexAdmin\Entities\CollegeGroup;
use TexAdmin\Entities\CollegeSpec;
use TexAdmin\Entities\Platform;

$em = Database::getEM();

// Получение всех групп
$cg_repo = $em->getRepository(CollegeGroup::class);
$all_groups = $cg_repo->findAll();
$group_id_to_name = [];
foreach ($all_groups as $g) {
    $group_id_to_name[$g->getId()] = $g->getHumanName();
}

// Обычно при JOIN не нужно указывать поля вручную, т.к. Doctrine знает
// поля по которым соединяются сущности... НО ПОЧЕМУ ТО ОНО НЕ ХОЧЕТ РАБОТАТЬ
// поэтому я указал WITH
$q = $em->createQuery(
"SELECT COUNT(st.id) AS studentCount, cg.id AS collegeGroupId, pl.domain AS platformName".
" FROM ". CollegeGroup::class . " cg".
" LEFT JOIN " . Student::class . " st WITH st.group = cg".
" LEFT JOIN " . User::class . " us WITH us.id=st.user".
" INNER JOIN " . Platform::class . " pl WITH pl.id=us.platform".
" GROUP BY cg.id, pl.id");
$result = $q->execute();

// ["4ИС": ["vk.com": 10, "telegram.org": 15]]
$counts = [];

// Заполняем нулевыми значениями все группы
foreach ($group_id_to_name as $group_id => $group_name) {
    $counts[$group_id] = ["vk.com" => 0, "telegram.org" => 0];
}

// Изменяем значения данными из БД
foreach ($result as $row) {
    $group_id = $row['collegeGroupId'];
    $platform_name = $row['platformName'];
    $counts[$group_id][$platform_name] = $row['studentCount'];
}

$output = [];
foreach ($counts as $group_id => $data) {
    $group_name = $group_id_to_name[$group_id];
    $out_row = [
        "group_name" => $group_name,
        "vk.com" => $data["vk.com"],
        "telegram.org" => $data["telegram.org"]
    ];
    $output[] = $out_row;
}
echo json_encode($output);