<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Анкета</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            max-width: 550px;
            margin: 30px auto;
            padding: 20px;
            background: #f5f5f5;
        }
        form {
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        p {
            margin-bottom: 18px;
        }
        label {
            font-weight: 600;
            display: block;
            margin-bottom: 5px;
            color: #333;
        }
        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="date"],
        select,
        textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-family: inherit;
        }
        textarea {
            height: 80px;
            resize: vertical;
        }
        input[type="radio"] {
            width: auto;
            margin-right: 5px;
        }
        .radio-group {
            display: inline-block;
            margin-right: 15px;
            font-weight: normal;
        }
        select[multiple] {
            height: 120px;
        }
        small {
            display: block;
            margin-top: 5px;
            color: #666;
            font-size: 12px;
        }
        button {
            background: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background: #45a049;
        }
        .error {
            color: red;
            padding: 10px;
            background: #ffeeee;
            border-left: 3px solid red;
            margin-bottom: 15px;
        }
        .success {
            color: green;
            padding: 10px;
            background: #eeffee;
            border-left: 3px solid green;
            margin-bottom: 15px;
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
                <input type="date" name="brithDate">
            </label>
        </p>
        
        <p>
            <label>Пол:</label><br>
            <label class="radio-group">
                <input type="radio" name="gender" value="male"> Мужской
            </label>
            <label class="radio-group">
                <input type="radio" name="gender" value="female"> Женский
            </label>
        </p>
        
        <p>
            <label>Языки программирования:<br>
                <select name="lang_id[]" multiple>
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
            <small>(Зажмите Ctrl для выбора нескольких)</small>
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
