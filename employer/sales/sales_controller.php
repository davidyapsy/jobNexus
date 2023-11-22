<?php


class ConnectionString
{

    /**
     * @var String
     */
    private $serverName;
    /**
     * @var String
     */
    private $userName;
    /**
     * @var String
     */
    private $password;
    /**
     * @var String
     */
    private $database;

    /**
     * @return String
     */
    public function getServerName(): string
    {
        return $this->serverName;
    }

    /**
     * @param String $serverName
     * @return ConnectionString
     */
    public function setServerName(string $serverName): ConnectionString
    {
        $this->serverName = $serverName;
        return $this;
    }

    /**
     * @return String
     */
    public function getUserName(): string
    {
        return $this->userName;
    }

    /**
     * @param String $userName
     * @return ConnectionString
     */
    public function setUserName(string $userName): ConnectionString
    {
        $this->userName = $userName;
        return $this;
    }

    /**
     * @return String
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param String $password
     * @return ConnectionString
     */
    public function setPassword(string $password): ConnectionString
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return String
     */
    public function getDatabase(): string
    {
        return $this->database;
    }

    /**
     * @param String $database
     * @return ConnectionString
     */
    public function setDatabase(string $database): ConnectionString
    {
        $this->database = $database;
        return $this;
    }


}

class SalesModel
{
    private String $saleID;
    private String $paymentID;
    private float $saleDateTime;
    private float $subtotalAmount;
    private float $taxAmount;
    private float $totalAmount;

    public function getSaleID(): String {
        return $this->saleID;
    }
    
    public function setSaleID(String $saleID): SalesModel {
        $this->saleID = $saleID;
        return $this;
    }
    
    public function getPaymentID(): String {
        return $this->paymentID;
    }
    
    public function setPaymentID(String $paymentID): SalesModel {
        $this->paymentID = $paymentID;
        return $this;
    }
    
    public function getSaleDateTime(): String {
        return $this->saleDateTime;
    }
    
    public function setSaleDateTime(String $saleDateTime): SalesModel {
        $this->saleDateTime = $saleDateTime;
        return $this;
    }
    
    public function getSubtotalAmount(): float {
        return $this->subtotalAmount;
    }
    
    public function setSubtotalAmount(float $subtotalAmount): SalesModel {
        $this->subtotalAmount = $subtotalAmount;
        return $this;
    }
    
    public function getTaxAmount(): float {
        return $this->taxAmount;
    }
    
    public function setTaxAmount(float $taxAmount): SalesModel {
        $this->taxAmount = $taxAmount;
        return $this;
    }
    
    public function getTotalAmount(): float {
        return $this->totalAmount;
    }
    
    public function setTotalAmount(float $totalAmount): SalesModel {
        $this->totalAmount = $totalAmount;
        return $this;
    }
    
}

//

/**
 * most common people will use enum for static value . php can be use interface or class
 * the point here to store one place all the string  value
 */
interface  ReturnCode
{
    // const ACCESS_GRANTED = "200";

    const CONNECTION_ERROR = "001";

    const ACCESS_DENIED_NO_MODE = "Cannot identify mode ";

    const ACCESS_DENIED = 500;

    const CREATE_SUCCESS = 101;

    const READ_SUCCESS = 201;

    const UPDATE_SUCCESS = 301;

    const DELETE_SUCCESS = 401;

    const QUERY_FAILURE = 601;
}

class SalesOop
{
    private ConnectionString $connectionString;
    private SalesModel $model;
    private mysqli $connection;

    /**
     * SimpleOop constructor.
     * @throws Exception
     */
    function __construct()
    {
        // declare object / injection
        $this->model = new SalesModel();
        $this->connectionString = new ConnectionString();

        // connection to the database
        try {
            $this->connect();
        } catch (Exception $exception) {
            // the more proper is to send exception to a file list / or table and send to end user .System fail to access
            throw new Exception($exception->getMessage(), ReturnCode::CONNECTION_ERROR);
        }
        // all parameter value at here and bind to the model the value
        $this->setParameter();
    }

    /**
     * Connection to the database
     * @throws Exception
     */
    function connect()
    {
        // init value , this may diff with your setup. the proper is to create a file outside from the www folder so outsider
        // cannot get access to the file .
        $this->connectionString->setServerName("localhost");
        $this->connectionString->setUserName("root");
        $this->connectionString->setPassword("");
        $this->connectionString->setDatabase("db_jobnexus");
        try {
            $this->connection = new mysqli($this->connectionString->getServerName(), $this->connectionString->getUserName(), $this->connectionString->getPassword(), $this->connectionString->getDatabase());
        } catch (Exception $exception) {
            throw new Exception($exception);
        }
    }

