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
<div class="main-block textCentered">
<?php
include("helper.php");

/*
 * Это то, что прилетает в этот скрипт с другой страницы
 * Со страницы ввода данных.
 */
//Коэффициенты функций
$funcCoef = $_POST["funcCoef"];
//Коэффициенты ограничений
$constraintCoef = $_POST["constraintCoef"];
//Тип ограничения (<= - LOQ, = - EQL, >= - GOQ)
$constraint = $_POST["constraint"];
//Значения ограничения
$constraintVal = $_POST["constraintVal"];

//Количество ограничений
$constraintCount = count($constraintCoef);

//Количество строк симплекс таблицы
// = количество ограничений + 1
$arrRows = $constraintCount + 1;

//Количество столбцов симплекс таблицы
// = количество переменных + количество ограничений + 2
$arrCols = count($funcCoef) + $constraintCount + 2;

//Массив с дополнительными столбцами
$slackArray = array();

for ($i = 0; $i < $constraintCount; ++$i) {
    $newLine = array();
    //Добавляем столбцы для ограничений
    for ($e = 0; $e < $constraintCount; ++$e) {
        array_push($newLine, $e == $i ? 1 : 0);
    }
    //Добавляем столбец для P
    array_push($newLine, 0);
    //Добавляем последний столбец со значением ограничения
    array_push($newLine, $constraintVal[$i]);
    //Соединяем вместе коэффициенты ограничений и получившуюся строку
    $slackArray[$i] = array_merge($constraintCoef[$i], $newLine);
}

/*
 * Надо будет привести к стандартной форме
 *  Все ограничения – равенства с неотрицательной правой частью.
 *  Все переменные неотрицательны.
 */

pprintArr($slackArray, "Стандартная форма");

//Умножаем коэффициенты функции на -1
foreach($funcCoef as &$coef){
    $coef *= -1;
}
//В последней строке ставим столько нулей, сколько и ограничений
$lastRowExtra = array_fill(0, $constraintCount, 0);
// P = 1, а C = 0
// И соединяем это все в одну строку
$lastRow = array_merge($funcCoef, $lastRowExtra, array(1, 0));

pprintFlatArr($lastRow, "Последняя строка, где P = 1, C = 0");
//Добавляем последнюю строку к нашему массиву
array_push($slackArray , $lastRow);
//И получаем изначальную симплекс таблицу
$simplexTable = $slackArray;
//Выводим ее
pprintArr($simplexTable, "Исходная симплекс таблица");

$maxAttemps = 16; // Максимальное количество итераций
$isCanBeOptimized = false; // Флаг, чтоб понять решена ли задача

//Цикл решения
for ($attemp = 0; $attemp < $maxAttemps; ++$attemp) {

    $isCanBeOptimized = false; // Обнуляем флаг

    //Ищем самое минимальное число в последней строке -> опорный столбец
    $pivotCol = 0;
    $min = $simplexTable[0][0];
    for ($j = 0; $j < $arrCols - 1; ++$j) {
        if ($simplexTable[$arrRows - 1][$j] < 0) {
            $isCanBeOptimized = true; // Ставим флаг, если есть минимальные значения
        }
        if ($simplexTable[$arrRows - 1][$j] < $min) {
            $min = $simplexTable[$arrRows - 1][$j];
            $pivotCol = $j;
        }
    }

    //Если отрицательных нет - то мы нашли решение
    if ($isCanBeOptimized == false) {
        html("<br><h2>Решение найдено!</h2>");
        break; // Выходим из цикла
    }

    // Минимальное соотношение -> опорная строка
    $tempRatio = array(); // Временный массив для хранения соотношений
    for ($i = 0; $i < $arrRows - 1; ++$i) {
        $val = $simplexTable[$i][$arrCols - 1];
        $divider = $simplexTable[$i][$pivotCol];
        if ($divider != 0) { //Если делитель == 0, то соотношение не учитываем
            //Кладем во временный массив пару значений. Индекс и само значение соотношения.
            array_push($tempRatio, array("ind" => $i, "val" => $val / $divider));
        }
    }
    //Сортируем массив соотношений используя свою функцию описанную в helper.php
    usort($tempRatio, "cmp");
    //Самый первый элемент -> id минимального соотношения
    //Забираем из него индекс.
    $pivotRow = $tempRatio[0]["ind"];

    pprintFlatArr(array($pivotRow, $pivotCol), "Индексы опорной точки #" . ($attemp + 1));

    //Значение опорного элемента
    $divider = $simplexTable[$pivotRow][$pivotCol];
    //Делим опорную строку на значение опорного элемента
    for ($j = 0; $j < $arrCols; ++$j) {
        $simplexTable[$pivotRow][$j] /= $divider;
    }

    //Row 1 - ($arr[1, pivotCol]) * Pivot Row
    //Row 2 - ($arr[2, pivotCol]) * Pivot Row
    // Делаем остальные значения в столбце нулями
    for ($i = 0; $i < count($simplexTable); ++$i) {
        if ($i != $pivotRow) { // Игнорируем опорную строку
            $divider = $simplexTable[$i][$pivotCol];
            for ($j = 0; $j < count($simplexTable[$i]); ++$j) {
                $simplexTable[$i][$j] += (-$divider * $simplexTable[$pivotRow][$j]);
            }
        }
    }
    //Выводим состояние таблицы
    pprintArr($simplexTable, "Симплекс таблица #" . ($attemp  + 1));
}

if ($isCanBeOptimized) {
    html("<h2>Оптимальное решение не найдено. По крайней мере за 16 шагов</h2>");
}

?>
    <br>
    <input onclick="location='\\'" class="simpleButton" value="Решить еще">
</div>
</body>
</html>