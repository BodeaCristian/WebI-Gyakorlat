<?php

require_once __DIR__.'/includes/database.inc.php';

function read_tsv_rows($filePath)
{
    if(!file_exists($filePath)) {
        throw new RuntimeException('Hiányzó fájl: '.$filePath);
    }

    $rows = array();
    $handle = fopen($filePath, 'r');
    if($handle === false) {
        throw new RuntimeException('Nem sikerült megnyitni a fájlt: '.$filePath);
    }

    $isHeader = true;
    while(($row = fgetcsv($handle, 0, "\t")) !== false) {
        if($isHeader) {
            $isHeader = false;
            continue;
        }

        if(count($row) === 1 && trim((string)$row[0]) === '') {
            continue;
        }

        $rows[] = $row;
    }

    fclose($handle);
    return $rows;
}

function to_int_or_null($value)
{
    $value = trim((string)$value);
    if($value === '') {
        return null;
    }

    $value = str_replace(',', '.', $value);
    if(!is_numeric($value)) {
        return null;
    }

    return (int)round((float)$value);
}

$dbName = isset($_GET['db']) && $_GET['db'] !== '' ? $_GET['db'] : DATABASE;

try {
    $connection = new PDO(
        'mysql:host='.HOST.';dbname='.$dbName.';charset=utf8mb4',
        USER,
        PASSWORD,
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );

    $dataDir = __DIR__.'/data/';

    $processzorRows = read_tsv_rows($dataDir.'processzor.txt');
    $oprendszerRows = read_tsv_rows($dataDir.'oprendszer.txt');
    $gepRows = read_tsv_rows($dataDir.'gep.txt');

    $connection->beginTransaction();

    $connection->exec('SET FOREIGN_KEY_CHECKS=0');
    $connection->exec('TRUNCATE TABLE gep');
    $connection->exec('TRUNCATE TABLE processzor');
    $connection->exec('TRUNCATE TABLE oprendszer');
    $connection->exec('SET FOREIGN_KEY_CHECKS=1');

    $processzorStmt = $connection->prepare(
        'INSERT INTO processzor (id, gyarto, tipus) VALUES (:id, :gyarto, :tipus)'
    );
    foreach($processzorRows as $row) {
        if(count($row) < 3) {
            continue;
        }

        $processzorStmt->execute(array(
            ':id' => (int)$row[0],
            ':gyarto' => trim($row[1]),
            ':tipus' => trim($row[2])
        ));
    }

    $oprendszerStmt = $connection->prepare(
        'INSERT INTO oprendszer (id, nev) VALUES (:id, :nev)'
    );
    foreach($oprendszerRows as $row) {
        if(count($row) < 2) {
            continue;
        }

        $oprendszerStmt->execute(array(
            ':id' => (int)$row[0],
            ':nev' => trim($row[1])
        ));
    }

    $gepStmt = $connection->prepare(
        'INSERT INTO gep (gyarto, tipus, kijelzo, memoria, merevlemez, vezerlo, ar, processzorid, oprendszerid, db)
         VALUES (:gyarto, :tipus, :kijelzo, :memoria, :merevlemez, :vezerlo, :ar, :processzorid, :oprendszerid, :db)'
    );

    foreach($gepRows as $row) {
        if(count($row) < 10) {
            continue;
        }

        $gepStmt->execute(array(
            ':gyarto' => trim($row[0]),
            ':tipus' => trim($row[1]),
            ':kijelzo' => to_int_or_null($row[2]),
            ':memoria' => to_int_or_null($row[3]),
            ':merevlemez' => to_int_or_null($row[4]),
            ':vezerlo' => trim($row[5]),
            ':ar' => to_int_or_null($row[6]),
            ':processzorid' => to_int_or_null($row[7]),
            ':oprendszerid' => to_int_or_null($row[8]),
            ':db' => to_int_or_null($row[9])
        ));
    }

    $connection->commit();

    echo 'Import sikeres. Betöltve: '.count($processzorRows).' processzor, '.count($oprendszerRows).' oprendszer, '.count($gepRows).' gep.';
}
catch (Throwable $e) {
    if(isset($connection) && $connection instanceof PDO && $connection->inTransaction()) {
        $connection->rollBack();
    }

    http_response_code(500);
    echo 'Import hiba: '.$e->getMessage();
}
