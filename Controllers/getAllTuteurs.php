<?php
    include_once "../Configuration/config.php";
    include_once "../Models/tuteur.php";

    function getAllTuteurs() {
        return Tuteur :: getAllTuteurs();
    }

    function getTuteursSearch() {
        if($_POST) {
            $tuteur_search = $_POST['tuteur_search'];
            $tuteur_search_result = Tuteur :: tuteur_search($tuteur_search);
            return $tuteur_search_result;
        } else {
            return false;
        }
    }