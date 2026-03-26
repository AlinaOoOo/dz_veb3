<?php
// Отправляем браузеру правильную кодировку,
// файл index.php должен быть в кодировке UTF-8 без BOM.
header('Content-Type: text/html; charset=UTF-8');

// В суперглобальном массиве $_SERVER PHP сохраняет некторые заголовки запроса HTTP
// и другие сведения о клиненте и сервере, например метод текущего запроса $_SERVER['REQUEST_METHOD'].
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  // В суперглобальном массиве $_GET PHP хранит все параметры, переданные в текущем запросе через URL.
  if (!empty($_GET['save'])) {
    // Если есть параметр save, то выводим сообщение пользователю.
    print('Спасибо, результаты сохранены.');
  }
  // Включаем содержимое файла form.php.
  include('form.php');
  // Завершаем работу скрипта.
  exit();
}
// Иначе, если запрос был методом POST, т.е. нужно проверить данные и сохранить их в БД.

// Проверяем ошибки.
$errors = FALSE;

// 1. Проверка ФИО
if (empty($_POST['fio'])) {
  print('Заполните ФИО.<br/>');
  $errors = TRUE;
} else {
  // Дополнительная проверка: ФИО должно содержать только буквы, пробелы, дефис и точку
  if (!preg_match('/^[а-яА-Яa-zA-Z\s\-\.]+$/u', $_POST['fio'])) {
    print('ФИО может содержать только буквы, пробелы, дефис и точку.<br/>');
    $errors = TRUE;
  }
}

// 2. Проверка телефона
if (empty($_POST['phone'])) {
  print('Заполните номер телефона.<br/>');
  $errors = TRUE;
} else {
  // Проверка формата телефона (поддерживает +7, 8, 7 и различные разделители)
  $phone_clean = preg_replace('/[^\d+]/', '', $_POST['phone']);
  if (!preg_match('/^(\+7|8|7)\d{10}$/', $phone_clean)) {
    print('Введите корректный номер телефона (например, +7 123 456-78-90).<br/>');
    $errors = TRUE;
  }
}

// 3. Проверка email
if (empty($_POST['email'])) {
  print('Заполните email.<br/>');
  $errors = TRUE;
} else {
  if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    print('Введите корректный email адрес.<br/>');
    $errors = TRUE;
  }
}

// 4. Проверка даты рождения
if (empty($_POST['dob'])) {
  print('Заполните дату рождения.<br/>');
  $errors = TRUE;
} else {
  // Проверка формата даты и валидности
  $date = DateTime::createFromFormat('Y-m-d', $_POST['dob']);
  if (!$date || $date->format('Y-m-d') !== $_POST['dob']) {
    print('Введите корректную дату рождения.<br/>');
    $errors = TRUE;
  } else {
    // Проверка возраста (не младше 18 лет)
    $today = new DateTime();
    $birthdate = new DateTime($_POST['dob']);
    $age = $today->diff($birthdate)->y;
    if ($age < 18) {
      print('Вам должно быть не менее 18 лет.<br/>');
      $errors = TRUE;
    }
    if ($age > 120) {
      print('Пожалуйста, проверьте дату рождения.<br/>');
      $errors = TRUE;
    }
  }
}

// 5. Проверка пола
if (empty($_POST['gender'])) {
  print('Выберите пол.<br/>');
  $errors = TRUE;
} else {
  if (!in_array($_POST['gender'], ['male', 'female'])) {
    print('Некорректное значение пола.<br/>');
    $errors = TRUE;
  }
}

// 6. Проверка любимых языков программирования
$valid_langs = ['Pascal', 'C', 'C++', 'JavaScript', 'PHP', 'Python', 'Java', 'Haskel', 'Clojure', 'Prolog', 'Scala', 'Go'];
if (empty($_POST['programming_langs'])) {
  print('Выберите хотя бы один язык программирования.<br/>');
  $errors = TRUE;
} else {
  if (!is_array($_POST['programming_langs'])) {
    print('Некорректный выбор языков программирования.<br/>');
    $errors = TRUE;
  } else {
    foreach ($_POST['programming_langs'] as $lang) {
      if (!in_array($lang, $valid_langs)) {
        print('Выбран некорректный язык программирования: ' . htmlspecialchars($lang) . '.<br/>');
        $errors = TRUE;
        break;
      }
    }
  }
}

// 7. Проверка биографии (необязательное поле, но можно проверить длину)
if (!empty($_POST['bio'])) {
  if (strlen($_POST['bio']) > 5000) {
    print('Биография не должна превышать 5000 символов.<br/>');
    $errors = TRUE;
  }
  // Проверка на запрещенные теги (простая защита)
  if ($_POST['bio'] !== strip_tags($_POST['bio'])) {
    print('Биография не должна содержать HTML-теги.<br/>');
    $errors = TRUE;
  }
}

// 8. Проверка чекбокса контракта
if (empty($_POST['contract'])) {
  print('Необходимо подтвердить ознакомление с контрактом.<br/>');
  $errors = TRUE;
} else {
  if ($_POST['contract'] !== 'on') {
    print('Некорректное значение чекбокса.<br/>');
    $errors = TRUE;
  }
}

// Дополнительная защита: проверка на пустые значения (spoofing)
foreach ($_POST as $key => $value) {
  if (is_string($value) && strlen(trim($value)) > 10000) {
    print('Превышена максимальная длина поля ' . htmlspecialchars($key) . '.<br/>');
    $errors = TRUE;
  }
}

if ($errors) {
  // При наличии ошибок завершаем работу скрипта.
  print('<br/><a href="javascript:history.back()">Вернуться назад и исправить ошибки</a>');
  exit();
}

// Сохранение в базу данных.

$user = 'db'; // Заменить на ваш логин uXXXXX
$pass = '123'; // Заменить на пароль

try {
  $db = new PDO('mysql:host=localhost;dbname=test', $user, $pass,
    [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]); // Заменить test на имя БД, совпадает с логином uXXXXX
  
  // Подготовка данных для вставки
  $fio = $_POST['fio'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $dob = $_POST['dob'];
  $gender = $_POST['gender'];
  $programming_langs = implode(', ', $_POST['programming_langs']); // Преобразуем массив в строку
  $bio = !empty($_POST['bio']) ? $_POST['bio'] : '';
  $contract = $_POST['contract'] === 'on' ? 1 : 0;
  
  // Подготовленный запрос с именованными метками
  $stmt = $db->prepare("INSERT INTO application SET 
    fio = :fio,
    phone = :phone,
    email = :email,
    birth_date = :birth_date,
    gender = :gender,
    programming_langs = :programming_langs,
    bio = :bio,
    contract_agreed = :contract,
    created_at = NOW()");
  
  $stmt->execute([
    ':fio' => $fio,
    ':phone' => $phone,
    ':email' => $email,
    ':birth_date' => $dob,
    ':gender' => $gender,
    ':programming_langs' => $programming_langs,
    ':bio' => $bio,
    ':contract' => $contract
  ]);
  
} catch(PDOException $e){
  print('Ошибка базы данных: ' . $e->getMessage());
  exit();
}

// Делаем перенаправление.
// Если запись не сохраняется, но ошибок не видно, то можно закомментировать эту строку чтобы увидеть ошибку.
// Если ошибок при этом не видно, то необходимо настроить параметр display_errors для PHP.
header('Location: ?save=1');