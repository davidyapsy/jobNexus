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

class SubscriptionModel
{
    private String $subscriptionID;
    private String $saleID;
    private String $subscriptionPlanID;
    private String $employerID;
    private String $startDate;
    private String $endDate;
    private int $autoRenewal;

    public function getSubscriptionID(): String {
        return $this->subscriptionID;
    }
    
    public function setSubscriptionID(String $subscriptionID): SubscriptionModel {
        $this->subscriptionID = $subscriptionID;
        return $this;
    }
    
    public function getSaleID(): String {
        return $this->saleID;
    }
    
    public function setSaleID(String $saleID): SubscriptionModel {
        $this->saleID = $saleID;
        return $this;
    }
    
    public function getSubscriptionPlanID(): String {
        return $this->subscriptionPlanID;
    }
    
    public function setSubscriptionPlanID(String $subscriptionPlanID): SubscriptionModel {
        $this->subscriptionPlanID = $subscriptionPlanID;
        return $this;
    }
    
    public function getEmployerID(): String {
        return $this->employerID;
    }
    
    public function setEmployerID(String $employerID): SubscriptionModel {
        $this->employerID = $employerID;
        return $this;
    }
    
    public function getStartDate(): String {
        return $this->startDate;
    }
    
    public function setStartDate(String $startDate): SubscriptionModel {
        $this->startDate = $startDate;
        return $this;
    }
    
    public function getEndDate(): String {
        return $this->endDate;
    }
    
    public function setEndDate(String $endDate): SubscriptionModel {
        $this->endDate = $endDate;
        return $this;
    }
    
    public function getAutoRenewal(): int {
        return $this->autoRenewal;
    }
    
