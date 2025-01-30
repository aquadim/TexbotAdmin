<?php
// Класс работы с постраничным отображением

namespace TexAdmin;
use TexAdmin\Database;
use Doctrine\ORM\Tools\Pagination\Paginator;

class Pagination {

    // Возвращает список данных на странице
    public static function getItems($dql, $per_page) {
        $em = Database::getEm();
        $q = $em->createQuery($dql)
            ->setFirstResult(self::getFirstResult($per_page))
            ->setMaxResults($per_page);
        return new Paginator($q);
    }

    // Возвращает номер страницы из GET параметра
    public static function getPageNumber() : int {
        if (!isset($_GET["page"])) {
            return 1;
        }
        if (!is_numeric($_GET["page"])) {
            return 1;
        }
        return intval($_GET["page"]);
    }

    // Возвращает число - которое должно установиться в $paginator страницы
    // $on_page - сколько элементов на странице
    public static function getFirstResult($on_page) : int {
        $page_num = self::getPageNumber();
        return ($page_num - 1) * $on_page;
    }
}