<?php
// Класс работы с HTML компонентами

namespace TexAdmin;
use TexAdmin\Entities\Employee;

class HTML {

    // Выводит старт HTML разметки для всех страниц
    public static function start($page_title) : void {
        self::insert("html-start", ["page_title"=>$page_title]);
    }

    // Выводит конец HTML разметки для всех страниц
    public static function end() : void {
        self::insert("html-end");
    }

    // Выводит пагинацию
    public static function pagination(int $page_num, int $total, int $per_page, string $path) : void {
        self::insert(
            "pagination",
            [
                "page_num" => $page_num,
                "total" => $total,
                "per_page" => $per_page,
                "path" => $path
            ]
        );
    }

    public static function teacherForm(?Employee $e) {
        self::insert("employeeForm", ["e" => $e]);
    }
    
    // Выводит в HTML файл из /components/{name}
    public static function insert(string $name, array $view_data = []) : void {
        // root_dir устанавливается в bootstrap.php
        require root_dir . "/components/" . $name . ".php";
    }
}