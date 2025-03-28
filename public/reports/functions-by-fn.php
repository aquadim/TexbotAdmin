<?php
// Страница отчёта статистики использования функций по видам функций
require_once '../../bootstrap.php';
require root_dir."/auth.php";

use TexAdmin\HTML;
HTML::start("Использование функций (по видам функций)");
HTML::insert("navbar");
?>

<div class="container p-3">
    <h1>Статистика использования функций (по видам функций)</h1>
    <p>Сколько раз студенты использовали функции за определённый период.</p>

    <!--Параметры-->
    <form id="settings">
        <div class="row">
            <div class="col">
                <label for="dateStart" class="form-label"><i class="fa-solid fa-calendar-days"></i> Начало периода</label>
                <input type="date" name="dateStart" class="form-control" id="dateStart" required="required">
            </div>
            <div class="col">
                <label for="dateEnd" class="form-label"><i class="fa-solid fa-calendar-days"></i> Конец периода</label>
                <input type="date" name="dateEnd" class="form-control" id="dateEnd" required="required">
            </div>
            <div class="col">
                <label for="functionTypeId" class="form-label"><i class="fa-solid fa-users"></i> Вид функции</label>
                <select name="functionTypeId" class="form-select" id="functionTypeId" required="required"></select>
            </div>
        </div>
        <div class="row mt-3">
            <button class="btn btn-primary">Сформировать</button>
        </div>
    </form>

    <!--Область данных-->
    <div id="dataArea" class="mt-3"></div>
</div>

<script src="/plotly/plotly-2.35.2.min.js"></script>
<script src="/plotly/plotly-locale-ru-latest.js"></script>
<script src="js/functions-by-fn.js"></script>

<?php HTML::end(); ?>