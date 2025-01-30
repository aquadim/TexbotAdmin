<?php
// /teachers/list.php?page=2
$total_pages = ceil($view_data["total"] / $view_data["per_page"]);

// Назад
$back_disabled = $view_data["page_num"] == 1;
if (!$back_disabled) {
  $back_url = "/" . $view_data["path"] . "/list.php?page=" . ($view_data["page_num"] - 1);
  $back_class = "page-item";
} else {
  $back_url = "#";
  $back_class = "page-item disabled";
}

// Дальше
$next_disabled = $view_data["page_num"] == $total_pages;
if (!$next_disabled) {
  $next_url = "/" . $view_data["path"] . "/list.php?page=" . ($view_data["page_num"] + 1);
  $next_class = "page-item";
} else {
  $next_url = "#";
  $next_class = "page-item disabled";
}

// Страницы
$buttons = [];
for ($i = $view_data["page_num"] - 2; $i < $view_data["page_num"] + 3; $i++) {
  if ($i <= 0 || $i > $total_pages) {
    continue;
  }
  $buttons[] = [
    "url" => "/" . $view_data["path"] . "/list.php?page=" . $i,
    "class" => $view_data["page_num"] == $i ? "page-item active" : "page-item",
    "num" => $i
  ];
}
?>

<div class="m-3 d-flex justify-content-center">
  <nav>
    <ul class="pagination">

      <li class="<?= $back_class ?>">
        <a href="<?= $back_url ?>" class="page-link">Назад</a>
      </li>

      <?php foreach ($buttons as $btn) { ?>
        <li class="<?= $btn["class"] ?>">
          <a class="page-link" href="<?= $btn["url"] ?>"><?= $btn["num"] ?></a>
        </li>
      <?php } ?>

      <li class="<?= $next_class ?>">
        <a href="<?= $next_url ?>" class="page-link">Дальше</a>
      </li>
      
    </ul>
  </nav>
</div>