<?php

namespace App\Models;

use Core\Model;
use App\Core;
use DateTime;
use Exception;
use App\Utility;

/**
 * messages Model
 */
class Messages extends Model {

    /**
     * ?
     * @access public
     * @return string|boolean
     * @throws Exception
     */
    public static function getAll() {
        $db = static::getDB();

        $query = 'SELECT * FROM messages ';


        $stmt = $db->query($query);

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * ?
     * @access public
     * @return string|boolean
     * @throws Exception
     */
    public static function getByUser($data) {
        $db = static::getDB();
        $stmt = $db->prepare('SELECT * FROM messages WHERE id_receiver = :id_receiver');

        $stmt->bindParam(':id_receiver', $data['id']);

        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }


    /**
     * ?
     * @access public
     * @return string|boolean
     * @throws Exception
     */
    public static function getOne($id) {
        $db = static::getDB();

        $stmt = $db->prepare('
            SELECT * FROM messages
            WHERE messages.id = ? 
            LIMIT 1');

        $stmt->execute([$id]);

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function createMessage($data) {
        $db = static::getDB();
        $stmt = $db->prepare('INSERT INTO messages(id_article, email, id_receiver, messages) VALUES (:article, :mail, :receiver,:messages)');

        $stmt->bindParam(':article', $data['id_article']);
        $stmt->bindParam(':mail', $data['mail']);
        $stmt->bindParam(':receiver', $data['id_receiver']);
        $stmt->bindParam(':messages', $data['message']);
        $stmt->execute();

        return $db->lastInsertId();
    }

}
