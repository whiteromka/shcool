<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test()
    {
        $int = 1;
        $str = 'Rom';
        $str2 = "wqeqwe";

//        echo '11  $str';
//        echo "<br>";
//        echo "11  $str"; // !
//        echo "<hr>";
//
//        echo "concatenation" . " " . $str; // !

        // js
        // let a = [1, 2, 3]; let b = ['a', 'b', 'c];
        // a.push(4);

        $arr = [1, 2, 3];
        $arr = ['a', 'b', 'c'];
        array_push($arr, 'd'); // или
        $arr[] = 'e';

        // js objects:
        /*
           let person = {
                name: 'Rom',
                age: 12
            }
            person.salary = 100

            person.sayName = function() { // функции на лету легко добавляются к obj
                console.log(this.name)
            }
        */

        // php ассоциативный массив
        $person = [
            'name' => 'Rom',
            'age' => 12
        ];
        $person[] = 100;
        // в php нельзя добавлять фун-ции к массивам

//        echo "<pre>";
//        print_r($person);

        // ================================
        // js: a.push(element)               php: $a[] = $element;
        // js: let last = a.pop()            php: $lats = array_pop($arr)
        // a.unshift(element)                     array_unshift($ar, $element)  // вставить в начало
        // a.shift(element)                       array_shift($ar);             // удалить из начала 1 эл
        // let res = arr1.concat(arr2, arr3)      $res = array_merge([1], [2]);  // склеить массивы
        // sort(...)                              sort($fruits);
        //                                        rand(int $min, int $max): int
        // a.length                               $cnt = count($arr);

        $res = array_slice(
            [0,1,2,3,4,5],
            1,
            3
        );
        //echo "<pre>";
        //print_r($res);

        // склеить 2-ва массива в 1
        // let res = arr1.concat(arr2, arr3);
        $res = array_merge([1], [2]);
        //echo "<pre>";
        //print_r($res);

        // ЦИКЛЫ
        $arr = ['a', 'b', 'c'];
        for($i = 0; $i < count($arr); $i++) {
            //echo $arr[$i] . "<br>";
        }

        foreach($arr as $key => $value) { // !!!
            echo $key . ' - ' . $value . "<br>";
        }

        // !
        $day = "Monday";
        switch ($day) {
            case "Monday":
                echo "Понедельник - начало недели";
                echo "<br>";
                break;
            case "Tuesday":
                echo "Вторник";
                break;
            case "Wednesday":
                echo "Среда";
                break;
            case "Thursday":
                echo "Четверг";
                break;
            case "Friday":
                echo "Пятница - почти выходные!";
                break;
            case "Saturday":
            case "Sunday":
                echo "Выходной день!";
                break;
            default:
                echo "Неизвестный день";
        }


        return '';
    }
}
