<?php
require_once("connect.php");

function query($sql, $data=[], $check=false) {
    global $conn;
    $res = false;
    try {
    $stmt = $conn->prepare($sql);
    if (!empty($data)) {
        $res = $stmt->execute($data);
    }
    else {
        $res = $stmt->execute();
    }
    }

    catch (Exception $e) {
        echo $e->getMessage();
    }

    if ($check) {
        return $stmt;
    }
    return $res;

}

function getRaw($sql) {
    $kq = query($sql, '', true);
    if (is_object($kq)) {
        $data = $kq->fetchAll(PDO::FETCH_ASSOC);
        #print_r($data);
    }
    return $data;
}

function getOneRaw($sql) {
    $kq = query($sql, '', true);
    if (is_object($kq)) {
        $data = $kq->fetch(PDO::FETCH_ASSOC);
    }
    return $data;
}

function update ($table, $data, $condition) {
    $update =  '';
    foreach ($data as $key => $value) {
        $update .= $key . '=:' . $key . ',';
    }
    $update = trim($update, ',');
    $sql = 'UPDATE ' . $table . ' SET ' . $update . ' WHERE ' . $condition;
    //print($sql);
    $kq = query($sql, $data);
    return $kq;
}

function insert($table, $data) {
    $columns = '';
    $values = '';
    foreach ($data as $key => $value) {
        $columns .= $key . ',';
        $values .= ':' . $key . ',';
    }
    $columns = trim($columns, ',');
    $values = trim($values,',');
    $sql = 'INSERT INTO ' . $table . ' (' . $columns . ') VALUES ('. $values . ')';
    print($sql);
    $kq = query($sql, $data);
    return $kq;
}