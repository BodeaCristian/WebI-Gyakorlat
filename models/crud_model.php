<?php

class Crud_Model
{
    private function toIntOrNull($value)
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

    public function getProcesszorok()
    {
        $connection = Database::getConnection();
        $stmt = $connection->query('SELECT id, gyarto, tipus FROM processzor ORDER BY gyarto, tipus');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOprendszerek()
    {
        $connection = Database::getConnection();
        $stmt = $connection->query('SELECT id, nev FROM oprendszer ORDER BY nev');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getGepek()
    {
        $connection = Database::getConnection();
        $stmt = $connection->query(
            'SELECT g.id, g.gyarto, g.tipus, g.kijelzo, g.memoria, g.merevlemez, g.vezerlo, g.ar, g.processzorid, g.oprendszerid, g.db,
                    p.gyarto AS processzor_gyarto, p.tipus AS processzor_tipus,
                    o.nev AS oprendszer_nev
             FROM gep g
             LEFT JOIN processzor p ON p.id = g.processzorid
             LEFT JOIN oprendszer o ON o.id = g.oprendszerid
             ORDER BY g.id DESC'
        );

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getGepById($id)
    {
        $connection = Database::getConnection();
        $stmt = $connection->prepare('SELECT * FROM gep WHERE id = :id');
        $stmt->execute(array(':id' => (int)$id));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createGep($input)
    {
        $ret = array('ok' => false, 'error' => '');

        $gyarto = trim($input['gyarto'] ?? '');
        $tipus = trim($input['tipus'] ?? '');

        if($gyarto === '' || $tipus === '') {
            $ret['error'] = 'A gyártó és a típus kitöltése kötelező.';
            return $ret;
        }

        $connection = Database::getConnection();
        $stmt = $connection->prepare(
            'INSERT INTO gep (gyarto, tipus, kijelzo, memoria, merevlemez, vezerlo, ar, processzorid, oprendszerid, db)
             VALUES (:gyarto, :tipus, :kijelzo, :memoria, :merevlemez, :vezerlo, :ar, :processzorid, :oprendszerid, :db)'
        );

        $stmt->execute(array(
            ':gyarto' => $gyarto,
            ':tipus' => $tipus,
            ':kijelzo' => $this->toIntOrNull($input['kijelzo'] ?? ''),
            ':memoria' => $this->toIntOrNull($input['memoria'] ?? ''),
            ':merevlemez' => $this->toIntOrNull($input['merevlemez'] ?? ''),
            ':vezerlo' => trim($input['vezerlo'] ?? ''),
            ':ar' => $this->toIntOrNull($input['ar'] ?? ''),
            ':processzorid' => $this->toIntOrNull($input['processzorid'] ?? ''),
            ':oprendszerid' => $this->toIntOrNull($input['oprendszerid'] ?? ''),
            ':db' => $this->toIntOrNull($input['db'] ?? '')
        ));

        $ret['ok'] = true;
        return $ret;
    }

    public function updateGep($id, $input)
    {
        $ret = array('ok' => false, 'error' => '');

        $gyarto = trim($input['gyarto'] ?? '');
        $tipus = trim($input['tipus'] ?? '');

        if($gyarto === '' || $tipus === '') {
            $ret['error'] = 'A gyártó és a típus kitöltése kötelező.';
            return $ret;
        }

        $connection = Database::getConnection();
        $stmt = $connection->prepare(
            'UPDATE gep
             SET gyarto = :gyarto,
                 tipus = :tipus,
                 kijelzo = :kijelzo,
                 memoria = :memoria,
                 merevlemez = :merevlemez,
                 vezerlo = :vezerlo,
                 ar = :ar,
                 processzorid = :processzorid,
                 oprendszerid = :oprendszerid,
                 db = :db
             WHERE id = :id'
        );

        $stmt->execute(array(
            ':gyarto' => $gyarto,
            ':tipus' => $tipus,
            ':kijelzo' => $this->toIntOrNull($input['kijelzo'] ?? ''),
            ':memoria' => $this->toIntOrNull($input['memoria'] ?? ''),
            ':merevlemez' => $this->toIntOrNull($input['merevlemez'] ?? ''),
            ':vezerlo' => trim($input['vezerlo'] ?? ''),
            ':ar' => $this->toIntOrNull($input['ar'] ?? ''),
            ':processzorid' => $this->toIntOrNull($input['processzorid'] ?? ''),
            ':oprendszerid' => $this->toIntOrNull($input['oprendszerid'] ?? ''),
            ':db' => $this->toIntOrNull($input['db'] ?? ''),
            ':id' => (int)$id
        ));

        $ret['ok'] = true;
        return $ret;
    }

    public function deleteGep($id)
    {
        $connection = Database::getConnection();
        $stmt = $connection->prepare('DELETE FROM gep WHERE id = :id');
        $stmt->execute(array(':id' => (int)$id));
    }
}

?>