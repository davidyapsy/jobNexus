<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer library
require_once '../../phpMailer/src/Exception.php';
require_once '../../phpMailer/src/PHPMailer.php';
require_once '../../phpMailer/src/SMTP.php';

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

class JobPostingModel
{
    private String $employerID;
    private String $jobPostingID;
    private String $jobCategoryID;
    private String $jobTitle;
    private String $jobDescription;
    private String $jobRequirement;
    private String $jobHighlight;
    private String $experienceLevel;
    private String $locationState;
    private float $salary;
    private String $employmentType;
    private String $applicationDeadline;
    private String $isPublish;
    private String $publishDate;
    private int $isFeatured;
    private int $isDeleted;
    private String $createdAt;

    public function getEmployerID(): String{
        return $this->employerID;
    }

    public function setEmployerID(String $employerID): JobPostingModel{
        $this->employerID = $employerID;
        return $this;
    }

    public function getJobPostingID(): String
    {
        return $this->jobPostingID;
    }

    public function setJobPostingID(String $jobPostingID): JobPostingModel
    {
        $this->jobPostingID = $jobPostingID;
        return $this;
    }

    public function getJobCategoryID(): String
    {
        return $this->jobCategoryID;
    }

    public function setJobCategoryID(String $jobCategoryID): JobPostingModel
    {
        $this->jobCategoryID = $jobCategoryID;
        return $this;
    }

    public function getJobTitle(): String
    {
        return $this->jobTitle;
    }

    public function setJobTitle(String $jobTitle): JobPostingModel
    {
        $this->jobTitle = $jobTitle;
        return $this;
    }

    public function getJobDescription(): String
    {
        return $this->jobDescription;
    }

    public function setJobDescription(String $jobDescription): JobPostingModel
    {
        $this->jobDescription = $jobDescription;
        return $this;
    }

    public function getJobRequirement(): String
    {
        return $this->jobRequirement;
    }

    public function setJobRequirement(String $jobRequirement): JobPostingModel
    {
        $this->jobRequirement = $jobRequirement;
        return $this;
    }

    public function getJobHighlight(): String
    {
        return $this->jobHighlight;
    }

    public function setJobHighlight(String $jobHighlight): JobPostingModel
    {
        $this->jobHighlight = $jobHighlight;
        return $this;
    }

    public function getExperienceLevel(): String
    {
        return $this->experienceLevel;
    }

    public function setExperienceLevel(String $experienceLevel): JobPostingModel
    {
        $this->experienceLevel = $experienceLevel;
        return $this;
    }

    public function getLocationState(): String
    {
        return $this->locationState;
    }

    public function setLocationState(String $locationState): JobPostingModel
    {
        $this->locationState = $locationState;
        return $this;
    }

    public function getSalary(): String
    {
        return $this->salary;
    }

    public function setSalary(String $salary): JobPostingModel
    {
        $this->salary = $salary;
        return $this;
    }

    public function getEmploymentType(): String
    {
        return $this->employmentType;
    }

    public function setEmploymentType(String $employmentType): JobPostingModel
    {
        $this->employmentType = $employmentType;
        return $this;
    }

    public function getApplicationDeadline(): String
    {
        return $this->applicationDeadline;
    }

    public function setApplicationDeadline(String $applicationDeadline): JobPostingModel
    {
        $this->applicationDeadline = $applicationDeadline;
        return $this;
    }

    public function getIsPublish(): String
    {
        return $this->isPublish;
    }

    public function setIsPublish(String $isPublish): JobPostingModel
    {
        $this->isPublish = $isPublish;
        return $this;
    }
    
    public function getPublishDate(): String
    {
        return $this->publishDate;
    }

    public function setPublishDate(String $publishDate): JobPostingModel
    {
        $this->publishDate = $publishDate;
        return $this;
    }

    public function getIsFeatured(): int
    {
        return $this->isFeatured;
    }

    public function setIsFeatured(int $isFeatured): JobPostingModel
    {
        $this->isFeatured = $isFeatured;
        return $this;
    }

    public function getIsDeleted(): int
    {
        return $this->isDeleted;
    }

    public function setIsDeleted(int $isDeleted): JobPostingModel
    {
        $this->isDeleted = $isDeleted;
        return $this;
    }

