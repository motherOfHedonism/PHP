<?php

function1();
function2();
function3();

function function1(){
    $a = 17;
    $b = 4;

    $ab = $a * $b;
    echo '17*4 = ' . $ab;
    echo '<br/>17/4 = ' . $a / $b;
    echo '<br/>17^4 = ' . pow($a, $b);
    $del13 = $ab % 13;
    echo '<br/>17*4/13 = ' . $del13;

    if ($del13 % 2 == 0) {
        if ($del13 % 3 == 0) {
            echo "&nbsp;остаток делится на шесть";
        }
    } 
    else {
        echo "&nbsp;остаток не делится на шесть";
    }
    echo "<br/>";
    cirkle($a);
    echo "<div style='border-bottom:1px solid black; width:auto'></div><br/>";
}

function cirkle($a)
{
    $pi = pi();
    $s = $pi * $a * $a * 0.25;
    if ($s < 200) {
        echo "маленький круг (" . sprintf('%.0f', $s) . ")";
    } 
    else if ($s > 200 && $s < 300) {
        echo "средний круг (" . sprintf('%.0f', $s) . ")";
    } 
    else {
        echo "маленький круг (" . sprintf('%.0f', $s) . ")";
    }
}

function function2() {
    multiplicity1();
    multiplicity2();
}

function multiplicity1() {
    $string = "";
    for ($i = 1; $i <= 10000; $i++) {
        if ($i % 10 != 0) {
            if ($i % 9 == 0) {
                if ($i % 5 == 0) {
                    $string .= $i . ", ";
                }
            }
        }
    }
    echo trim($string, ", ") . "<br/>";
}
function multiplicity2() {
    for ($j = 9873; $j <= 18542; $j++) {
        if ($j % 17 == 0) {
            if ($j % 5 == 0) {
                if ($j % 3 == 0) {
                    echo "<br/>" . $j;
                    break;
                }
            }
        }
    }
    echo "<div style='border-bottom:1px solid black; width:auto'></div><br/>";
}

function function3() {
    echo "Количество кодов = " . pow(10 - 3, 6);
    secondWay();
}

function secondWay() {
    echo "<br/>Коды:<br/>";
    $array = [2, 4, 5, 6, 7, 8, 9];
    $codes = [];
    foreach ($array as $el1) {
        foreach ($array as $el2) {
            foreach ($array as $el3) {
                foreach ($array as $el4) {
                    foreach ($array as $el5) {
                        foreach ($array as $el6) {
                            array_push($codes, $el1 . $el2 . $el3  . $el4  . $el5 . $el6);
                        }
                    }
                }
            }
        }
    }
    foreach ($codes as $el) {
        echo $el . ' ';
    }
    echo "<br/>Количество кодов = " . count($codes);
}
?>