<?php
  include_once "../Configuration/config.php";
  include_once "../Models/limitesvitalsignspatient.php";

  $patientId = 54;
  $limitesVital = new Limitesvitalsignspatient($patientId, 36, 38, 90, 100, 50, 100, "108/75", "126/83", 70, 110);
     
  if($limitesVital->createLimitesVitalSign()) {
      echo "Saluuuuuuuuuuuuuuu";
  } else {
    echo "ca ne marche pas";
  }

    // echo "ca ne marche pas";
