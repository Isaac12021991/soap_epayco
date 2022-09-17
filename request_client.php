<?php
    require_once "nusoap/nusoap.php";
    $servicio                = "http://soap_epayco/pay.php?wsdl"; //url del servicio
    $client                  = new SoapClient($servicio);
    $response        = $client->realizarPago($tx_token, $ca_monto);
?>