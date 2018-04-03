<?php
namespace projet4\core;

class Manager {

    /**
     * @return \PDO
     */
    public function dbConnect() {
        $db = Database::getInstance();
        $req = $db->getPDO();
        return $req;
    }

    /**
     * @param $SqlStatement
     * @param $class_name
     * @param bool $fetchOnlyOne
     * @return array|mixed
     */
    public function query($SqlStatement) {
        $req = $this->dbConnect()->query($SqlStatement);
        return $req;
    }

    /**
     * @param $SqlStatement
     * @param $attributes
     * @param bool $fetch
     * @param bool $needOnlyOne
     * @return array|bool|mixed
     * Makes a prepared request depending on whether you want to fetch or not.
     */
    public function prepare($SqlStatement, $attributes, $fetch = true, $needOnlyOne = false) {
        $req = $this->dbConnect()->prepare($SqlStatement);
        if ($fetch) {
            $req->execute($attributes);
            if ($needOnlyOne) {
                $data = $req->fetch();
            } else {
                $data = $req->fetchAll();
            }
            return $data;
        } else {
            $newContent = $req->execute($attributes);
            return $newContent;
        }
    }

}