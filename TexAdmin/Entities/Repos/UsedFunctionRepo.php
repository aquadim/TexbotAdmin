<?php
namespace TexAdmin\Entities\Repos;

use Doctrine\ORM\EntityRepository;
use TexAdmin\Entities\UsedFunction as UF;
use TexAdmin\Entities\CollegeGroup;
use TexAdmin\Enums\FunctionNames;
use TexAdmin\Entities\TexbotFunction;
use TexAdmin\Exceptions\DatabaseException;
use DateTimeImmutable;

class UsedFunctionRepo extends EntityRepository {

    // Возвращает статистику использования функций по конкретной группе
    public function getStatsByGroup(
        DateTimeImmutable $start,
        DateTimeImmutable $end,
        CollegeGroup $group
    ) {
        $dql =
        "SELECT COUNT(uf.id) AS cnt, fn.id AS fnid, uf.used_at " .
        "FROM " . UF::class . " uf ".
        "JOIN uf.fn fn " .
        "WHERE uf.used_at BETWEEN :start AND :end " .
        "AND uf.caller_group = :callerGroup " .
        "GROUP BY uf.used_at, fn.id";

        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameters([
            'start' => $start,
            'end' => $end,
            'callerGroup' => $group
        ]);
        return $query->getResult();
    }

    // Возвращает статистику использования функций по конкретному виду функции
    public function getStatsByFunction(
        DateTimeImmutable $start,
        DateTimeImmutable $end,
        TexbotFunction $func
    ) {
        $dql =
        "SELECT COUNT(uf.id) AS cnt, gr.id AS grid, uf.used_at " .
        "FROM " . UF::class . " uf ".
        "JOIN uf.caller_group gr " .
        "WHERE uf.used_at BETWEEN :start AND :end " .
        "AND uf.fn = :function " .
        "GROUP BY uf.used_at, gr.id";

        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameters([
            'start' => $start,
            'end' => $end,
            'function' => $func
        ]);
        return $query->getResult();
    }

    // Добавляет запись статистики для заданной группы.
    public function addStat(
        FunctionNames $function_type,
        CollegeGroup $called_for
    ) {
        $em = $this->getEntityManager();
        $tb_repo = $em->getRepository(TexbotFunction::class);

        // 1. Поиск функции по наименованию
        $function_name = $function_type->value;
        $func = $tb_repo->findOneBy(["name" => $function_name]);
        if ($func == null) {
            throw new DatabaseException("При создании записи статистики не найдена функция $function_name");
            return;
        }
        
        $stat = new UF();
        $stat->setFunction($func);
        $stat->setUsedAt(new DateTimeImmutable("now"));
        $stat->setCallerGroup($called_for);

        $em->persist($stat);
        $em->flush();
    }
}
