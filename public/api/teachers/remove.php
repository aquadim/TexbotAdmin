<?php
require_once '../../../bootstrap.php';
require root_dir.'/api-auth.php';

#region Валидация
if (!(
    isset($_POST["id"]))) {
    http_response_code(401);
    echo json_encode(["message" => "Не заполнено ID"]);
    exit();
}
if (!is_numeric($_POST["id"])) {
    http_response_code(400);
    echo json_encode(["message" => "ID - не число"]);
    exit();
}
#endregion

use TexAdmin\Database;
use TexAdmin\Entities\Employee;

$em = Database::getEM();
$employee = $em->find(Employee::class, $_POST["id"]);
$employee->setHidden(true);
$em->persist($employee);
$em->flush();

http_response_code(200);
exit();