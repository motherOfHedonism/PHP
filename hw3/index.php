<?php
$name = $phone = $review = $nameMessage = $phoneMessage = $reviewMessage = "";
if (!empty($_POST)) {
    $name = $_POST["name"];
    $nameMessage = nameCheck($_POST["name"]);
    $phone = $_POST["phone"];
    $phoneMessage = phoneCheck($_POST["phone"]);
    $review = $_POST["review"];
    $reviewMessage = reviewCheck($_POST["review"]);

    if (empty($nameMessage) && empty($phoneMessage) && empty($reviewMessage)) {

        $file = fopen("review.storage.txt", "a");
        if (!$file) {
            echo "Не удалось открыть файл.";
            return;
        } 
        else {
            fwrite($file, date("d.m.y") . "--" . date("H:i:s") . "--" . $_SERVER["REMOTE_ADDR"] . "--" . $name . "--" . $phone . "--" . $review . "\n");
            fclose($file);
        }
    }
}

function nameCheck($str)
{
    $result = "";
    $strLength = 0;

    if (!empty($str)) {
        $isName = true;
        while ($isName) {

            for ($i = 0; $i < mb_strlen($str); $i++) {

                $a = mb_ord(mb_substr($str, $i, 1), 'UTF-8');
                if (($a < 1040 && ($a != 32 && $a != 45 && $a != 1025)) || $a > 1105 || $a == 1104) {
                    $result = "Допустимы только буквы русского алфавита, пробелы и дефисы.";
                    $isName = false;
                    break;
                } 
                else if ($a >= 1040 && $a <= 1106 || $a == 1025 || $a == 1105) {
                    $strLength++;
                }
                if ($i == mb_strlen($str) - 1) {
                    $isName = false;
                }
            }
        }
    }

    if ($strLength < 2) {
        return "Имя должно содержать не менее двух букв.";
    }

    return $result;
}

function phoneCheck($str)
{
    $result = "";
    $strLength = 0;

    if (!empty($str)) {

        $isPhone = true;
        while ($isPhone) {

            for ($i = 0; $i < mb_strlen($str); $i++) {

                $a = mb_ord(mb_substr($str, $i, 1), 'UTF-8');

                if (($i != 0 && $a == 43) || ($a < 48 && ($a != 32 && $a != 43 && $a != 45 && $a != 40 && $a != 41)) || $a > 57) {

                    $result = "Допустимы только цифры, пробелы, дефисы, круглые скобки и + в начале номера.";
                    $isPhone = false;
                    break;

                } 
                else if ($a >= 48 && $a <= 57) {
                    $strLength++;
                }
                if ($i == mb_strlen($str) - 1) {
                    $isPhone = false;
                }
            }
        }
    }

    if ($strLength < 6) {
        return "Номер телефона должен содержать не менее 6 цифр.";
    }
    return $result;
}

function reviewCheck($str)
{
    $result = "";
    $strLength = 0;

    if (empty($str)) {
        $result = "Введите отзыв.";
    } 
    else {
        if (!empty(strstr($str, "http"))) {
            $result = "Отзыв не должен содержать гиперссылок";
        }

        if (!empty(strstr($str, "</"))) {
            $result = "Отзыв не должен содержать тегов";
        }

        $tempStr =  strstr($str, "<");
        if (!empty(strstr($tempStr, ">"))) {
            $result = "Отзыв не должен содержать тегов";
        } 
        else if (!empty(strstr($tempStr, "/>"))) {
            $result = "Отзыв не должен содержать тегов";
        }
    }

    return $result;
}
?>

<!DOCTYPE html>
<html>

<head>
    <style>
        label {
            display: inline-block;
            width: 10vw;
            vertical-align: top;
        }

        .input {
            margin-bottom: 2vh;
            width: 15vw;
        }

        textarea {
            margin-bottom: 2vh;
            height: 10vh;
            width: 14.9vw;
        }

        .clear {
            clear: both;
        }

        #btn {
            display: block;
        }

        #inputReviewMessage {
            display: inline-block;
            vertical-align: top;
        }

        .message {
            display: inline-block;
        }
    </style>
</head>

<body>
    <form action="" method="POST">
        <label for="name">Имя</label>
        <input class="input" type="text" name="name" value="<?php echo $name; ?>" />
        <div class="message"><?php echo $nameMessage; ?></div>
        <div class="clear"></div>
        <label for="phone">Телефон</label>
        <input class="input" type="text" name="phone" value="<?php echo $phone; ?>" />
        <div class="message"><?php echo $phoneMessage; ?></div>
        <div class="clear"></div>
        <label for="review">Отзыв</label>
        <textarea name="review"><?php echo $review; ?></textarea>
        <div id="inputReviewMessage" class="message"><?php echo $reviewMessage; ?></div>
        <input id="btn" type="submit" />
    </form>
</body>

</html>