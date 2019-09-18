<?php
$string = "12м; 31 т.; 72грамма;41см; 12 кгс/см2 ;17 ам";
if (iconv_strlen ($string) != 0) {
    $string = preg_replace("/ +/","",$string);
    $array = explode(";",$string);
    $array = varFunc($array);
    foreach ($array as $el) {
       echo $el . " ";
    }
    
}
function varFunc($arr) {
    $t = 1000;
    $gr = 0.001;
    $sm = 0.01;
    foreach ($arr as $key => $el) {
        if (preg_match("/\dм{1}\W*/",$el)) { //метры
            continue;
        }
        else if (preg_match("/(\d)кг{1}(\W*)(\W$)/",$el)) { //кг
            continue;
        }
        else  if (preg_match("/\dт{1}\W*/",$el)) { //тонны
            $arr[$key] = replace($arr[$key], $t, strpos($el,"т"), "кг");
        }
        else  if (preg_match("/\dгр{1}\W*/",$el)) { //граммы
            $arr[$key] = replace($arr[$key], $gr, strpos($el,"гр"), "кг");
        }
        else  if (preg_match("/\dсм{1}\W*/",$el)) { //сантиметры
            $arr[$key] = replace($arr[$key], $sm, strpos($el,"см"), "м");
        }
        else  if (preg_match("/\dкгс[\/]{1}см2{1}/",$el)) { //кгс/cм2
            $arr[$key] = replace($arr[$key], 98066.5, strpos($el,"кгс/см2"), "Па");
        }
        else $arr[$key] = "-";
        
    }
    return $arr;
}

function replace($el, $koeff, $to, $ed) {
    $el = (int)substr($el,0,$to)*$koeff;
    return $el . $ed;
}

?>