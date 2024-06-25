<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Content-Type: application/json; charset=UTF-8");

session_start();

require_once($_SERVER['DOCUMENT_ROOT'] . "/camera/model/CamaraModel.php");

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);

try {
    $Path_Info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : (isset($_SERVER['ORIG_PATH_INFO']) ? $_SERVER['ORIG_PATH_INFO'] : '');
    $request = explode('/', trim($Path_Info, '/'));
} catch (Exception $e) {
    echo $e->getMessage();
}

switch ($method) {
    case 'GET': //consulta
        $p_ope = $_GET['ope'] ?? null;
        if ($p_ope) {
            if ($p_ope == 'filterId') {
                filterId($_GET);
            } elseif ($p_ope == 'filterSearch') {
                filterPaginateAll($_GET);
            } elseif ($p_ope ==  'filterall') {
                filterAll($_GET);
            }
        }
        break;
    case 'POST': //inserta
        insert($input);
        break;
    case 'PUT': //actualiza
        update($input);
        break;
    case 'DELETE': //elimina
        delete($input);
        break;
    default: //metodo NO soportado
        echo 'METODO NO SOPORTADO';
        break;
}

function filterId($params)
{
    $tseg_modulo = new CamarasModel();
    $p_id = $params['id'] ?? null;
    if ($p_id) {
        $var = $tseg_modulo->findId($p_id);
        echo json_encode($var);
    } else {
        echo json_encode(['error' => 'ID is required']);
    }
}

function filterPaginateAll($params)
{
    $nro_record_page = 10;
    $page = $params['page'] ?? 1;
    $filter = $params['filter'] ?? '';
    $p_limit = 10;
    $p_offset = abs(($page - 1) * $nro_record_page);
    $tseg_modulo = new CamarasModel();
    $var = $tseg_modulo->findPaginateAll($filter, $p_limit, $p_offset);
    echo json_encode($var);
}

function filterAll($params)
{
    $tseg_modulo = new CamarasModel();
    $var = $tseg_modulo->findAll();
    echo json_encode($var);
}

function insert($input)
{
    $p_codigo_camara = $input['codigo_camara'] ?? null;
    $p_modelo = $input['modelo'] ?? null;
    $p_marca = $input['marca'] ?? null;
    $p_precio = $input['precio'] ?? null;
    $p_resolucion = $input['resolucion'] ?? null;
    $p_tipo = $input['tipo'] ?? null;
    $p_proveedor = $input['proveedor'] ?? null;
    $p_garantia = $input['garantia'] ?? null;
    $p_peso = $input['peso'] ?? null;
    $p_dimensiones = $input['dimensiones'] ?? null;
    $p_tipo_sensor = $input['tipo_sensor'] ?? null;
    $p_lente_incluido = $input['lente_incluido'] ?? null;
    $p_tipo_almacenamiento = $input['tipo_almacenamiento'] ?? null;
    $p_bateria = $input['bateria'] ?? null;
    $p_observaciones = $input['observaciones'] ?? null;

    if ($p_codigo_camara && $p_modelo && $p_marca && $p_precio) {
        $tseg_modulo = new CamarasModel();
        $var = $tseg_modulo->insert(
            $p_codigo_camara, $p_modelo, $p_marca, $p_precio, $p_resolucion, $p_tipo, 
            $p_proveedor, $p_garantia, $p_peso, $p_dimensiones, $p_tipo_sensor, 
            $p_lente_incluido, $p_tipo_almacenamiento, $p_bateria, $p_observaciones
        );
        echo json_encode($var);
    } else {
        echo json_encode(['error' => 'Required fields are missing']);
    }
}

function update($input)
{
    $p_codigo_camara = $input['codigo_camara'] ?? null;
    $p_modelo = $input['modelo'] ?? null;
    $p_marca = $input['marca'] ?? null;
    $p_precio = $input['precio'] ?? null;
    $p_resolucion = $input['resolucion'] ?? null;
    $p_tipo = $input['tipo'] ?? null;
    $p_proveedor = $input['proveedor'] ?? null;
    $p_garantia = $input['garantia'] ?? null;
    $p_peso = $input['peso'] ?? null;
    $p_dimensiones = $input['dimensiones'] ?? null;
    $p_tipo_sensor = $input['tipo_sensor'] ?? null;
    $p_lente_incluido = $input['lente_incluido'] ?? null;
    $p_tipo_almacenamiento = $input['tipo_almacenamiento'] ?? null;
    $p_bateria = $input['bateria'] ?? null;
    $p_observaciones = $input['observaciones'] ?? null;

    if ($p_codigo_camara) {
        $tseg_modulo = new CamarasModel();
        $var = $tseg_modulo->update(
            $p_codigo_camara, $p_modelo, $p_marca, $p_precio, $p_resolucion, $p_tipo, 
            $p_proveedor, $p_garantia, $p_peso, $p_dimensiones, $p_tipo_sensor, 
            $p_lente_incluido, $p_tipo_almacenamiento, $p_bateria, $p_observaciones
        );
        echo json_encode($var);
    } else {
        echo json_encode(['error' => 'ID is required for update']);
    }
}

function delete($input)
{
    $p_id = $input['id'] ?? $_POST['id'] ?? null;
    if ($p_id) {
        $tseg_modulo = new CamarasModel();
        $var = $tseg_modulo->delete($p_id);
        echo json_encode($var);
    } else {
        echo json_encode(['error' => 'ID is required for deletion']);
    }
}