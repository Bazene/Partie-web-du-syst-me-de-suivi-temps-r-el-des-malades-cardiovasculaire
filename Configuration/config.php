<?php
    //database type ; hote and database name
    $data_source_name='mysql:host=localhost;dbname=moyo_safi_database'; 
    $user_name = 'root';
    $password = 'root';

    $db = new PDO($data_source_name, $user_name, $password,[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);