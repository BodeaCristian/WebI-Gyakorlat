<?php

class Uzenetek_Model
{
    public function get_data()
    {
        $retData = array(
            'eredmeny' => 'OK',
            'uzenet' => '',
            'uzenetek' => array()
        );

        if(!isset($_SESSION['userid']) || (int)$_SESSION['userid'] <= 0) {
            $retData['eredmeny'] = 'ERROR';
            $retData['uzenet'] = 'Az üzenetek megtekintéséhez be kell jelentkezni.';
            return $retData;
        }

        try {
            $connection = Database::getConnection();
            $stmt = $connection->query('SELECT id, nev, email, targy, szoveg, letrehozva FROM kapcsolat_uzenetek ORDER BY letrehozva DESC, id DESC');
            $retData['uzenetek'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (PDOException $e) {
            $retData['eredmeny'] = 'ERROR';
            $retData['uzenet'] = 'Adatbázis hiba: '.$e->getMessage();
        }

        return $retData;
    }
}

?>