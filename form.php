<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Анкета</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 500px;
            margin: 20px auto;
            padding: 10px;
        }
        input, select, textarea {
            margin-top: 5px;
        }
        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="date"],
        select,
        textarea {
            width: 100%;
            padding: 5px;
        }
        button {
            margin-top: 10px;
            padding: 5px 15px;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <form method="POST">
        <p>
            <label>ФИО:<br>
                <input type="text" name="fio">
            </label>
        </p>
        
        <p>
            <label>Телефон:<br>
                <input type="tel" name="phone">
            </label>
        </p>
        
        <p>
            <label>Email:<br>
                <input type="email" name="email">
            </label>
        </p>
        
        <p>
            <label>Дата рождения:<br>
                <input type="date" name="brithDate" >
            </label>
        </p>
        
        <p>
            <label>Пол:<br>
                <input type="radio" name="gender" value="male" > Мужской
                <input type="radio" name="gender" value="female"> Женский
            </label>
        </p>
        
        <p>
            <label>Языки программирования:<br>
                <select name="lang_id[]" multiple >
                    <option value="1">Pascal</option>
                    <option value="2">C</option>
                    <option value="3">C++</option>
                    <option value="4">JavaScript</option>
                    <option value="5">PHP</option>
                    <option value="6">Python</option>
                    <option value="7">Java</option>
                    <option value="8">Haskel</option>
                    <option value="9">Clojure</option>
                    <option value="10">Prolog</option>
                    <option value="11">Scala</option>
                    <option value="12">Go</option>
                </select>
            </label>
            <br><small>(Зажмите Ctrl для выбора нескольких)</small>
        </p>
        
        <p>
            <label>Биография:<br>
                <textarea name="bio"></textarea>
            </label>
        </p>
        
        <p>
            <label>
                <input type="checkbox" name="contract" value="1">
                Согласен с условиями
            </label>
        </p>
        
        <p>
            <button type="submit">Отправить</button>
        </p>
    </form>
</body>
</html>