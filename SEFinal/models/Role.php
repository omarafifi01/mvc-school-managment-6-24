<?php
class Role {
    public $UserTypeID;
    public $TypeName;

    public function __construct($UserTypeID, $TypeName) {
        $this->UserTypeID = $UserTypeID;
        $this->TypeName = $TypeName;
    }

    public static function getAllRoles() {
        global $conn;
        $sql = "SELECT * FROM UserTypes";
        $result = $conn->query($sql);

        $roles = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $roles[] = new Role($row['UserTypeID'], $row['TypeName']);
            }
        }
        return $roles;
    }
}
?>
