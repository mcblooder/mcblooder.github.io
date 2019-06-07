<?php
include("helper.php");

$variableCount = $_POST['variableCount'];
$limitationsCount = $_POST['limitationsCount'];

?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Diplom</title>
    <meta name="description" content="Diplom">
    <meta name="author" content="OKA">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<div class="main-block">
    <form action="calc.php" method="post">
        <h1>Симплексный метод решения ЗЛП</h1>
        <br>
        <p>Функция</p>
        <br>
        <div class="inputCoef">
            <p class="flexP">F=</p>
            <?php
            for ($i = 0; $i < $variableCount; ++$i) {
                html("<div>");
                html("<input autocomplete='off' name='funcCoef[" . $i . "]' type='text' />");
                html("<p>x<sub> " . ($i + 1) . " </sub></p>");
                html("</div>");
            }
            ?>
        </div>
        <br>
        <p>Ограничения</p>
        <br>
        <?php
        for ($i = 0; $i < $limitationsCount; ++$i) {
            html("<div class='inputCoef'>");
            for ($j = 0; $j < $variableCount; ++$j) {
                html("<div>");
                html("<input autocomplete='off' name='constraintCoef[" . $i . "][" . $j . "]' type='text' />");
                html("<p>x<sub> " . ($j + 1) . " </sub></p>");
                html("</div>");
            }
            html("<select name='constraint[". $i ."]'>");
            html("<option value='GOQ' >>=</option>");
            html("<option value='EQL' >=</option>");
            html("<option value='LOQ' selected><=</option>");
            html("</select>");
            html("<input autocomplete='off' class='flexInput' name='constraintVal[" . $i . "]' type='text' />");
            html("</div>");
        }
        ?>
        <br>
        <input type="submit" class="simpleButton" value="Решить">
        <input onclick="location='\\'" class="simpleButton backButton" value="Назад">
    </form>
</div>
</body>
</html>

