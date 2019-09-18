<?php
if (!empty($_POST['temperature']) && !empty($_POST['pressure'])) {
    $temperature = rtrim($_POST['temperature'], 'F'); //,без обработки выриантов ввода других символов.
    $pressure = rtrim($_POST['pressure'], 'bar');
}
 else {
    try {
        if (file_exists("./includes/vars.php")) {
            if ($file = fopen("./includes/vars.php", "r")) {
                require './includes/vars.php';
            } 
            else {
                throw new Exception("Не удалось открыть файл");
            }
        } 
        else {
            throw new Exception("Файл не найден");
        }
    } 
    catch (Exception $e) {
        echo $e->getMessage();
        exit();
    }
}

$temperatureNew = tempToDegree($temperature);
$pressureeNew = pressureToKgs($pressure);


function tempToDegree($t)
{
    return sprintf('%.2f', ($t - 32) / 1.8);
}

function pressureToKgs($pr)
{
    return sprintf('%.2f', ($pr * 10197.16));
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>Weather</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <form action="" method="POST">
        <div>
            <label for="temperature">Температура (F)</label>
            <input name="temperature" type="text" value="<?php echo $temperature; ?>" />
            <input name="temperatureNew" type="text" value="<?php echo $temperatureNew; ?>&nbsp;(&deg;C)" disabled />
        </div>
        <div><label for="pressure">Давление (bar)</label>
            <input name="pressure" type="text" value="<?php echo $pressure ?>" />
            <input name="pressureNew" type="text" value="<?php echo $pressureeNew; ?>&nbsp;(кгс/м2)" disabled />
        </div>
        <input type="submit" class="inputSubmit" />
    </form>
</body>

</html>