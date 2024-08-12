<?php
//1st task====================================
$items = [933, 529, 313, 831, 687, 893, 363, 641, 599, 467, 99, 285, 735, 577, 783, 41, 591, 367, 997, 909, 381, 437, 833, 835, 347, 328, 936, 482, 640, 712, 436, 74, 834, 520, 646, 662, 484, 150, 198, 358, 48, 202, 128, 650, 380, 28, 126, 714, 552, 900];
$length = 0;

foreach ($items as $item) {
    $length++;
}

echo "Massivin elementlerinin sayi: $length <br>";

//2nd task=====================================
$min = $items[0];
$max = $items[0];

for ($i = 1; isset($items[$i]); $i++) {
    if ($items[$i] < $min) {
        $min = $items[$i];
    }
    if ($items[$i] > $max) {
        $max = $items[$i];
    }
}

echo "The minimum value is: $min <br>";
echo "The maximum value is: $max <br>";

//3rd task=====================================
$odd_numbers = [];
$even_numbers = [];

foreach ($items as $item) {
    switch ($item % 2) {
        case 0:
            $even_numbers[] = $item;
            break;
        case 1:
            $odd_numbers[] = $item;
            break;
    }
}

echo "Odd numbers: " . implode(", ", $odd_numbers) . "<br>";
echo "Even numbers: " . implode(", ", $even_numbers) . "<br>";

//Task 4 ====================================================
$item2 = ["411", "exit", "51", "key", "309", "php", "775", "583", "449", "variable", "if", "528", "870", "840", "echo", "776", "666", "322", "536", "712"];
$integers = [];

for ($i = 0; isset($item2[$i]); $i++) {
    if (is_numeric($item2[$i]) && (int) $item2[$i] == $item2[$i]) {
        $integers[] = $item2[$i];
    }
}

echo "Integer values: " . implode(", ", $integers) . "<br>";

//Task 5======================================
$sum = 0;

for ($i = 0; isset($item2[$i]); $i++) {
    if (is_numeric($item2[$i]) && (int) $item2[$i] == $item2[$i]) {
        $sum += $item2[$i];
    }
}

echo "Sum of integer values: $sum <br>";

//Task 6======================================

$odd_sum = 0;
$even_sum = 0;

foreach ($item2 as $value) {
    if (is_numeric($value) && (int) $value == $value) {
        $number = (int) $value;
        if ($number % 2 == 0) {
            $even_sum += $number;
        } else {
            $odd_sum += $number;
        }
    }
}

echo "Sum of odd numbers: $odd_sum <br>";
echo "Sum of even numbers: $even_sum <br>";

//Task 7======================================

echo "String values: <br>";
foreach ($item2 as $value) {
    if (!is_numeric($value)) {
        echo "$value<br>";
    }
}

//Task 8======================================
$item3 = [
    "411",
    "exit",
    "key",
    "309" => [94],
    "php" => [],
    "449",
    "variable",
    "if",
    "840" => [
        1,
        2,
        3,
        4,
        5,
        6,
        7 => [
            'test',
            85,
            100,
            'case'
        ]
    ],
    "echo" => [
        50
    ],
    "776",
    ["536", 2],
    "712",
    ["915"]
];

echo "String keys: <br>";
foreach ($item3 as $key => $value) {
    if (!is_numeric($key)) {
        echo " $key <br>";
    }
}

echo "<hr>
Yeni Tapsiriqlar <br>";
//Task1--------------------------------------
$items = ['OinVkPr' => 'erNzZ', 'FWc' => 'wUpEaS', 't' => 'OlY', 'ctU' => 'KVG', 'wN' => 'Q', 'aAPH' => 'TqgyM', 'Lm' => 'VyqoKMP', 'mBy' => 'YC', 'lKiwFOJv' => 'PEG', 'JgHya' => 'IaxFMlBZk', 'gN' => 'MPlEbe', 'XP' => 'wZse', 'WQOpYCRul' => 'KtIOgy', 'WtYOyGN' => 'YxOkuCR', 'Gako' => 'jdL', 'YkSyhO' => 'VkQFlqhg', 'Xf' => 'BmaZlKSgt', 'IhvWXaE' => 'AyFB', 'fB' => 'snBUIK', 'THkzRvE' => 'TBm'];

$searchKeys = ['gN', 'test', 'Xf', 'jdL'];

$result = [];

foreach ($searchKeys as $key) {
    foreach ($items as $itemKey => $value) {
        if ($key === $itemKey) {
            $result[$key] = $value;
        }
    }
}

if (empty($result)) {
    echo "Nəticə tapilmadi!";
} else {
    print_r($result);
    echo "<hr>";
}
//Task2--------------------------------------

$items = ["banana", "fig", "apple", "elderberry", "mango", "kiwi", "cherry", "date", "apple", "grape", "nectarine", "banana", "honeydew", "lemon", "kiwi", "cherry", "orange", "raspberry", "fig", "strawberry", "elderberry", "mango", "lemon", "date", "grape"];
$unikal = [];

foreach ($items as $item) {
    $found = false;
    foreach ($unikal as $uniqueItem) {
        if ($item === $uniqueItem) {
            $found = true;
            break;
        }
    }
    if (!$found) {
        $unikal[] = $item;
    }
}
print_r($unikal);
echo "<hr>";

//Task3----------------------------------------

$items = ["banana", "fig", "apple", "elderberry", "mango", "kiwi", "cherry", "date", "apple", "grape", "nectarine", "banana", "honeydew", "lemon", "kiwi", "cherry", "orange", "raspberry", "fig", "strawberry", "elderberry", "mango", "lemon", "date", "grape"];
$all = [];

foreach ($items as $item) {
    if (!isset($all[$item])) {
        $all[$item] = 1;
    } else {
        $all[$item]++;
    }
}

print_r($all);
echo "<hr>";
//Task4------------------------------------------
$values = ['Name', 'Surname', 'Age'];
$keys = ['Jon', 'Doe', 20];

$newarray = [];

foreach ($keys as $index => $key) {
    $newarray[$key] = $values[$index];
}

print_r($newarray);
echo "<hr>";
//Task5--------------------------------------------
$array1 = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15];
$array2 = [3, 6, 9, 12, 15, 16, 17, 18];

$diff = [];

foreach ($array2 as $item2) {
    $found = false;
    foreach ($array1 as $item1) {
        if ($item1 === $item2) {
            $found = true;
            break;
        }
    }
    if (!$found) {
        $diff[] = $item2;
    }
}

print_r($diff);
echo "<hr>";
//Task6-------------------------------------------------

$email = 'nakhiyev.alakhber@gmail.com';
$index = 16;

$extractedPart = '';
for ($i = 0; $i <= $index; $i++) {
    $extractedPart .= $email[$i];
}

echo $extractedPart;
echo "<hr>";
//Task 7-----------------------------------------
$smvl = '*';
$email = ['n', 'a', 'k', 'h', 'i', 'y', 'e', 'v', '.', 'a', 'l', 'a', 'k', 'h', 'b', 'e', 'r', '@', 'g', 'm', 'a', 'i', 'l', '.', 'c', 'o', 'm'];

$new_string = '';

for ($i = 0; $i < count($email); $i++) {
    $new_string .=  $email[$i];
    if ($i < count($email) - 1) {
        $new_string .= $smvl;
    }
}
echo $new_string;
echo "<hr>";