    /**
     * Binding Web Parameter to model
     */
    function setParameter()
    {
        $saleID = filter_input(INPUT_POST, "saleID", FILTER_SANITIZE_STRING);
        $paymentID = filter_input(INPUT_POST, "paymentID", FILTER_SANITIZE_STRING);
        $saleDateTime = filter_input(INPUT_POST, "saleDateTime", FILTER_SANITIZE_STRING);
        $subtotalAmount = filter_input(INPUT_POST, "subtotalAmount", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $taxAmount = filter_input(INPUT_POST, "taxAmount", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $totalAmount = filter_input(INPUT_POST, "totalAmount", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

        $paymentMethod = filter_input(INPUT_POST, "paymentMethod", FILTER_SANITIZE_STRING);


        $this->model->setPaymentMethod($paymentMethod);
        $this->model->setAmount($amount);
        $this->model->setPaymentStatus($paymentStatus);
        $this->model->setPaymentDateTime($paymentDateTime);

    }

    /**
     * @throws Exception
     */
    function create()
    {
        $this->connection->autocommit(false);

        //sales
        $saleID=str_replace('P', 'S', $paymentID);
        $salesDateTime = date("Y-m-d H:i:s");
        $subtotalAmount = 49.99;
        $taxAmount = 2.5;
        $totalAmount = 52.49;

        //payment
        $tempPaymentID = "P".date('y').date('m').date('d');

        $total_data=0;
        $paymentStat = $this->connection->query("SELECT count(*) as totalRecord
                                                FROM payment
                                                WHERE paymentID LIKE '$tempPaymentID%'");
        while (($row = $paymentStat->fetch_assoc()) == TRUE) {
            $total_data = $row['totalRecord'];
        }
        
        //new paymentID
        $paymentID=$tempPaymentID."000";
        if($total_data > 0){
            $result = $this->connection->query("SELECT paymentID
                                                FROM payment
                                                ORDER BY paymentID ASC");
            while (($row = $result->fetch_assoc()) == TRUE) {
                if(substr($row['paymentID'], 0, 7)==$tempPaymentID){
                    $paymentID = $row['paymentID'];
                }
            }
            $newNumber = (int)(substr($paymentID, 7)) + 1;
            $newNumber = sprintf('%03d', $newNumber);
            $paymentID = $tempPaymentID.$newNumber;
        }

        //insert into db
        if (strlen($paymentID) > 0 && $amount > 0 &&  strlen($paymentStatus) > 0 &&  strlen($paymentDateTime) > 0) {
            $statement = $this->connection->prepare("INSERT INTO payment VALUES (?, ?, ?, ?, ?)");
            $statement->bind_param("ssdss", $paymentID, $paymentMethod, $amount, $paymentStatus, $paymentDateTime);
            
            try {
                $statement->execute();
            } catch (Exception $exception) {
                throw new Exception($exception->getMessage(), ReturnCode::QUERY_FAILURE);
            }
            $this->connection->commit();

            echo json_encode(
                [
                    "status" => true,
                    "code" => ReturnCode::CREATE_SUCCESS
                ]
            );

        } else {
            throw new Exception(ReturnCode::ACCESS_DENIED);
        }
    }

    /**
     * @throws Exception
     */
    function search(){
        // Implement search code
    }

    /**
     * @throws Exception
     */
    function update()
    {
        // Implement update code
    }

    /**
     * @throws Exception
     */
    function delete()
    {
        // Implement delete code
    }   
}

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *"); // this is to prevent from javascript given cors error

$mode = filter_input(INPUT_POST, "mode", FILTER_SANITIZE_STRING);

$jobPostingOop = new SalesOop();
try {
    switch ($mode) {
        case  "create":
            $jobPostingOop->create();
            break;
        case  "search":
            $jobPostingOop->search();
            break;
        case  "update":
            $jobPostingOop->update();
            break;
        case  "delete":
            $jobPostingOop->delete();
            break;
        default:
            throw new Exception(ReturnCode::ACCESS_DENIED_NO_MODE, ReturnCode::ACCESS_DENIED);
            break;
    }
} catch (Exception $exception) {
    echo json_encode([
        "status" => false,
        "message" => "post".$exception->getMessage(),
        "code" => $exception->getCode()
    ]);
}