    public function getCreatedAt(): String
    {
        return $this->createdAt;
    }

    public function setCreatedAt(String $createdAt): JobPostingModel
    {
        $this->createdAt = $createdAt;
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

class JobPostingOop
{
    private ConnectionString $connectionString;
    private JobPostingModel $model;
    private mysqli $connection;

    private $departureDay;
    private $publishDateFrom;
    private $publishDateTo;
    private $page;

    public function getDepartureDay(): String
    {
        return $this->departureDay;
    }

    public function setDepartureDay($departureDay=""): JobPostingOop
    {
        $this->departureDay = $departureDay;
        return $this;
    }

    public function getPublishDateFrom(): String
    {
        return $this->publishDateFrom;
    }

    public function setPublishDateFrom($publishDateFrom=""): JobPostingOop
    {
        $this->publishDateFrom = $publishDateFrom;
        return $this;
    }

    public function getPublishDateTo(): String
    {
        return $this->publishDateTo;
    }

    public function setPublishDateTo($publishDateTo=""): JobPostingOop
    {
        $this->publishDateTo = $publishDateTo;
        return $this;
    }

    public function getPage()
    {
        return $this->page;
    }

    public function setPage($page=NULL): JobPostingOop
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
        $this->model = new JobPostingModel();
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
        $employerID = base64_decode($_SESSION['employerID']);
        $jobPostingID =  base64_decode(filter_input(INPUT_POST, "jobPostingID", FILTER_SANITIZE_STRING));
        $jobCategoryID =  base64_decode(filter_input(INPUT_POST, "jobCategoryID", FILTER_SANITIZE_STRING));
        $jobTitle = filter_input(INPUT_POST, "jobTitle", FILTER_SANITIZE_STRING);
        $jobDescription = filter_input(INPUT_POST, "jobDescription", FILTER_SANITIZE_STRING);
        $jobRequirement = filter_input(INPUT_POST, "jobRequirement", FILTER_SANITIZE_STRING);
        $jobHighlight = filter_input(INPUT_POST, "jobHighlight", FILTER_SANITIZE_STRING);
        $experienceLevel = filter_input(INPUT_POST, "experienceLevel", FILTER_SANITIZE_STRING);
        $locationState = filter_input(INPUT_POST, "locationState", FILTER_SANITIZE_STRING);
        $salary = filter_input(INPUT_POST, "salary", FILTER_SANITIZE_NUMBER_FLOAT);
        $employmentType = filter_input(INPUT_POST, "employmentType", FILTER_SANITIZE_STRING);
        $applicationDeadline = filter_input(INPUT_POST, "applicationDeadline", FILTER_SANITIZE_STRING);
        $isPublish = filter_input(INPUT_POST, "isPublish", FILTER_SANITIZE_STRING);
        $publishDate = filter_input(INPUT_POST, "publishDate", FILTER_SANITIZE_STRING);
        $isFeatured = filter_input(INPUT_POST, "isFeatured", FILTER_SANITIZE_STRING);
        $page = filter_input(INPUT_POST, "page", FILTER_SANITIZE_NUMBER_INT);

        //
        $publishDateFrom = filter_input(INPUT_POST, "publishDateFrom", FILTER_SANITIZE_STRING);
        $publishDateTo = filter_input(INPUT_POST, "publishDateTo", FILTER_SANITIZE_STRING);
        if(filter_input(INPUT_POST, "mode", FILTER_SANITIZE_STRING) == "create"){
            $this->model->setEmployerID($employerID);
            $this->model->setJobPostingID($jobPostingID);
            $this->model->setJobCategoryID($jobCategoryID);
            $this->model->setJobTitle($jobTitle);
            $this->model->setJobDescription($jobDescription);
            $this->model->setJobRequirement($jobRequirement);
            $this->model->setJobHighlight($jobHighlight);
            $this->model->setExperienceLevel($experienceLevel);
            $this->model->setLocationState($locationState);
            $this->model->setSalary($salary);
            $this->model->setEmploymentType($employmentType);
            $this->model->setApplicationDeadline($applicationDeadline);
            $this->model->setIsPublish($isPublish);
            $this->model->setIsFeatured($isFeatured);
            if($isPublish == "Published"){
                $this->model->setPublishDate(date("Y-m-d"));
            }else{
                $this->model->setPublishDate("1970-01-01");
            }
        }else if(filter_input(INPUT_POST, "mode", FILTER_SANITIZE_STRING) == "delete"){
            $this->model->setJobPostingID($jobPostingID);
        }else if(filter_input(INPUT_POST, "mode", FILTER_SANITIZE_STRING) == "update"){
            $this->model->setEmployerID($employerID);
            $this->model->setJobPostingID($jobPostingID);
            $this->model->setJobCategoryID($jobCategoryID);
            $this->model->setJobTitle($jobTitle);
            $this->model->setJobDescription($jobDescription);
            $this->model->setJobRequirement($jobRequirement);
            $this->model->setJobHighlight($jobHighlight);
            $this->model->setExperienceLevel($experienceLevel);
            $this->model->setLocationState($locationState);
            $this->model->setSalary($salary);
            $this->model->setEmploymentType($employmentType);
            $this->model->setApplicationDeadline($applicationDeadline);
            $this->model->setIsPublish($isPublish);
            $this->model->setPublishDate($publishDate);
            $this->model->setIsFeatured($isFeatured);
        }else if(filter_input(INPUT_POST, "mode", FILTER_SANITIZE_STRING) == "check_validation"){
            $this->model->setJobPostingID($jobPostingID);
            $this->model->setJobCategoryID($jobCategoryID);
            $this->model->setJobTitle($jobTitle);
            $this->model->setJobDescription($jobDescription);
            $this->model->setJobRequirement($jobRequirement);
            $this->model->setExperienceLevel($experienceLevel);
            $this->model->setLocationState($locationState);
            $this->model->setEmploymentType($employmentType);
            $this->model->setIsPublish($isPublish);
            $this->model->setApplicationDeadline($applicationDeadline);
        }else if(filter_input(INPUT_POST, "mode", FILTER_SANITIZE_STRING) == "search"){
            $this->setPage($page);
            $this->model->setEmployerID($employerID);
            $this->model->setJobCategoryID($jobCategoryID);
            $this->model->setJobTitle($jobTitle);
            $this->model->setLocationState($locationState);
            $this->model->setSalary($salary);
            $this->model->setEmploymentType($employmentType);
            $this->model->setIsPublish($isPublish);
        }else if(filter_input(INPUT_POST, "mode", FILTER_SANITIZE_STRING) == "print_report"){
            $this->model->setEmployerID($employerID);
            $this->model->setJobCategoryID($jobCategoryID);
            $this->model->setJobTitle($jobTitle);
            $this->setPublishDateFrom($publishDateFrom);
            $this->setPublishDateTo($publishDateTo);
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
        $applicationDeadline= $this->model->getApplicationDeadline()==""?"1970-01-01":$this->model->getApplicationDeadline();
        $isPublish= $this->model->getIsPublish();
        $isFeatured= $this->model->getIsFeatured();
        $publishDate= $this->model->getPublishDate();
        $isDeleted = 0;
        $createdAt = date('Y-md-d');

        //assign new job posting id
        $year = "70";
        $month= "01";
        $day  = "01";
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
                                                WHERE employerID='$employerID' ");
        //employerID
        if($stat->num_rows > 0){
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
            $statement = $this->connection->prepare("INSERT INTO job_posting VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $statement->bind_param("sssssssssdssssiis", $employerID, $newID, $jobCategoryID, $jobTitle, $jobDescription, $jobRequirement, $jobHighlight, $experienceLevel, $locationState, 
                                                        $salary, $employmentType, $applicationDeadline, $isPublish, $publishDate, $isFeatured, $isDeleted, $createdAt);
            

            try {
                $statement->execute();
            } catch (Exception $exception) {
                throw new Exception($exception->getMessage(), ReturnCode::QUERY_FAILURE);
            }
            if($isPublish =="Published"){
                $this->send_email($jobCategoryID, $jobTitle, $employerID);
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

        // table data !
        $employerID = $this->model->getEmployerID();
        $jobCategoryID = $this->model->getJobCategoryID();
        $jobTitle = $this->model->getJobTitle();
        $locationState = $this->model->getLocationState();
        $employmentType = $this->model->getEmploymentType();
        $salary = $this->model->getSalary();
        $isPublish = $this->model->getIsPublish();

        $sql = "SELECT jobPostingID, B.categoryName, jobTitle, locationState, employmentType, salary, isPublish
        FROM job_posting A
        JOIN job_category B ON A.jobCategoryID = B.jobCategoryID
        WHERE employerID = '$employerID' AND isDeleted=0 ";

        $filter_options ="";
        if($jobCategoryID!=""){
            $filter_options.=" AND B.jobCategoryID = '$jobCategoryID'";
        }
        if($jobTitle!=""){
            $filter_options.=" AND jobTitle LIKE '%$jobTitle%'";
        }
        if($locationState!=""){
            $filter_options.=" AND locationState = '$locationState'";
        }
        if($employmentType!=""){
            $filter_options.=" AND A.employmentType = '$employmentType'";
        }
        if($salary!= NULL){
            $filter_options.=" AND A.salary >= $salary";
        }
        if($isPublish!=""){
            $filter_options.=" AND A.isPublish = '$isPublish'";
        }
        $filter_options.=" ORDER BY created_at, jobPostingID";
        $sql.=$filter_options;

        $total_data=0;
        $statement = $this->connection->query("SELECT count(*) as totalRecord
                                                FROM job_posting A
                                                JOIN job_category B ON A.jobCategoryID = B.jobCategoryID
                                                WHERE employerID='$employerID' AND isDeleted=0". $filter_options);
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
                        $previous_link = '<li class="page-item"><a class="page-link" href="Bvascript:load_data('.$previous_id.')">Previous</a></li>';
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
                        <li class="page-item"><a class="page-link" href="Bvascript:load_data('.$next_id.')">Next</a></li>
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
                            <a class="page-link" href="Bvascript:load_data('.$page_array[$count].')">'.$page_array[$count].'</a>
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

        //subscription details
        $todaysDate = date('Y-m-d');
        $allowToAdd = true;
        $maxJobPosting = $_SESSION['maxJobPosting'];
        
        if($maxJobPosting==$total_data || $maxJobPosting == 0){
            $allowToAdd=false;
        }

        $output = array(
            'data'				=>	$data,
            'allowToAdd'	    =>	$allowToAdd,
            'pagination'		=>	$pagination_html,
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

        $employerID = $this->model->getEmployerID();
        $jobPostingID = $this->model->getJobPostingID();
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
        $publishDate = $this->model->getPublishDate();
        $isDeleted=0;
        $newID = $jobPostingID;
        
        if(substr($jobPostingID, 2, 6)=="700101" && $isPublish == "Published"){
            $publishDate = date('Y-m-d');
            //assign new job posting id
            $year=substr($publishDate, 2,2);
            $month=substr($publishDate, 5,2);
            $day = substr($publishDate, 8,2);
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
            $this->send_email($jobCategoryID, $jobTitle, $employerID);
        }

        //insert into db
        if (strlen($jobCategoryID) > 0 &&  strlen($jobTitle) > 0 &&  strlen($jobDescription) > 0 &&  strlen($jobRequirement) > 0 &&  strlen($locationState) > 0 &&  strlen($employmentType) > 0) {
            $statement = $this->connection->prepare("UPDATE job_posting 
                                                    SET jobPostingID = ?, jobCategoryID = ?, jobTitle = ?, jobDescription = ?, jobRequirement = ?, jobHighlight = ?, experienceLevel = ?, locationState = ?, salary = ?,
                                                        employmentType = ?, applicationDeadline = ?, isPublish = ?, publishDate = ?, isDeleted = ?
                                                    WHERE employerID = ? AND jobPostingID = ?");

            $statement->bind_param("ssssssssdssssiss", $newID, $jobCategoryID, $jobTitle, $jobDescription, $jobRequirement, $jobHighlight, $experienceLevel, $locationState, $salary, $employmentType,
                                                        $applicationDeadline, $isPublish, $publishDate, $isDeleted, $employerID, $jobPostingID);

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

        $jobPostingID = $this->model->getJobPostingID();
        $jobCategoryID = $this->model->getJobCategoryID();
        $jobTitle = $this->model->getJobTitle();
        $jobDescription = $this->model->getJobDescription();
        $jobRequirement = $this->model->getJobRequirement();
        $experienceLevel = $this->model->getExperienceLevel();
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
        if($experienceLevel==""){
            $datas[$i]['inputName']="experienceLevel";
            $datas[$i]['errorMessage']="Experience Level is required";
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
        if(substr($jobPostingID, 2, 6)!="700101" && $isPublish == "Published"){
            $datas[$i]['inputName']="chkIsPublish";
            $datas[$i]['errorMessage']="This job has been posted before, Please create another job";
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

    /**
     * @throws Exception
     */
    function print_report(){
        $data = array();
        $limit = 5;
        $page = $this->getPage();

        if($page > 1) {
            $start = (($page - 1) * $limit);
            $page = $page;
        } else {
            $start = 0;
        }

        $employerID = $this->model->getEmployerID();
        $jobCategoryID = $this->model->getJobCategoryID();
        $jobTitle = $this->model->getJobTitle();
        $publishDateFrom = $this->getPublishDateFrom();
        $publishDateTo = $this->getPublishDateTo();

        // table data !
        $tableSql = "SELECT CONCAT(C.firstName, ' ', C.lastName) as jobSeekerName, C.working_experience, C.skills, C.field_of_study, B.salaryExpectation, B.applicationDate, B.status
                FROM job_posting A
                JOIN job_application B ON A.jobPostingID = B.jobPostingID
                JOIN job_seeker C ON C.jobSeekerID = B.jobSeekerID
                WHERE A.isDeleted =0 AND A.employerID = '$employerID' ";

        $filter_options ="";
        if($jobCategoryID!=""){
            $filter_options.=" AND A.jobCategoryID = '$jobCategoryID'";
        }
        if($jobTitle!=""){
            $filter_options.=" AND A.jobTitle LIKE '%$jobTitle%'";
        }
        if($publishDateFrom!=""){
            $filter_options.=" AND A.publishDate >= '$publishDateFrom'";
        }
        if($publishDateTo!=""){
            $filter_options.=" AND A.publishDate <= '$publishDateTo'";
        }

        $filter_options.=" ORDER BY A.created_at, A.jobPostingID";
        $tableSql.=$filter_options;

        $statement = $this->connection->query($tableSql);
        $tableData = [];
        while (($row = $statement->fetch_assoc()) == TRUE) {
            $tableData[] = $row;
        }

        // Pie chart data
        $totalSQL = "SELECT jobPostingID
                    FROM job_posting A 
                    JOIN job_category B ON A.jobCategoryID = B.jobCategoryID 
                    WHERE A.employerID = '$employerID'";
        $statement = $this->connection->query($totalSQL);
        $totalPie = $statement->num_rows;

        $jobCatPie = array();
        $pieSQL = "SELECT B.categoryName, A.jobCategoryID, count(jobPostingID) as totalRecords 
                    FROM job_posting A 
                    JOIN job_category B ON A.jobCategoryID = B.jobCategoryID 
                    WHERE A.employerID = '$employerID'
                    GROUP BY B.categoryName, A.jobCategoryID";
        $statement = $this->connection->query($pieSQL);
        
        while(($row = $statement->fetch_assoc())==TRUE){
            $jobCatPie[] = array("label" => $row['categoryName'], "data" => $row['totalRecords']/$totalPie*100);
        }

        // Line Chart
        $jobPostDatas = [];
        $lineData = [];
        $lineSQL = "SELECT MONTH(publishDate) as month, count(*) as totalPost
                        FROM job_posting
                        WHERE publishDate >= '$publishDateFrom' AND publishDate <= '$publishDateTo' AND isDeleted = 0 AND employerID = '$employerID'
                        GROUP BY month";
        $statement = $this->connection->query($lineSQL);
        
        while(($row = $statement->fetch_assoc())==TRUE){
            $jobPostDatas[] = array("month" => $row['month'], "totalPost" => $row['totalPost']);
        }

        for($i=1;$i<=12;$i++){
            $totalPost = 0;
            foreach ($jobPostDatas as $jobPostData){
                if($jobPostData['month'] == (string)$i){
                    $totalPost = $jobPostData['totalPost'];
                }
            }
            $lineData[] = array("month" => (int)$i, "totalPost" => $totalPost);
        }

        
        // Stacked Bar Chart
        $expSalaryStacked = [];
        $stackedSQL = "SELECT  A.jobPostingID, 
                                A.jobTitle, 
                                A.salary, 
                                AVG(B.salaryExpectation) AS avg_seeker_salary, 
                                A.salary - AVG(B.salaryExpectation) AS salary_difference 
                        FROM job_posting A 
                        JOIN job_application B ON A.jobPostingID = B.jobPostingID 
                        GROUP BY A.jobPostingID, A.jobTitle, A.salary";
        $statement = $this->connection->query($stackedSQL);
        
        while(($row = $statement->fetch_assoc())==TRUE){
            $expSalaryStacked[] = array("label" => $row['jobTitle'], "salary" => (float)$row['salary'], "salaryExp" => (float)$row['avg_seeker_salary']);
        }
        

        $output = array(
            'tableData'			=>	$tableData,
            'pieData'           =>  $jobCatPie,
            'lineData'          =>  $lineData,
            'stackedBCData'     => $expSalaryStacked,
            'status'            =>  true
        );

        echo json_encode($output);
    }

    private function send_email($jobCategoryID, $jobTitle, $employerID){
        $categoryName = "";
        $companyName = "";
        $keywords = "";
        $jobSeekerArr=array();
        $jobTitle = $this->model->getJobTitle();
        $jobDescription = $this->model->getJobDescription();
        $locationState = $this->model->getLocationState();
        $employmentType = $this->model->getEmploymentType();

        $stat = $this->connection->query("SELECT categoryName, keywords
                                            FROM job_category
                                            WHERE jobCategoryID = '$jobCategoryID'");
        while(($row = $stat->fetch_assoc())==TRUE){
            $categoryName = $row['categoryName'];
            $keywords = $row['keywords'];
        }

        $stat = $this->connection->query("SELECT companyName
                                            FROM employer
                                            WHERE employerID = '$employerID'");
        while(($row = $stat->fetch_assoc())==TRUE){
            $companyName = $row['companyName'];
        }

        $keyword_arr = explode (",", $keywords); 
        $jobSeekerSQL = "SELECT firstName, emailAddress
        FROM job_seeker
        WHERE isOpenForJobs = 1 AND (";
        for ($i=0;$i<sizeof($keyword_arr);$i++){
            if($i+1!=sizeof($keyword_arr)){
                $jobSeekerSQL.="UPPER(field_of_study) LIKE UPPER('%$keyword_arr[$i]%') OR ";
            }else{
                $jobSeekerSQL.="UPPER(field_of_study) LIKE UPPER('%$keyword_arr[$i]%'))";
            }
        }

        $stat = $this->connection->query($jobSeekerSQL);
        while(($row = $stat->fetch_assoc())==TRUE){
            array_push($jobSeekerArr, $row);
        }

        // Create a new PHPMailer object
        $mail = new PHPMailer(true);
        try{
            // Set up the SMTP configuration
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'jobnexus2@gmail.com';
            $mail->Password = 'njysranxlvecliqc';
            $mail->SMTPSecure = 'tsl';
            $mail->Port = 587;
            $mail->setFrom('jobnexus2@gmail.com', 'Job Nexus Job Alerts');

            foreach($jobSeekerArr as $jobSeeker){
                $mail->addAddress($jobSeeker['emailAddress'], $jobSeeker['firstName']);
                $mail->isHTML(true);
                $mail->Subject = "New Job Opportunity: ".$jobTitle;
                $content = 'Dear ' . $jobSeeker['firstName'] . ',<br><br>' .
                            'A new job opportunity has been posted that matches your skills and experience:<br><br>' .
                            'Job Title: ' . $jobTitle . '<br>' .
                            'Description: ' . $jobDescription . '<br>' .
                            'Location: ' . $locationState . '<br><br>' .
                            'Employment Type: ' . $employmentType . '<br><br>' .
                            'Apply now to seize this opportunity!<br><br>' .
                            'Best regards,<br>Job Nexus';
                $mail->Body = $content;
                // Set up the email content
                $mail->send();
                $mail->clearAddresses();
            }
        } catch (Exception $e) {
            echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

    }
}

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *"); // this is to prevent from Bvascript given cors error

$mode = filter_input(INPUT_POST, "mode", FILTER_SANITIZE_STRING);

$jobPostingOop = new JobPostingOop();
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
        case "print_report":
            $jobPostingOop->print_report();
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
