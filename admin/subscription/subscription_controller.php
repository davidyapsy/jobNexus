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

        $page = filter_input(INPUT_POST, "page", FILTER_SANITIZE_NUMBER_INT);

        if(filter_input(INPUT_POST, "mode", FILTER_SANITIZE_STRING) == "create"){

        }else if(filter_input(INPUT_POST, "mode", FILTER_SANITIZE_STRING) == "update"){
            $this->model->setSubscriptionID($subscriptionID);
            $this->model->setAutoRenewal($autoRenewal);
        }else if(filter_input(INPUT_POST, "mode", FILTER_SANITIZE_STRING) == "check_validation"){

        }else if(filter_input(INPUT_POST, "mode", FILTER_SANITIZE_STRING) == "search"){
            $this->setPage($page);
            $this->model->setSubscriptionPlanID($subscriptionPlanID);
            $this->setStartDateFrom($startDateFrom);
            $this->setStartDateTo($startDateTo);
            $this->setEndDateFrom($endDateFrom);
            $this->setEndDateTo($endDateTo);
            $this->model->setAutoRenewal($autoRenewal);

        }       
    }

    /**
     * @throws Exception
     */
    function create()
    {
        $this->connection->autocommit(false);

        $employerID = $this->model->getEmployerID();
        $jobCategoryID = $this->model->getJobCategoryID();
        $jobTitle = $this->model->getJobTitle();
        $jobDescription = $this->model->getJobDescription();
        $jobRequirement = $this->model->getJobRequirement();
        $jobHighlight= $this->model->getJobHighlight();
        $experienceLevel= $this->model->getExperienceLevel();
        $locationState = $this->model->getLocationState();
        $salary = $this->model->getSalary();
        $employmentType = $this->model->getEmploymentType();
        $applicationDeadline= $this->model->getApplicationDeadline();
        $isPublish= $this->model->getIsPublish();
        $publishDate= $this->model->getPublishDate();
        $isDeleted = 0;

        //assign new job posting id
        $year = "00";
        $month= "00";
        $day  = "00";
        if($publishDate!=""){
            $year=substr($publishDate, 2,2);
            $month=substr($publishDate, 5,2);
            $day = substr($publishDate, 8,2);
        }
        $tempID = "JP".$year.$month.$day;
        $currentID = $tempID."0000";

        //get number of records
        $total_data=0;
        $stat = $this->connection->query("SELECT count(*) as totalRecord
                                                FROM job_posting
                                                WHERE employerID='$employerID'");
        while (($row = $stat->fetch_assoc()) == TRUE) {
            $total_data = $row['totalRecord'];
        }

        //employerID
        if($total_data > 0){
            $result = $this->connection->query("SELECT jobPostingID
                                                FROM job_posting
                                                WHERE employerID='$employerID'
                                                ORDER BY jobPostingID ASC");
            while (($row = $result->fetch_assoc()) == TRUE) {
                if(substr($row['jobPostingID'], 0, 8)==$tempID){
                    $currentID = $row['jobPostingID'];
                }
            }
        }

        $newNumber = (int)(substr($currentID, 8)) + 1;
        $newNumber = sprintf('%04d', $newNumber);
        $newID = $tempID.$newNumber;

        //insert into db
        if (strlen($jobCategoryID) > 0 &&  strlen($jobTitle) > 0 &&  strlen($jobDescription) > 0 &&  strlen($jobRequirement) > 0 &&  strlen($locationState) > 0 &&  strlen($employmentType) > 0) {
            $statement = $this->connection->prepare("INSERT INTO job_posting VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $statement->bind_param("sssssssssdssssi", $employerID, $newID, $jobCategoryID, $jobTitle, $jobDescription, $jobRequirement, $jobHighlight, $experienceLevel, $locationState, 
                                                        $salary, $employmentType, $applicationDeadline, $isPublish, $publishDate, $isDeleted);
            
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

        $jobCategoryID = $this->model->getJobCategoryID();
        $jobTitle = $this->model->getJobTitle();
        $jobDescription = $this->model->getJobDescription();
        $jobRequirement = $this->model->getJobRequirement();
        $locationState = $this->model->getLocationState();
        $employmentType = $this->model->getEmploymentType();
        $isPublish = $this->model->getIsPublish();
        $applicationDeadline = date('Y-m-d', strtotime(str_replace('-', '/', $this->model->getApplicationDeadline())));
        $i=0;
        
        //null checking
        if($jobCategoryID==""){
            $datas[$i]['inputName']="jobCategory";
            $datas[$i]['errorMessage']="Job Category is required";
            $i++;
        }
        if($jobTitle==""){
            $datas[$i]['inputName']="jobTitle";
            $datas[$i]['errorMessage']="Job Title is required";
            $i++;
        }
        if($jobDescription==""){
            $datas[$i]['inputName']="jobDescription";
            $datas[$i]['errorMessage']="Job Description is required";
            $i++;
        }
        if($jobRequirement==""){
            $datas[$i]['inputName']="jobRequirement";
            $datas[$i]['errorMessage']="Job Requirement is required";
            $i++;
        }
        if($locationState==""){
            $datas[$i]['inputName']="locationState";
            $datas[$i]['errorMessage']="State is required";
            $i++;
        }
        if($employmentType==""){
            $datas[$i]['inputName']="employmentType";
            $datas[$i]['errorMessage']="Employment Type is required";
            $i++;
        }
        if($isPublish == "Published" && $applicationDeadline < date("Y-m-d")){
            $datas[$i]['inputName']="applicationDeadline";
            $datas[$i]['errorMessage']="Application Deadline must be larger than today's date";
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

}

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *"); // this is to prevent from javascript given cors error

$mode = filter_input(INPUT_POST, "mode", FILTER_SANITIZE_STRING);

$jobPostingOop = new SubscriptionOop();
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
        case "check_validation":
            $jobPostingOop->check_validation();
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
