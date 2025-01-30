<?php

namespace TexAdmin\Entities\Repos;

use Doctrine\ORM\EntityRepository;
use TexAdmin\Entities\Schedule;
use TexAdmin\Entities\Pair;
use TexAdmin\Entities\Employee;
use TexAdmin\Entities\PairConductionDetail;
use TexAdmin\Entities\Place;

class PairRepo extends EntityRepository {

    // Возвращает пары расписания
    public function getPairsOfScheduleForGroup(Schedule $schedule) {
        $em = $this->getEntityManager();

        $query = $em->createQuery(
        'SELECT p, pn, cd FROM '.Pair::class.' p '.
        'JOIN p.pair_name pn '.
        'JOIN p.conduction_details cd '.
        'WHERE p.schedule=:schedule '
        );

        $query->setParameters(['schedule'=>$schedule]);

        return $query->getResult();
    }

    // Ищет пары преподавателя на заданный день
    // $e - сущность сотрудника
    // $date - дата в формате ГГГГ-ММ-ДД
    public function getPairsOfTeacher(Employee $e, $date) {
        $em = $this->getEntityManager();

        // Выбираются все детали проведения
        // из пар, которые связаны с расписанием на заданный день,
        // которое было создано позднее всех (самое актуальное)
        $query = $em->createQuery(
        'SELECT pcd, p, pn, s, g '.
        'FROM '.PairConductionDetail::class.' pcd '.
        'JOIN pcd.pair p '.
        'JOIN p.pair_name pn '.
        'JOIN p.schedule s '.
        'JOIN s.college_group g '.
        'WHERE s.day=:date '.
        'AND pcd.employee=:employee '.
        'AND s.created_at = ('.
            'SELECT MAX(schedule.created_at) '.
            'FROM '.Schedule::class.' schedule)'.
        'ORDER BY p.time '
        );

        $query->setParameters([
            'employee'=>$e,
            'date'=>$date
        ]);

        return $query->getResult();
    }

    // Ищет пары, связанные с местом на заданный день
    public function getPairsForPlace(Place $p, $date) {
        $em = $this->getEntityManager();

        $query = $em->createQuery(
        'SELECT pcd, p, pn, e, s, g '.
        'FROM '.PairConductionDetail::class.' pcd '.
        'JOIN pcd.pair p '.
        'JOIN pcd.employee e '.
        'JOIN p.pair_name pn '.
        'JOIN p.schedule s '.
        'JOIN s.college_group g '.
        'WHERE s.day=:date '.
        'AND pcd.place=:place '.
        'ORDER BY p.time '.
        'GROUP BY s.id '.
        'HAVING MAX(s.created_at)'
        );

        $query->setParameters([
            'place'=>$p,
            'date'=>$date
        ]);

        return $query->getResult();
    }
}
