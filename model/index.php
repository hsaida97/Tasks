<?php


require_once './Models/User.php';
require_once './Models/Client.php';


$user = new User();

// $usersData = $user->all();
// foreach ($usersData as $data){
    
//     echo $data->name.'<br>';
// }


// print_r($user->find(1)->name);
$data =[
    'name'=>':nameasdasdas',
    'surname'=>':surnamesadsadas',
    'email'=>':emaiasdasdsal',
    'password'=>':passwordasdasd',
];

$data =[
    'name'=>'dasdas',
    'surname'=>'Salam 1',
    'password'=>md5('1'),
];



$usersData = $user->paginate(5);

var_dump($usersData);



?>