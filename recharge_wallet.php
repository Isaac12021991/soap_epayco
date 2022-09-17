<?php
require_once "nusoap/nusoap.php";

$namespace = "Epayco Soap";
$server = new soap_server();
$server->configureWSDL("Soap Epayco Recargar Billetera",$namespace);
$server->wsdl->schemaTargetNamespace = $namespace;

$server->wsdl->addComplexType(
    'recargarWallet',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'nu_documento' => array('name' => 'nu_documento', 'type'=>'xsd:string'),
        'monto' => array('name' => 'email', 'type'=>'xsd:decimal'),
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
    'recargarWallet',
    array('name' => 'tns:recargarWallet'),
    array('name' => 'tns:response'),
    $namespace,
    false,
    'rpc',
    'encoded',
    'Recibe los datos del usuario'
);

function recargarWallet($request){
    return array(
        "message_error" => "Success",
        "success" => true
    );
}

$POST_DATA = file_get_contents("php://input");
$server->service($POST_DATA);
exit();
?>