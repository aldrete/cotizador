<?php
    class Usuario {
    private $conn;
    private $table = 'usuarios';

    public $id;
    public $nombre_usuario;
    public $contrasena;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = 'SELECT id,nombre_usuario, contrasena
                    FROM ' . $this->table .'';

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    public function read_single() {
        $query = 'SELECT  id,nombre_usuario, contrasena
                    FROM ' . $this->table . '
                    WHERE
                    id = ?
                    LIMIT 0,1';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $row['id'];
        $this->nombre_usuario = $row['nombre_usuario'];
        $this->contrasena = $row['contrasena'];

    }

    public function create() {

        $query = 'INSERT INTO ' . $this->table . ' SET nombre_usuario = :nombre_usuario, contrasena = :contrasena';

        $stmt = $this->conn->prepare($query);

        $this->nombre_usuario = htmlspecialchars(strip_tags($this->nombre_usuario));
        $this->contrasena = htmlspecialchars(strip_tags($this->contrasena));

        $stmt->bindParam(':nombre_usuario', $this->nombre_usuario);
        $stmt->bindParam(':contrasena', $this->contrasena);

        if($stmt->execute()) {
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    public function update() {

        $query = 'UPDATE ' . $this->table . '
                SET nombre_usuario = :nombre_usuario, contrasena = :contrasena
                WHERE id = :id';

        $stmt = $this->conn->prepare($query);

        $this->nombre_usuario = htmlspecialchars(strip_tags($this->nombre_usuario));
        $this->contrasena = htmlspecialchars(strip_tags($this->contrasena));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':nombre_usuario', $this->nombre_usuario);
        $stmt->bindParam(':contrasena', $this->contrasena);
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()) {
            return true;
        }
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    public function delete() {

        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()) {
            return true;
        }

        printf("Error: %s.\n", $stmt->error);

        return false;
    }
    function login($nombre_usuario, $contrasena){

        $query = 'SELECT *
                FROM ' . $this->table . '
                WHERE
                nombre_usuario = "'.$nombre_usuario.'"
                AND contrasena = "'.$contrasena.'"
                LIMIT 0,1';

        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        $num = $stmt->rowCount();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($num>0){
            $this->id = $row['id'];
            $this->nombre_usuario = $row['nombre_usuario'];
            $this->contrasena = $row['contrasena'];
            return true;
        }else{
            return false;
        }
    }
}
