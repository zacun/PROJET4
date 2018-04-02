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
     * @param $class_name
     * @param bool $fetchOnlyOne
     * @return array|mixed
     */
    public function prepare($SqlStatement, $attributes) {
        $req = $this->dbConnect()->prepare($SqlStatement);
        $req->execute($attributes);
        $data = $req->fetch();
        return $data;
    }

}