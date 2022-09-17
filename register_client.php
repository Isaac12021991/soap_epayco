<?php
require_once "nusoap/nusoap.php";

$namespace = "Epayco Soap";
$server = new soap_server();
$server->configureWSDL("Soap Epayco Registrar Cliente",$namespace);
$server->wsdl->schemaTargetNamespace = $namespace;

$server->wsdl->addComplexType(
    'registrarCliente',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'first_name' => array('name' => 'first_name', 'type'=>'xsd:string'),
        'last_name' => array('name' => 'last_name', 'type'=>'xsd:string'),
        'nu_documento' => array('name' => 'nu_documento', 'type'=>'xsd:string'),
        'email' => array('name' => 'email', 'type'=>'xsd:string'),
        'nu_celular' => array('name' => 'nu_celular', 'type'=>'xsd:decimal')
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
    'registrarCliente',
    array('name' => 'tns:registrarCliente'),
    array('name' => 'tns:response'),
    $namespace,
    false,
    'rpc',
    'encoded',
    'Recibe los datos del usuario'
);

function registrarCliente($request){
    return array(
        "message_error" => "Success",
        "success" => true
    );
}

$POST_DATA = file_get_contents("php://input");
$server->service($POST_DATA);
exit();
?>