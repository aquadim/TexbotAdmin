<?php
require_once '../../../bootstrap.php';
require root_dir.'/api-auth.php';

#region Валидация
if (!(
    isset($_POST["surname"]) &&
    isset($_POST["name"]) &&
    isset($_POST["patronymic"]))) {
    http_response_code(400);
    echo json_encode(["message" => "Не заполнено одно из требуемых полей"]);
    exit();
}
if ($_POST["surname"] == "" ||
    $_POST["name"] == "" ||
    $_POST["patronymic"] == "") {
    http_response_code(400);
    echo json_encode(["message" => "Не заполнено одно из требуемых полей"]);
    exit();
}
#endregion

use TexAdmin\Database;
use TexAdmin\Entities\Employee;

$em = Database::getEM();
$employee = new Employee();

$employee->setSurname($_POST["surname"]);
$employee->setName($_POST["name"]);
$employee->setPatronymic($_POST["patronymic"]);

$em->persist($employee);
$em->flush();

http_response_code(200);
echo json_encode(["nowto" => "/teachers/list.php"]);
exit();