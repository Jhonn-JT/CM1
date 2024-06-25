<?php
include_once "../core/ModeloBasePDO.php";

class CamarasModel extends ModeloBasePDO
{
    public function __construct()
    {
        parent::__construct();
    }

    public function findAll()
    {
        $sql = "SELECT codigo_camara, modelo, marca, precio, resolucion, tipo, proveedor, garantia, peso, 
                dimensiones, tipo_sensor, lente_incluido, tipo_almacenamiento, bateria, observaciones 
                FROM camaras";
        $param = array();
        return parent::gselect($sql, $param);
    }

    public function findPaginateAll($p_filtro, $p_limit, $p_offset)
    {
        $sql = "SELECT codigo_camara, modelo, marca, precio, resolucion, tipo, proveedor, garantia, peso, 
                dimensiones, tipo_sensor, lente_incluido, tipo_almacenamiento, bateria, observaciones 
                FROM camaras
                WHERE upper(concat(IFNULL(codigo_camara,''),IFNULL(modelo,''),IFNULL(marca,''),IFNULL(precio,''), 
                IFNULL(resolucion,''),IFNULL(tipo,''),IFNULL(proveedor,''),IFNULL(garantia,''),IFNULL(peso,''), 
                IFNULL(dimensiones,''),IFNULL(tipo_sensor,''),IFNULL(lente_incluido,''),IFNULL(tipo_almacenamiento,''), 
                IFNULL(bateria,''),IFNULL(observaciones,''))) LIKE CONCAT('%', upper(IFNULL(:p_filtro, '')), '%')
                LIMIT :p_limit 
                OFFSET :p_offset";
        $param = array();
        array_push($param, [':p_filtro', $p_filtro, PDO::PARAM_STR]);
        array_push($param, [':p_limit', $p_limit, PDO::PARAM_INT]);
        array_push($param, [':p_offset', $p_offset, PDO::PARAM_INT]);
        $var = parent::gselect($sql, $param);

        $sqlCount = "SELECT count(1) as cant
                     FROM camaras
                     WHERE upper(concat(IFNULL(codigo_camara,''),IFNULL(modelo,''),IFNULL(marca,''),IFNULL(precio,''), 
                     IFNULL(resolucion,''),IFNULL(tipo,''),IFNULL(proveedor,''),IFNULL(garantia,''),IFNULL(peso,''), 
                     IFNULL(dimensiones,''),IFNULL(tipo_sensor,''),IFNULL(lente_incluido,''),IFNULL(tipo_almacenamiento,''), 
                     IFNULL(bateria,''),IFNULL(observaciones,''))) LIKE CONCAT('%', upper(IFNULL(:p_filtro, '')), '%')";
        $param = array();
        array_push($param, [':p_filtro', $p_filtro, PDO::PARAM_STR]);
        $var1 = parent::gselect($sqlCount, $param);
        $var['LENGTH'] = $var1['DATA'][0]['cant'];
        return $var;
    }

    public function findId($p_codigo_camara)
    {
        $sql = "SELECT codigo_camara, modelo, marca, precio, resolucion, tipo, proveedor, garantia, peso, 
                dimensiones, tipo_sensor, lente_incluido, tipo_almacenamiento, bateria, observaciones 
                FROM camaras 
                WHERE codigo_camara = :p_codigo_camara";
        $param = array();
        array_push($param, [':p_codigo_camara', $p_codigo_camara, PDO::PARAM_STR]);
        return parent::gselect($sql, $param);
    }

