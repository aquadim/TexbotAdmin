<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">Техбот</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <?php if (isset($_SESSION["allowed"]) && $_SESSION["allowed"]) { ?>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="/"><i class="fa-solid fa-house"></i> Главная</a>
        </li>
        <li class="nav-item dropdown">
          <a
            class="nav-link dropdown-toggle"
            href="#"
            id="navbarDropdown"
            role="button"
            data-bs-toggle="dropdown"
            aria-expanded="false">
            <i class="fa-solid fa-chart-simple"></i> Отчёты
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="/reports/usercount.php">Зарегистрированные пользователи</a></li>
            <li><a class="dropdown-item" href="/reports/functions-by-group.php">Использование функций Техбота (по группам)</a></li>
            <li><a class="dropdown-item" href="/reports/functions-by-fn.php">Использование функций Техбота (по видам функций)</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a
            class="nav-link dropdown-toggle"
            href="#"
            id="navbarDropdown"
            role="button"
            data-bs-toggle="dropdown"
            aria-expanded="false">
            <i class="fa-solid fa-chalkboard-user"></i> Преподаватели
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="/teachers/list.php">Список</a></li>
            <li><a class="dropdown-item" href="/teachers/new.php">Добавить</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/logout.php"><i class="fa-solid fa-right-from-bracket"></i> Выход</a>
        </li>
      </ul>
    </div>
    <?php } ?>
  </div>
</nav>