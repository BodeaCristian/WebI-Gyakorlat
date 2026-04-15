<?php

class Kapcsolat_Model
{
    public function get_data($vars)
    {
        $isLoggedIn = isset($_SESSION['userid']) && (int)$_SESSION['userid'] > 0;
        $sessionName = trim(($_SESSION['userlastname'] ?? '').' '.($_SESSION['userfirstname'] ?? ''));

        $retData = array(
            'eredmeny' => 'ERROR',
            'uzenet' => '',
            'errors' => array(),
            'form' => array(
                'nev' => trim($vars['nev'] ?? ''),
                'email' => trim($vars['email'] ?? ''),
                'targy' => trim($vars['targy'] ?? ''),
                'szoveg' => trim($vars['szoveg'] ?? '')
            ),
            'kuldo_nev' => ''
        );

        if($isLoggedIn) {
            $retData['kuldo_nev'] = ($sessionName !== '') ? $sessionName : 'Felhasználó';
        } else {
            $retData['kuldo_nev'] = 'Vendég';
        }

        if(!filter_var($retData['form']['email'], FILTER_VALIDATE_EMAIL)) {
            $retData['errors'][] = 'Adj meg érvényes e-mail címet.';
        }

        if(strlen($retData['form']['targy']) < 5) {
            $retData['errors'][] = 'A tárgy legyen legalább 5 karakter.';
        }

        if(strlen($retData['form']['szoveg']) < 10) {
            $retData['errors'][] = 'Az üzenet legyen legalább 10 karakter.';
        }

        if(!empty($retData['errors'])) {
            $retData['uzenet'] = 'Az űrlap hibásan lett kitöltve.';
            return $retData;
        }

        try {
            $connection = Database::getConnection();

            $stmt = $connection->prepare(
                'INSERT INTO kapcsolat_uzenetek (nev, email, targy, szoveg)
                 VALUES (:nev, :email, :targy, :szoveg)'
            );

            $stmt->execute(array(
                ':nev' => $retData['kuldo_nev'],
                ':email' => $retData['form']['email'],
                ':targy' => $retData['form']['targy'],
                ':szoveg' => $retData['form']['szoveg']
            ));

            $retData['eredmeny'] = 'OK';
            $retData['uzenet'] = 'Az üzenet sikeresen elküldve.';
        }
        catch (PDOException $e) {
            $retData['uzenet'] = 'Adatbázis hiba: '.$e->getMessage();
        }

        return $retData;
    }
}

?>