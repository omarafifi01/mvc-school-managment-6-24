<?php
class Payment {
    private $conn;

    public $paymentId;
    public $studentId;
    public $amount;
    public $datePaid;
    public $description;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllPayments() {
        $query = "SELECT * FROM Payments";
        $result = $this->conn->query($query);

        if (!$result) {
            die("Query failed: " . $this->conn->error);
        }

        return $result;
    }

    public function addPayment() {
        $query = "INSERT INTO Payments (StudentID, Amount, DatePaid, Description) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        if ($stmt === false) {
            throw new Exception("Error preparing query: " . $this->conn->error);
        }

        $stmt->bind_param('idss', $this->studentId, $this->amount, $this->datePaid, $this->description);
        $result = $stmt->execute();

        if ($result === false) {
            throw new Exception("Error executing query: " . $stmt->error, $stmt->errno);
        }

        return $result;
    }

    public function updatePayment() {
        $query = "UPDATE Payments SET StudentID = ?, Amount = ?, DatePaid = ?, Description = ? WHERE PaymentID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('idssi', $this->studentId, $this->amount, $this->datePaid, $this->description, $this->paymentId);
        $result = $stmt->execute();

        if ($result === false) {
            throw new Exception("Error executing query: " . $stmt->error, $stmt->errno);
        }

        return $result;
    }

    public function deletePayment() {
        $query = "DELETE FROM Payments WHERE PaymentID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $this->paymentId);
        $result = $stmt->execute();

        if ($result === false) {
            throw new Exception("Error executing query: " . $stmt->error, $stmt->errno);
        }

        return $result;
    }
}
?>