    public function setAutoRenewal(int $autoRenewal): SubscriptionModel {
        $this->autoRenewal = $autoRenewal;
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

class SubscriptionOop
{
    private ConnectionString $connectionString;
    private SubscriptionModel $model;
    private mysqli $connection;

    private $startDateFrom;
    private $startDateTo;
    private $endDateFrom;
    private $endDateTo;
    private $totalAmount;
    private $taxAmount;
    private $subtotalAmount;
    private $paymentMethod;
    private $page;

    public function getStartDateFrom(): String
    {
        return $this->startDateFrom;
    }

    public function setStartDateFrom($startDateFrom=""): SubscriptionOop
    {
        $this->startDateFrom = $startDateFrom;
        return $this;
    }

    public function getStartDateTo(): String
    {
        return $this->startDateTo;
    }

    public function setStartDateTo($startDateTo=""): SubscriptionOop
    {
        $this->startDateTo = $startDateTo;
        return $this;
    }

    public function getEndDateFrom(): String
    {
        return $this->endDateFrom;
    }

    public function setEndDateFrom($endDateFrom=""): SubscriptionOop
    {
        $this->endDateFrom = $endDateFrom;
        return $this;
    }

    public function getEndDateTo(): String
    {
        return $this->endDateTo;
    }

    public function setEndDateTo($endDateTo=""): SubscriptionOop
    {
        $this->endDateTo = $endDateTo;
        return $this;
    }

    public function getTotalAmount(): float
    {
        return $this->totalAmount;
    }

    public function setTotalAmount($totalAmount=0): SubscriptionOop
    {
        $this->totalAmount = $totalAmount;
        return $this;
    }

    public function getTaxAmount(): float
    {
        return $this->taxAmount;
    }

    public function setTaxAmount($taxAmount=0): SubscriptionOop
    {
        $this->taxAmount = $taxAmount;
        return $this;
    }

    public function getSubtotalAmount(): float
    {
        return $this->subtotalAmount;
    }

    public function setSubtotalAmount($subtotalAmount=0): SubscriptionOop
    {
        $this->subtotalAmount = $subtotalAmount;
        return $this;
    }

    public function getPaymentMethod(): String
    {
        return $this->paymentMethod;
    }

    public function setPaymentMethod($paymentMethod=""): SubscriptionOop
    {
        $this->paymentMethod = $paymentMethod;
        return $this;
    }

    public function getPage()
    {
        return $this->page;
    }

    public function setPage($page=NULL): SubscriptionOop
    {
        $this->page = $page;
        return $this;
    }

    /**
     * SimpleOop constructor.
     * @throws Exception
     */
    function __construct()
    {
        // declare object / injection
        $this->model = new SubscriptionModel();
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
        $subscriptionID = base64_decode(filter_input(INPUT_POST, "subscriptionID", FILTER_SANITIZE_STRING));
        $saleID = base64_decode(filter_input(INPUT_POST, "saleID", FILTER_SANITIZE_STRING));
        $subscriptionPlanID = base64_decode(filter_input(INPUT_POST, "subscriptionPlanID", FILTER_SANITIZE_STRING));
        $employerID = "E2300000";
        $startDate = filter_input(INPUT_POST, "startDate", FILTER_SANITIZE_STRING);
        $endDate = filter_input(INPUT_POST, "endDate", FILTER_SANITIZE_STRING);
        $autoRenewal = filter_input(INPUT_POST, "autoRenewal", FILTER_SANITIZE_NUMBER_INT);
        
        $startDateFrom = filter_input(INPUT_POST, "startDateFrom", FILTER_SANITIZE_STRING);
        $startDateTo = filter_input(INPUT_POST, "startDateTo", FILTER_SANITIZE_STRING);
        $endDateFrom = filter_input(INPUT_POST, "endDateFrom", FILTER_SANITIZE_STRING);
        $endDateTo = filter_input(INPUT_POST, "endDateTo", FILTER_SANITIZE_STRING);
        $subtotalAmount = filter_input(INPUT_POST, "subtotalAmount", FILTER_SANITIZE_STRING);
        $taxAmount = filter_input(INPUT_POST, "taxAmount", FILTER_SANITIZE_STRING);
        $totalAmount = filter_input(INPUT_POST, "totalAmount", FILTER_SANITIZE_STRING);
        $paymentMethod = filter_input(INPUT_POST, "paymentMethod", FILTER_SANITIZE_STRING);

        $page = filter_input(INPUT_POST, "page", FILTER_SANITIZE_NUMBER_INT);

        if(filter_input(INPUT_POST, "mode", FILTER_SANITIZE_STRING) == "create"){
            $this->model->setEmployerID($employerID);
            $this->model->setSubscriptionPlanID($subscriptionPlanID);
            $this->model->setStartDate($startDate);
            $this->model->setEndDate($endDate);
            $this->model->setAutoRenewal($autoRenewal);
            $this->setSubtotalAmount($subtotalAmount);
            $this->setTaxAmount($taxAmount);
            $this->setTotalAmount($totalAmount);
            $this->setPaymentMethod($paymentMethod);

        }else if(filter_input(INPUT_POST, "mode", FILTER_SANITIZE_STRING) == "update"){
            $this->model->setSubscriptionID($subscriptionID);
            $this->model->setAutoRenewal($autoRenewal);
        }else if(filter_input(INPUT_POST, "mode", FILTER_SANITIZE_STRING) == "check_validation"){
            $this->model->setStartDate($startDate);
            $this->setPaymentMethod($paymentMethod);
        }else if(filter_input(INPUT_POST, "mode", FILTER_SANITIZE_STRING) == "search"){
            $this->setPage($page);
            $this->model->setSubscriptionPlanID($subscriptionPlanID);
            $this->setStartDateFrom($startDateFrom);
            $this->setStartDateTo($startDateTo);
            $this->setEndDateFrom($endDateFrom);
            $this->setEndDateTo($endDateTo);
            $this->model->setAutoRenewal($autoRenewal);
        }elseif(filter_input(INPUT_POST, "mode", FILTER_SANITIZE_STRING) == "make_payment"){
            $this->model->setSubscriptionPlanID($subscriptionPlanID);
            $this->model->setStartDate($startDate);
            $this->model->setEndDate($endDate);
            $this->model->setAutoRenewal($autoRenewal);
            $this->setPaymentMethod($paymentMethod);

        }
    }

    /**
     * @throws Exception
     */
    function create()
    {
        $this->connection->autocommit(false);

        $employerID = $this->model->getEmployerID();
        $subscriptionPlanID = $this->model->getSubscriptionPlanID();
        $startDate = $this->model->getStartDate();
        $endDate = $this->model->getEndDate();
        $autoRenewal = $this->model->getAutoRenewal();

        $tempSubscriptionID = "SB".date('y', strtotime($startDate)).date('y', strtotime($endDate));

        //get number of records
        $total_data=0;
        $subscriptionStat = $this->connection->query("SELECT count(*) as totalRecord
                                                FROM subscription
                                                WHERE YEAR(startDate) = '".date('Y', strtotime($startDate))."'");
        while (($row = $subscriptionStat->fetch_assoc()) == TRUE) {
            $total_data = $row['totalRecord'];
        }
        
        //new subscriptionID
        $subscriptionID=$tempSubscriptionID."00000";
        if($total_data > 0){
            $result = $this->connection->query("SELECT subscriptionID
                                                FROM subscription
                                                ORDER BY subscriptionID ASC");
            while (($row = $result->fetch_assoc()) == TRUE) {
                if(substr($row['subscriptionID'], 0, 6)==$tempSubscriptionID){
                    $subscriptionID = $row['subscriptionID'];
                }
            }
            $newNumber = (int)(substr($subscriptionID, 8)) + 1;
            $newNumber = sprintf('%05d', $newNumber);
            $subscriptionID = $tempSubscriptionID.$newNumber;
        }

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

        $paymentMethod = $this->getPaymentMethod();
        $amount = $this->getTotalAmount();
        $paymentStatus = "Completed";
        $paymentDateTime = date("Y-m-d H:i:s");

        //sales
        $saleID=str_replace('P', 'S', $paymentID);
        $salesDateTime = date("Y-m-d H:i:s");
        $subtotalAmount = $this->getSubtotalAmount();
        $taxAmount = $this->getTaxAmount();
        $totalAmount = $this->getTotalAmount();

        //insert into db
        if (strlen($paymentID) > 0 &&  strlen($saleID) > 0 &&  strlen($subscriptionID) > 0 &&  strlen($startDate) > 0) {
            $statement = $this->connection->prepare("INSERT INTO payment VALUES (?, ?, ?, ?, ?)");
            $statement->bind_param("ssdss", $paymentID, $paymentMethod, $amount, $paymentStatus, $paymentDateTime);
            
            try {
                $statement->execute();
            } catch (Exception $exception) {
                throw new Exception($exception->getMessage(), ReturnCode::QUERY_FAILURE);
            }
            $this->connection->commit();

            $statement = $this->connection->prepare("INSERT INTO sales VALUES(?, ?, ?, ?, ?, ?)");
            $statement->bind_param("sssddd", $saleID, $paymentID, $salesDateTime, $subtotalAmount, $taxAmount, $totalAmount);
            
            try {
                $statement->execute();
            } catch (Exception $exception) {
                throw new Exception($exception->getMessage(), ReturnCode::QUERY_FAILURE);
            }
            $this->connection->commit();

            $statement = $this->connection->prepare("INSERT INTO subscription VALUES (?, ?, ?, ?, ?, ?, ?)");
            $statement->bind_param("ssssssi", $subscriptionID, $saleID, $subscriptionPlanID, $employerID, $startDate, $endDate, $autoRenewal);
            
            try {
                $statement->execute();
            } catch (Exception $exception) {
                throw new Exception($exception->getMessage(), ReturnCode::QUERY_FAILURE);
            }

            $this->connection->commit();
            echo json_encode(
                [
                    "status" => true,
                    "code" => ReturnCode::CREATE_SUCCESS,
                    "subscriptionID" => $subscriptionID,
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
        $data = array();
        $limit = 5;
        $page = $this->getPage();

        if($page > 1) {
            $start = (($page - 1) * $limit);
            $page = $page;
        } else {
            $start = 0;
        }

        // you don't need to commit work here ya !
        $subscriptionPlanID = $this->model->getSubscriptionPlanID();
        $startDateFrom = $this->getStartDateFrom();
        $startDateTo = $this->getStartDateTo();
        $endDateFrom = $this->getEndDateFrom();
        $endDateTo = $this->getEndDateTo();
        $autoRenewal = $this->model->getAutoRenewal();

        $sql = "SELECT subscriptionID, planName, startDate, endDate, autoRenewal
        FROM subscription A
        JOIN subscription_plan B ON A.subscriptionPlanID = B.subscriptionPlanID";

        $filter_options ="";
        if($subscriptionPlanID!=""){
            $filter_options.=" AND A.subscriptionPlanID = '$subscriptionPlanID'";
        }
        if($startDateFrom!= NULL){
            $filter_options.=" AND A.startDate >= $startDateFrom";
        }
        if($startDateTo!= NULL){
            $filter_options.=" AND A.startDate <= $startDateTo";
        }
        if($endDateFrom!= NULL){
            $filter_options.=" AND A.endDate >= $endDateFrom";
        }
        if($endDateTo!= NULL){
            $filter_options.=" AND A.endDate <= $endDateTo";
        }
        if($autoRenewal!=2){
            $filter_options.=" AND A.autoRenewal = '$autoRenewal'";
        }
        $sql.=$filter_options;


        $total_data=0;
        $statement = $this->connection->query("SELECT count(*) as totalRecord
                                                FROM subscription A
                                                JOIN subscription_plan B ON A.subscriptionPlanID = B.subscriptionPlanID". $filter_options);

        while (($row = $statement->fetch_assoc()) == TRUE) {
            $total_data = $row['totalRecord'];
        }

        $filter_query = $sql . ' LIMIT ' . $start . ', ' . $limit . '';
        $stat = $this->connection->prepare($filter_query);
        $stat->execute();
        $result = $stat->get_result();
        $data = [];
            while (($row = $result->fetch_assoc()) == TRUE) {
                $data[] = $row;
            }

        $pagination_html = '
        <div align="center">
            <ul class="pagination justify-content-center">
        ';

        $total_links = ceil($total_data/$limit);
        $previous_link = '';
        $next_link = '';
        $page_link = '';

        if($total_links > 4){
            if($page < 5){
                for($count = 1; $count <= 5; $count++)
                {
                    $page_array[] = $count;
                }
                $page_array[] = '...';
                $page_array[] = $total_links;
            }else{
                $end_limit = $total_links - 5;

                if($page > $end_limit)
                {
                    $page_array[] = 1;
                    $page_array[] = '...';

                    for($count = $end_limit; $count <= $total_links; $count++)
                    {
                        $page_array[] = $count;
                    }
                }
                else
                {
                    $page_array[] = 1;
                    $page_array[] = '...';

                    for($count = $page - 1; $count <= $page + 1; $count++)
                    {
                        $page_array[] = $count;
                    }

                    $page_array[] = '...';
                    $page_array[] = $total_links;
                }
            }
        }else{
            for($count = 1; $count <= $total_links; $count++){
                $page_array[] = $count;
            }
        }

        if($total_links!=0){
            for($count = 0; $count < count($page_array); $count++)
            {
                if($page == $page_array[$count]){
                    $page_link .= '
                    <li class="page-item active">
                        <a class="page-link" href="#">'.$page_array[$count].' </a>
                    </li>
                    ';

                    $previous_id = $page_array[$count] - 1;

                    if($previous_id > 0){
                        $previous_link = '<li class="page-item"><a class="page-link" href="javascript:load_data('.$previous_id.')">Previous</a></li>';
                    }else{
                        $previous_link = '
                        <li class="page-item disabled">
                            <a class="page-link" href="#">Previous</a>
                        </li>
                        ';
                    }

                    $next_id = $page_array[$count] + 1;

                    if($next_id > $total_links){
                        $next_link = '
                        <li class="page-item disabled">
                            <a class="page-link" href="#">Next</a>
                        </li>
                        ';
                    }else{
                        $next_link = '
                        <li class="page-item"><a class="page-link" href="javascript:load_data('.$next_id.')">Next</a></li>
                        ';
                    }
                }
                else{
                    if($page_array[$count] == '...')
                    {
                        $page_link .= '
                        <li class="page-item disabled">
                            <a class="page-link" href="#">...</a>
                        </li>
                        ';
                    }
                    else
                    {
                        $page_link .= '
                        <li class="page-item">
                            <a class="page-link" href="javascript:load_data('.$page_array[$count].')">'.$page_array[$count].'</a>
                        </li>
                        ';
                    }
                }
            }

            $pagination_html .= $previous_link . $page_link . $next_link;
        }
        $pagination_html .= '
            </ul>
        </div>
        ';

        $output = array(
            'data'				=>	$data,
            'pagination'		=>	$pagination_html,
            'total_data'		=>	$total_data,
            'status'            =>  true
        );

        echo json_encode($output);
    }

    /**
     * @throws Exception
     */
    function update()
    {
        $this->connection->autocommit(false);

        $subscriptionID = $this->model->getSubscriptionID();
        $autoRenewal = $this->model->getAutoRenewal();

        //insert into db
        if (strlen($subscriptionID) > 0) {
            $statement = $this->connection->prepare("UPDATE subscription 
                                                    SET autoRenewal = ?
                                                    WHERE subscriptionID = ?");

            $statement->bind_param("is", $autoRenewal, $subscriptionID);

            try {
                $statement->execute();
            } catch (Exception $exception) {
                throw new Exception($exception->getMessage(), ReturnCode::QUERY_FAILURE);
            }

            $this->connection->commit();
            echo json_encode(
                [
                    "status" => true,
                    "code" => ReturnCode::UPDATE_SUCCESS,
                ]
            );

        } else {
            throw new Exception(ReturnCode::ACCESS_DENIED);
        }
    }

    /**
     * @throws Exception
     */
    function delete()
    {
        $this->connection->autocommit(false);

        $jobPostingID = $this->model->getJobPostingID();

        if ($jobPostingID > 0) {
            $statement = $this->connection->prepare("UPDATE job_posting SET isDeleted = 1
                WHERE jobPostingID = ? ");
            $statement->bind_param("s", $jobPostingID);
            try {
                $statement->execute();
            } catch (Exception $exception) {
                throw new Exception($exception->getMessage(), ReturnCode::QUERY_FAILURE);
            }

            $this->connection->commit();
            echo json_encode(
                [
                    "status" => true,
                    "code" => ReturnCode::DELETE_SUCCESS
                ]
            );

        } else {
            throw new Exception(ReturnCode::ACCESS_DENIED);
        }
    }   

    function check_validation(){
        $datas[]['inputName']="";
        $datas[]['errorMessage']="";

        $startDate = date('Y-m-d', strtotime(str_replace('-', '/', $this->model->getStartDate())));
        $paymentMethod = $this->getPaymentMethod();
        $i=0;
        
        //null checking
        if($startDate == "1970-01-01"){
            $datas[$i]['inputName']="startDate";
            $datas[$i]['errorMessage']="Start Date is required";
            $i++;
        }

        if($paymentMethod == ""){
            $datas[$i]['inputName']="paymentMethod";
            $datas[$i]['errorMessage']="Payment Method is required";
            $i++;
        }

        if($i>0){
            echo json_encode(
                [
                    "status" => false,
                    "data" => $datas
                ]
            );
        } else{
            echo json_encode(
                [
                    "status" => true,
                ]
            );
        }
    }

    function make_payment(){
        $itemName = "";
        $itemAmount = 0;
        $subscriptionPlanID=$this->model->getSubscriptionPlanID();
        $startDate=$this->model->getStartDate();
        $endDate=$this->model->getEndDate();
        $autoRenewal=$this->model->getAutoRenewal();
        $paymentMethod=$this->getPaymentMethod();

        $html_query = "&startDate=$startDate&endDate=$endDate&autoRenewal=$autoRenewal&paymentMethod=$paymentMethod";

        $paypalConfig = [
            'email' => 'jobnexus2@gmail.com',
            'return_url' => 'http://localhost/jobnexus/employer/subscription/subscription_order_summary.php?id='.base64_encode($subscriptionPlanID).'&status=success'.$html_query,
            'cancel_url' => 'http://localhost/jobnexus/employer/subscription/subscription_order_summary.php?id='.base64_encode($subscriptionPlanID).'&status=failed',
            'notify_url' => 'http://localhost/jobnexus/employer/subscription/subscription_index.php'
        ];
        
        $paypalUrl =  'https://www.sandbox.paypal.com/cgi-bin/webscr';

        $statement = $this->connection->query("SELECT planName, price
                                                FROM subscription_plan
                                                WHERE subscriptionPlanID = '$subscriptionPlanID'");

        while (($row = $statement->fetch_assoc()) == TRUE) {
            $itemName = $row['planName'];
            $itemAmount = $row['price']*1.1;
        }
        $txnID = filter_input(INPUT_POST, "txn_id", FILTER_SANITIZE_STRING);
        $txnType = filter_input(INPUT_POST, "txn_type", FILTER_SANITIZE_STRING);

        // Check if paypal request or response
        if (!isset($txnID) && !isset($txnType)) {

            // Grab the post data so that we can set up the query string for PayPal.
            // Ideally we'd use a whitelist here to check nothing is being injected into
            // our post data.
            $data = [];
            
            $data['cmd']="_xclick";
            // Set the PayPal account.
            $data['business'] = $paypalConfig['email'];

            // Set the PayPal return addresses.
            $data['return'] = stripslashes($paypalConfig['return_url']);
            $data['cancel_return'] = stripslashes($paypalConfig['cancel_url']);
            $data['notify_url'] = stripslashes($paypalConfig['notify_url']);

            // Set the details about the product being purchased, including the amount
            // and currency so that these aren't overridden by the form data.
            $data['item_name'] = $itemName;
            $data['amount'] = $itemAmount;
            $data['currency_code'] = 'MYR';

            // Add any custom fields for the query string.
            //$data['custom'] = USERID;

            // Build the query string from the data.
            $queryString = http_build_query($data);

            echo json_encode(
                [
                    "status" => true,
                    "linkAddress" => $paypalUrl . '?' . $queryString
                ]
            );

        } else {

        }
    }

}

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *"); // this is to prevent from javascript given cors error

$mode = filter_input(INPUT_POST, "mode", FILTER_SANITIZE_STRING);

$subscriptionOop = new SubscriptionOop();
try {
    switch ($mode) {
        case  "create":
            $subscriptionOop->create();
            break;
        case  "search":
            $subscriptionOop->search();
            break;
        case  "update":
            $subscriptionOop->update();
            break;
        case  "delete":
            $subscriptionOop->delete();
            break;
        case "check_validation":
            $subscriptionOop->check_validation();
            break;
        case "make_payment":
            $subscriptionOop->make_payment();
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
