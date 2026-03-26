<?php
// Сохраняем введенные значения для обратной подстановки
$fio_value = isset($_POST['fio']) ? htmlspecialchars($_POST['fio']) : '';
$phone_value = isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : '';
$email_value = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
$dob_value = isset($_POST['dob']) ? htmlspecialchars($_POST['dob']) : '';
$gender_value = isset($_POST['gender']) ? $_POST['gender'] : '';
$bio_value = isset($_POST['bio']) ? htmlspecialchars($_POST['bio']) : '';
$programming_langs_selected = isset($_POST['programming_langs']) ? $_POST['programming_langs'] : [];
$contract_checked = isset($_POST['contract']) && $_POST['contract'] === 'on' ? 'checked' : '';
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрационная форма</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="form-header">
            <h1>📝 Регистрационная анкета</h1>
            <p>Пожалуйста, заполните все обязательные поля</p>
        </div>
        
        <div class="form-content">
            <form method="POST" action="" novalidate>
                <!-- 1. ФИО -->
                <div class="form-group">
                    <label class="required">ФИО</label>
                    <input type="text" name="fio" value="<?= $fio_value ?>" 
                           placeholder="Иванов Иван Иванович">
                </div>
                
                <!-- 2. Телефон -->
                <div class="form-group">
                    <label class="required">Телефон</label>
                    <input type="tel" name="phone" value="<?= $phone_value ?>"
                           placeholder="+7 (999) 123-45-67">
                </div>
                
                <!-- 3. E-mail -->
                <div class="form-group">
                    <label class="required">E-mail</label>
                    <input type="email" name="email" value="<?= $email_value ?>"
                           placeholder="example@mail.ru">
                </div>
                
                <!-- 4. Дата рождения -->
                <div class="form-group">
                    <label class="required">Дата рождения</label>
                    <input type="date" name="dob" value="<?= $dob_value ?>">
                </div>
                
                <!-- 5. Пол (радиокнопки) -->
                <div class="form-group">
                    <label class="required">Пол</label>
                    <div class="radio-group">
                        <label>
                            <input type="radio" name="gender" value="male" <?= $gender_value === 'male' ? 'checked' : '' ?>> Мужской
                        </label>
                        <label>
                            <input type="radio" name="gender" value="female" <?= $gender_value === 'female' ? 'checked' : '' ?>> Женский
                        </label>
                    </div>
                </div>
                
                <!-- 6. Любимый язык программирования -->
                <div class="form-group">
                    <label class="required">Любимый язык программирования</label>
                    <select name="programming_langs[]" multiple size="6">
                        <option value="Pascal" <?= in_array('Pascal', $programming_langs_selected) ? 'selected' : '' ?>>Pascal</option>
                        <option value="C" <?= in_array('C', $programming_langs_selected) ? 'selected' : '' ?>>C</option>
                        <option value="C++" <?= in_array('C++', $programming_langs_selected) ? 'selected' : '' ?>>C++</option>
                        <option value="JavaScript" <?= in_array('JavaScript', $programming_langs_selected) ? 'selected' : '' ?>>JavaScript</option>
                        <option value="PHP" <?= in_array('PHP', $programming_langs_selected) ? 'selected' : '' ?>>PHP</option>
                        <option value="Python" <?= in_array('Python', $programming_langs_selected) ? 'selected' : '' ?>>Python</option>
                        <option value="Java" <?= in_array('Java', $programming_langs_selected) ? 'selected' : '' ?>>Java</option>
                        <option value="Haskel" <?= in_array('Haskel', $programming_langs_selected) ? 'selected' : '' ?>>Haskel</option>
                        <option value="Clojure" <?= in_array('Clojure', $programming_langs_selected) ? 'selected' : '' ?>>Clojure</option>
                        <option value="Prolog" <?= in_array('Prolog', $programming_langs_selected) ? 'selected' : '' ?>>Prolog</option>
                        <option value="Scala" <?= in_array('Scala', $programming_langs_selected) ? 'selected' : '' ?>>Scala</option>
                        <option value="Go" <?= in_array('Go', $programming_langs_selected) ? 'selected' : '' ?>>Go</option>
                    </select>
                    <small class="select-help">Удерживайте Ctrl (Cmd) для выбора нескольких</small>
                </div>
                
                <!-- 7. Биография -->
                <div class="form-group">
                    <label>Биография</label>
                    <textarea name="bio" placeholder="Расскажите немного о себе..."><?= $bio_value ?></textarea>
                </div>
                
                <!-- 8. Чекбокс контракта -->
                <div class="form-group">
                    <div class="checkbox-group">
                        <input type="checkbox" name="contract" id="contract" <?= $contract_checked ?>>
                        <label for="contract" class="required">Я ознакомлен(а) с условиями контракта</label>
                    </div>
                </div>
                
                <!-- 9. Кнопка Сохранить -->
                <button type="submit" class="btn-submit">💾 Сохранить</button>
            </form>
        </div>
    </div>
</body>
</html>