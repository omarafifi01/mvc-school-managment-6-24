<?php
class Payment {
    public $PaymentID;
    public $StudentID;
    public $Amount;
    public $DatePaid;
    public $Description;

    public function __construct($PaymentID, $StudentID, $Amount, $DatePaid, $Description) {
        $this->PaymentID = $PaymentID;
        $this->StudentID = $StudentID;
        $this->Amount = $Amount;
        $this->DatePaid = $DatePaid;
        $this->Description = $Description;
    }

    public static function getPaymentsByStudentID($StudentID) {
        global $conn;
        $sql = "SELECT * FROM Payments WHERE StudentID = '$StudentID'";
        $result = $conn->query($sql);

        $payments = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $payments[] = new Payment($row['PaymentID'], $row['StudentID'], $row['Amount'], $row['DatePaid'], $row['Description']);
            }
        }
        return $payments;
    }
}
?>
