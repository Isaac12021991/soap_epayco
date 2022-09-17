<?php
require_once "nusoap/nusoap.php";

$namespace = "Epayco Soap";
$server = new soap_server();
$server->configureWSDL("Soap Epayco Pagar",$namespace);
$server->wsdl->schemaTargetNamespace = $namespace;

$server->wsdl->addComplexType(
    'realizarPago',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'tx_token' => array('name' => 'tx_token', 'type'=>'xsd:string'),
        'monto' => array('name' => 'email', 'type'=>'xsd:decimal'),
    )
);

$server->wsdl->addComplexType(
    'response',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'success' => array('name'=>'success', 'type'=>'xsd:boolean'),
        'cod_error' => array('name' => 'cod_error', 'type' => 'xsd:boolean'),
        'message_error' => array('name' => 'message_error', 'type' => 'xsd:string'),

    )
);

$server->register(
    'realizarPago',
    array('name' => 'tns:realizarPago'),
    array('name' => 'tns:response'),
    $namespace,
    false,
    'rpc',
    'encoded',
    'Recibe los datos del usuario'
);

function realizarPago($request){
    return array(
        "message_error" => "Success",
        "success" => true
    );
}

$POST_DATA = file_get_contents("php://input");
$server->service($POST_DATA);
exit();
?>