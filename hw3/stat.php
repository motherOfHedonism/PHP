<?php
if (!empty($_POST["ip"])) {

    $ip = $_POST["ip"];

    // $file = fopen("review.storage.txt", "r");
    // while (!feof($file)) {
    //     $content[] = fgets($file);
    // }
    // fclose($file);
    //$length = count($content) - 1; 

    $content = file("review.storage.txt");
    $length = count($content);
} else {
    $ip = 0;
}


function ipCounter($content, $ip)
{
    $counter = 0;
    foreach ($content as $el) {
        $tempArr = explode("--", $el);
        if (strpos($tempArr[2], $ip, 0) === 0) {
            $counter++;
        }
    }
    return $counter;
}

function ipListInDate($content, $date)
{
    foreach ($content as $el) {
        $tempArr = explode("--", $el);
        if (strpos($tempArr[0], $date, 0) === 0) {
            $ipArray[] = $tempArr[2];
        }
    }
    return $ipArray;
}

function dateAndIpCounter($array)
{
    $dateArr = createDateArray($array);
    $uniqueDateArr = array_values(array_unique($dateArr));

    $countArr = dateCounter($dateArr, $uniqueDateArr);
    greatDate($array, $uniqueDateArr, $countArr);
}

function createDateArray($array)
{
    $dateArr = [];
    $i = 0;
    foreach ($array as $el) {
        $tempArr = explode("--", $el);
        array_push($dateArr, $tempArr[0]);
        $i++;
    }
    return $dateArr;
}

function dateCounter($dateArr, $uniqueDateArr)
{
    $dateCounter = 0;
    $countArr = [];
    foreach ($uniqueDateArr as $unData) {
        $dateCounter = 0;
        foreach ($dateArr as $data) {
            if ($unData == $data) {
                $dateCounter++;
            }
        }
        array_push($countArr, $dateCounter);
    }
    return $countArr;
}

function greatDate($array, $uniqueDateArr, $countArr)
{
    echo "<br/>";
    $resultArray = array_combine($uniqueDateArr, $countArr);
    $max = max($resultArray);
    foreach ($resultArray as $date => $counter) {
        if ($max == $counter) {
            echo "<b>" . $date . "</b> - " . $counter . " записей<br/>";
            $ipArray = ipListInDate($array, $date);
            echo  "Всего отзывов: " . count($ipArray) . "<br/>";
            foreach ($ipArray as $ipEl) {
                echo $ipEl . "<br/>";
            }
        } else {
            echo $date . " - " . $counter . " записей<br/>";
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
</head>

<body>
    <form action="" method="POST">
        <label for="ip">Введите ip-адрес </label>
        <input name="ip" value="<?php echo $ip; ?>">
    </form>
    <div><?php
            if (!empty($_POST["ip"])) {

                $counter = ipCounter($content, $ip);
                echo "Cовпадений: " . $counter . "<br/>";
                echo "Всего записей: " . $length . "<br/>";
                echo "Соотношение: " . $counter * 100 / $length . "%<br/>";

                dateAndIpCounter($content);
            }
            ?></div>
</body>

</html>