    public function insert($p_codigo_camara, $p_modelo, $p_marca, $p_precio, $p_resolucion, $p_tipo, $p_proveedor, 
                           $p_garantia, $p_peso, $p_dimensiones, $p_tipo_sensor, $p_lente_incluido, $p_tipo_almacenamiento, 
                           $p_bateria, $p_observaciones)
    {
        $sql = "INSERT INTO camaras (codigo_camara, modelo, marca, precio, resolucion, tipo, proveedor, garantia, peso, 
                                     dimensiones, tipo_sensor, lente_incluido, tipo_almacenamiento, bateria, observaciones) 
                VALUES (:p_codigo_camara, :p_modelo, :p_marca, :p_precio, :p_resolucion, :p_tipo, :p_proveedor, 
                        :p_garantia, :p_peso, :p_dimensiones, :p_tipo_sensor, :p_lente_incluido, :p_tipo_almacenamiento, 
                        :p_bateria, :p_observaciones)";
        $param = array();
        array_push($param, [':p_codigo_camara', $p_codigo_camara, PDO::PARAM_STR]);
        array_push($param, [':p_modelo', $p_modelo, PDO::PARAM_STR]);
        array_push($param, [':p_marca', $p_marca, PDO::PARAM_STR]);
        array_push($param, [':p_precio', $p_precio, PDO::PARAM_STR]);
        array_push($param, [':p_resolucion', $p_resolucion, PDO::PARAM_STR]);
        array_push($param, [':p_tipo', $p_tipo, PDO::PARAM_STR]);
        array_push($param, [':p_proveedor', $p_proveedor, PDO::PARAM_STR]);
        array_push($param, [':p_garantia', $p_garantia, PDO::PARAM_STR]);
        array_push($param, [':p_peso', $p_peso, PDO::PARAM_STR]);
        array_push($param, [':p_dimensiones', $p_dimensiones, PDO::PARAM_STR]);
        array_push($param, [':p_tipo_sensor', $p_tipo_sensor, PDO::PARAM_STR]);
        array_push($param, [':p_lente_incluido', $p_lente_incluido, PDO::PARAM_STR]);
        array_push($param, [':p_tipo_almacenamiento', $p_tipo_almacenamiento, PDO::PARAM_STR]);
        array_push($param, [':p_bateria', $p_bateria, PDO::PARAM_STR]);
        array_push($param, [':p_observaciones', $p_observaciones, PDO::PARAM_STR]);
        return parent::ginsert($sql, $param);
    }

    public function update($p_codigo_camara, $p_modelo, $p_marca, $p_precio, $p_resolucion, $p_tipo, $p_proveedor, 
                           $p_garantia, $p_peso, $p_dimensiones, $p_tipo_sensor, $p_lente_incluido, $p_tipo_almacenamiento, 
                           $p_bateria, $p_observaciones)
    {
        $sql = "UPDATE camaras 
                SET modelo=:p_modelo, marca=:p_marca, precio=:p_precio, resolucion=:p_resolucion, tipo=:p_tipo, 
                    proveedor=:p_proveedor, garantia=:p_garantia, peso=:p_peso, dimensiones=:p_dimensiones, 
                    tipo_sensor=:p_tipo_sensor, lente_incluido=:p_lente_incluido, tipo_almacenamiento=:p_tipo_almacenamiento, 
                    bateria=:p_bateria, observaciones=:p_observaciones 
                WHERE codigo_camara = :p_codigo_camara";
        $param = array();
        array_push($param, [':p_codigo_camara', $p_codigo_camara, PDO::PARAM_STR]);
        array_push($param, [':p_modelo', $p_modelo, PDO::PARAM_STR]);
        array_push($param, [':p_marca', $p_marca, PDO::PARAM_STR]);
        array_push($param, [':p_precio', $p_precio, PDO::PARAM_STR]);
        array_push($param, [':p_resolucion', $p_resolucion, PDO::PARAM_STR]);
        array_push($param, [':p_tipo', $p_tipo, PDO::PARAM_STR]);
        array_push($param, [':p_proveedor', $p_proveedor, PDO::PARAM_STR]);
        array_push($param, [':p_garantia', $p_garantia, PDO::PARAM_STR]);
        array_push($param, [':p_peso', $p_peso, PDO::PARAM_STR]);
        array_push($param, [':p_dimensiones', $p_dimensiones, PDO::PARAM_STR]);
        array_push($param, [':p_tipo_sensor', $p_tipo_sensor, PDO::PARAM_STR]);
        array_push($param, [':p_lente_incluido', $p_lente_incluido, PDO::PARAM_STR]);
        array_push($param, [':p_tipo_almacenamiento', $p_tipo_almacenamiento, PDO::PARAM_STR]);
        array_push($param, [':p_bateria', $p_bateria, PDO::PARAM_STR]);
        array_push($param, [':p_observaciones', $p_observaciones, PDO::PARAM_STR]);
        return parent::gupdate($sql, $param);
    }

    public function delete($p_codigo_camara)
    {
        $sql = "DELETE FROM camaras WHERE codigo_camara = :p_codigo_camara";
        $param = array();
        array_push($param, [':p_codigo_camara', $p_codigo_camara, PDO::PARAM_STR]);
        return parent::gdelete($sql, $param);
    }
}
?>