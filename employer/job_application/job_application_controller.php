<?php
session_start();

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

class JobApplicationModel
{
    private String $applicationID;
    private String $jobSeekerID;
    private String $jobPostingID;
    private String $applicationDate;
    private String $coverLetterSummary;
    private String $status;
    private float $salaryExpectation;
    private String $availableDate;
    private String $replies;

    public function getApplicationID(): String {
        return $this->applicationID;
    }
    
    public function setApplicationID(String $applicationID): JobApplicationModel {
        $this->applicationID = $applicationID;
        return $this;
    }
    
    public function getJobSeekerID(): String {
        return $this->jobSeekerID;
    }
    
    public function setJobSeekerID(String $jobSeekerID): JobApplicationModel {
        $this->jobSeekerID = $jobSeekerID;
        return $this;
    }

    public function getJobPostingID(): String {
        return $this->jobPostingID;
    }
    
    public function setJobPostingID(String $jobPostingID): JobApplicationModel {
        $this->jobPostingID = $jobPostingID;
        return $this;
    }
    
    public function getApplicationDate(): String {
        return $this->applicationDate;
    }
    
    public function setApplicationDate(String $applicationDate): JobApplicationModel {
        $this->applicationDate = $applicationDate;
        return $this;
    }
    
    public function getCoverLetterSummary(): String {
        return $this->coverLetterSummary;
    }
    
    public function setCoverLetterSummary(String $coverLetterSummary): JobApplicationModel {
        $this->coverLetterSummary = $coverLetterSummary;
        return $this;
    }
    
    public function getStatus(): String {
        return $this->status;
    }
    
    public function setStatus(String $status): JobApplicationModel {
        $this->status = $status;
        return $this;
    }
    
    public function getSalaryExpectation(): float {
        return $this->salaryExpectation;
    }
    
    public function setSalaryExpectation(float $salaryExpectation): JobApplicationModel {
        $this->salaryExpectation = $salaryExpectation;
        return $this;
    }
    
    public function getAvailableDate(): String {
        return $this->availableDate;
    }
    
    public function setAvailableDate(String $availableDate): JobApplicationModel {
        $this->availableDate = $availableDate;
        return $this;
    }
    
    public function getReplies(): String {
        return $this->replies;
    }
    
    public function setReplies(String $replies): JobApplicationModel {
        $this->replies = $replies;
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

class JobApplicationOop
{
    private ConnectionString $connectionString;
    private JobApplicationModel $model;
    private mysqli $connection;

    private $employerID;
    private $jobSeekerName;
    private $address;
    private $workingExperience;
    private $skills;
    private $page;

    public function getEmployerID(): String
    {
        return $this->employerID;
    }

    public function setEmployerID($employerID=""): JobApplicationOop
    {
        $this->employerID = $employerID;
        return $this;
    }

    public function getJobSeekerName(): String
    {
        return $this->jobSeekerName;
    }

    public function setJobSeekerName($jobSeekerName=""): JobApplicationOop
    {
        $this->jobSeekerName = $jobSeekerName;
        return $this;
    }

    public function getAddress(): String
    {
        return $this->address;
    }

    public function setAddress($address=""): JobApplicationOop
    {
        $this->address = $address;
        return $this;
    }

    public function getWorkingExperience(): int
    {
        return $this->workingExperience;
    }

    public function setWorkingExperience($workingExperience=0): JobApplicationOop
    {
        $this->workingExperience = $workingExperience;
        return $this;
    }

    public function getSkills(): String
    {
        return $this->skills;
    }

    public function setSkills($skills=""): JobApplicationOop
    {
        $this->skills = $skills;
        return $this;
    }

    public function getPage()
    {
        return $this->page;
    }

    public function setPage($page=NULL): JobApplicationOop
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
        $this->model = new JobApplicationModel();
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
        //employerID
        $employerID = base64_decode($_SESSION['employerID']);
        $applicationID = base64_decode(filter_input(INPUT_POST, "applicationID", FILTER_SANITIZE_STRING));
        $jobSeekerID = base64_decode(filter_input(INPUT_POST, "jobSeekerID", FILTER_SANITIZE_STRING));
        $jobPostingID = base64_decode(filter_input(INPUT_POST, "jobPostingID", FILTER_SANITIZE_STRING));
        $applicationDate = filter_input(INPUT_POST, "applicationDate", FILTER_SANITIZE_STRING);
        $coverLetterSummary = filter_input(INPUT_POST, "coverLetterSummary", FILTER_SANITIZE_STRING);
        $status = filter_input(INPUT_POST, "status", FILTER_SANITIZE_STRING);
        $salaryExpectation = filter_input(INPUT_POST, "salaryExpectation", FILTER_SANITIZE_STRING);
        $availableDate = filter_input(INPUT_POST, "availableDate", FILTER_SANITIZE_STRING);
        $replies = filter_input(INPUT_POST, "replies", FILTER_SANITIZE_STRING);
        $jobTitle = filter_input(INPUT_POST, "jobTitle", FILTER_SANITIZE_STRING);
        $page = filter_input(INPUT_POST, "page", FILTER_SANITIZE_NUMBER_INT);

        $jobSeekerName = filter_input(INPUT_POST, "jobSeekerName", FILTER_SANITIZE_STRING);
        $address = filter_input(INPUT_POST, "address", FILTER_SANITIZE_STRING);
        $workingExperience = filter_input(INPUT_POST, "workingExperience", FILTER_SANITIZE_NUMBER_INT);
        $skills = filter_input(INPUT_POST, "skills", FILTER_SANITIZE_STRING);

        if(filter_input(INPUT_POST, "mode", FILTER_SANITIZE_STRING) == "update"){
            $this->model->setApplicationID($applicationID);
            $this->model->setStatus($status);
            $this->model->setReplies($replies);
        }elseif(filter_input(INPUT_POST, "mode", FILTER_SANITIZE_STRING) == "search"){
            $this->setPage($page);
            $this->setEmployerID($employerID);
            $this->model->setJobPostingID($jobPostingID);
            $this->setJobSeekerName($jobSeekerName);
            $this->setAddress($address);
            $this->setWorkingExperience($workingExperience);
            $this->setSkills($skills);
            $this->model->setSalaryExpectation($salaryExpectation);
            $this->model->setStatus($status);
        }elseif(filter_input(INPUT_POST, "mode", FILTER_SANITIZE_STRING) == "print_report"){
            $this->setEmployerID($employerID);
            $this->model->setJobPostingID($jobPostingID);
        }
    }

    /**
     * @throws Exception
     */
    function create()
    {
        //Implement Create method
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
        $employerID = $this->getEmployerID();
        $jobPostingID = $this->model->getJobPostingID();
        $jobSeekerName = $this->getJobSeekerName();
        $address = $this->getAddress();
        $workingExperience = $this->getWorkingExperience();
        $skills = $this->getSkills();
        $salaryExpectation = $this->model->getSalaryExpectation();
        $status = $this->model->getStatus();

        //table data
        $sql = "SELECT A.applicationID, CONCAT(B.firstName,' ',B.lastName) AS jobSeekerName, B.address, B.working_experience, B.skills, A.salaryExpectation, A.status, C.jobPostingID
        FROM job_application A 
        JOIN job_seeker B ON A.jobSeekerID = B.jobSeekerID
        JOIN job_posting C ON A.jobPostingID = C.jobPostingID
        WHERE A.jobPostingID = '$jobPostingID' AND C.employerID = '$employerID'";

        $filter_option = "";
        if($jobSeekerName!=""){
            $filter_option.=" AND CONCAT(B.firstName,' ',B.lastName) LIKE '%$jobSeekerName%'";
        }
        if($address!=""){
            $filter_option.=" AND B.address LIKE '%$address%'";
        }
        if($workingExperience!=0){
            $filter_option.=" AND B.working_experience >= $workingExperience";
        }
        if($skills!=""){
            $filter_option.=" AND B.skills LIKE '%$skills%'";
        }
        if($salaryExpectation!=""){
            $filter_option.=" AND A.salaryExpectation >= $salaryExpectation";
        }
        if($status!=""){
            $filter_option.=" AND A.status = '$status'";
        }
        //ranking (order by working_experience, education level, field of study, skills, salaryexpectation)
        $filter_option.=" ORDER BY B.working_experience";

        $sql.=$filter_option;

        $total_data=0;
        $statement = $this->connection->query("SELECT count(*) as totalRecord
                                                FROM job_application A 
                                                JOIN job_seeker B ON A.jobSeekerID = B.jobSeekerID
                                                JOIN job_posting C ON A.jobPostingID = C.jobPostingID
                                                JOIN job_category D ON C.jobCategoryID = D.jobCategoryID
                                                WHERE A.jobPostingID = '$jobPostingID' AND C.employerID = '$employerID'".$filter_option);
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

        //pagination
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

        $jobApplicationID = $this->model->getApplicationID();
        $status = $this->model->getStatus();
        $replies = $this->model->getReplies();

        //insert into db
        if (strlen($status) > 0) {
            $statement = $this->connection->prepare("UPDATE job_application 
                                                    SET status = ?, replies = ?
                                                    WHERE applicationID = ?");

            $statement->bind_param("sss", $status, $replies, $jobApplicationID);

            try {
                $statement->execute();
            } catch (Exception $exception) {
                throw new Exception($exception->getMessage(), ReturnCode::QUERY_FAILURE);
            }

            $this->connection->commit();
            if($status == "Success"){
                $this->send_email();
            }
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
        //Implement Delete method
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

        $employerID = $this->getEmployerID();
        $jobPostingID = $this->model->getJobPostingID();

        // Job seeker table data
        $tableSql = "SELECT CONCAT(C.firstName, ' ', C.lastName) as jobSeekerName, C.working_experience, C.skills, C.field_of_study, B.salaryExpectation, B.applicationDate, B.status
                FROM job_posting A
                JOIN job_application B ON A.jobPostingID = B.jobPostingID
                JOIN job_seeker C ON C.jobSeekerID = B.jobSeekerID
                WHERE A.isDeleted =0 AND A.employerID = '$employerID'";

        $filter_options ="";
        if($jobPostingID!=""){
            $filter_options.=" AND A.jobPostingID = '$jobPostingID'";
        }

        $tableSql.=$filter_options." ORDER BY A.created_at, A.jobPostingID";

        $statement = $this->connection->query($tableSql);
        $tableData = [];
        while (($row = $statement->fetch_assoc()) == TRUE) {
            $tableData[] = $row;
        }

        // Pie chart data
        $jobAppPie = array();
        $countSQL = "SELECT applicationID
                    FROM 
                        job_application A
                    JOIN 
                        job_posting B ON A.jobPostingID = B.jobPostingID
                    WHERE B.isDeleted = 0 AND B.employerID = '$employerID'";
        $countSQL.=$filter_options;
        $statement = $this->connection->query($countSQL);
        $sumApplication = $statement->num_rows;

        $pieSQL = "SELECT 
                        A.jobPostingID,
                        A.jobTitle,
                        COUNT(B.applicationID) AS totalApplications
                    FROM 
                        job_posting A
                    JOIN 
                        job_application B ON A.jobPostingID = B.jobPostingID
                    WHERE A.isDeleted = 0 AND A.employerID = '$employerID'";
        $pieSQL.=$filter_options." GROUP BY A.jobPostingID, A.jobTitle";
        $statement = $this->connection->query($pieSQL);
        
        while(($row = $statement->fetch_assoc())==TRUE){
            $jobAppPie[] = array("title" => $row['jobTitle'], "data" => number_format((float)$row['totalApplications']/$sumApplication*100, 2));
        }

        // Bar Data
        $successAppDatas = [];
        $successAppSQL = "SELECT
                        A.jobPostingID,
                        A.jobTitle,
                        COUNT(B.applicationID) AS TotalApplications,
                        SUM(CASE WHEN B.status = 'Success' THEN 1 ELSE 0 END) AS SuccessfulApplications,
                        (SUM(CASE WHEN B.status = 'Success' THEN 1 ELSE 0 END) / COUNT(B.applicationID) * 100) AS SuccessRate
                    FROM
                        job_posting A
                    JOIN
                        job_application B ON A.jobPostingID = B.jobPostingID
                    WHERE
                        isDeleted = 0 AND employerID = '$employerID'
                    ";
        $successAppSQL.=$filter_options."GROUP BY A.jobPostingID, A.jobTitle ORDER BY SuccessRate DESC";

        $statement = $this->connection->query($successAppSQL);
        
        while(($row = $statement->fetch_assoc())==TRUE){
            $successAppDatas[] = array("title" => $row['jobTitle'], "successRate" => $row['SuccessRate']);
        }

        //Multi line chart data
        $dayAppDatas = [];
        $outputDatas = [];
        $dayAppSQL = "SELECT B.jobTitle, B.jobPostingID,
                                DATEDIFF(applicationDate, publishDate) as dayApplied,
                                count(applicationID) as totalApplication
                            FROM job_application A
                            JOIN job_posting B ON A.jobPostingID = B.jobPostingID
                            WHERE B.isDeleted = 0 AND employerID = '$employerID'
                            ";
        $dayAppSQL.=$filter_options."GROUP BY dayApplied";
        
        $statement = $this->connection->query($dayAppSQL);

        while(($row = $statement->fetch_assoc())==TRUE){
            $dayAppDatas[] = $row;
        }        

        for($i=0;$i<sizeof($dayAppDatas);$i++){
            $dayApplied  = [];
            $totalApplication = [];

            for($j=0;$j<sizeof($dayAppDatas);$j++){
                if($dayAppDatas[$i]['jobPostingID'] == $dayAppDatas[$j]['jobPostingID']){
                    $dayApplied[]=($dayAppDatas[$j]['dayApplied']);
                    $totalApplication[]=($dayAppDatas[$j]['totalApplication']);
                }
            }
            $outputDatas[] = array("jobTitle" => $dayAppDatas[$i]['jobTitle'], "daysApplied" => $dayApplied, "totalApplication" => $totalApplication);
        }
        $outputDatas  = (array_unique($outputDatas, SORT_REGULAR));

        
        $output = array(
            'tableData'			=>	$tableData,
            'pieData'           =>  $jobAppPie,
            'barData'           =>  $successAppDatas,
            'multiLineData'     =>  $outputDatas,
            'status'            =>  true
        );

        echo json_encode($output);
    }

    function getWeeks($date, $rollover)
    {
        $cut = substr($date, 0, 8);
        $daylen = 86400;

        $timestamp = strtotime($date);
        $first = strtotime($cut . "00");
        $elapsed = ($timestamp - $first) / $daylen;

        $weeks = 1;

        for ($i = 1; $i <= $elapsed; $i++)
        {
            $dayfind = $cut . (strlen($i) < 2 ? '0' . $i : $i);
            $daytimestamp = strtotime($dayfind);

            $day = strtolower(date("l", $daytimestamp));

            if($day == strtolower($rollover))  $weeks ++;
        }

        return $weeks;
    }

    private function send_email($subscriptionID){
        $data=[];
        $stat = $this->connection->query("SELECT B.companyName, C.planName, C.price, C.validityPeriod, B.emailAddress
                                        FROM subscription A
                                        JOIN employer B ON A.employerID = B.employerID
                                        JOIN subscription_plan C ON A.subscriptionPlanID = C.subscriptionPlanID
                                        WHERE subscriptionID = '$subscriptionID'");
        while(($row = $stat->fetch_assoc())==TRUE){
            $data=$row;
        }

        // Create a new PHPMailer object
        $mail = new PHPMailer(true);
        
        $content = "
            <!DOCTYPE html>
            <html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Thank You for Subscribing!</title>
            </head>
            <body style='font-family: Arial, sans-serif;'>

                <table width='100%' border='0' cellspacing='0' cellpadding='0'>
                    <tr>
                        <td style='background-color: #f7f7f7; padding: 20px; text-align: center;'>
                            <h1 style='color: #333;'>Thank You for Subscribing!</h1>
                        </td>
                    </tr>
                    <tr>
                        <td style='padding: 20px;'>
                            <p>Dear ".$data['companyName'].",</p>
                            <p>Thank you for choosing our online employment website and subscribing to our ".$data['planName']." plan. We are thrilled to have you on board!</p>
                            <p>Your subscription details:</p>
                            <ul>
                                <li><strong>Plan:</strong> ".$data['planName']."</li>
                                <li><strong>Price:</strong> RM ".number_format($data['price'])."</li>
                                <li><strong>Validity Period:</strong> ".$data['validityPeriod']."</li>
                            </ul>
                            <p>Your subscription will give you access to a range of features and benefits designed to enhance your experience on our platform.</p>
                            <p>You can print you receipt by clicking <a href='http://localhost/jobNexus/employer/subscription/subscription_print.php?id=".base64_encode($subscriptionID)
                            ."' target='_blank'>here</a> .</p>
                            <p>If you have any questions or need assistance, feel free to reach out to our support team at jobnexus2@gmail.com.</p>
                            <p>Thank you once again for choosing Job Nexus. We look forward to helping you find success in your job search!</p>
                            <p>Best regards,</p>
                            <p>The Job Nexus Team</p>
                        </td>
                    </tr>
                    <tr>
                        <td style='background-color: #333; color: #fff; padding: 10px; text-align: center;'>
                            &copy; 2023 Job Nexus. All rights reserved.
                        </td>
                    </tr>
                </table>

            </body>
            </html>
        ";
        // Set up the SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'jobnexus2@gmail.com';
        $mail->Password = 'njysranxlvecliqc';
        $mail->SMTPSecure = 'tsl';
        $mail->Port = 587;

        // Set up the email content
        $mail->setFrom('jobnexus2@gmail.com');
        $mail->addAddress($data['emailAddress']);
        $mail->isHTML(true);
        $mail->Subject = "Job Nexus Subscription";
        $mail->Body = $content;
        $mail->send();
    }
}

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *"); // this is to prevent from Bvascript given cors error

$mode = filter_input(INPUT_POST, "mode", FILTER_SANITIZE_STRING);

$jobApplicationOop = new JobApplicationOop();
try {
    switch ($mode) {
        case  "create":
            $jobApplicationOop->create();
            break;
        case  "search":
            $jobApplicationOop->search();
            break;
        case  "update":
            $jobApplicationOop->update();
            break;
        case  "delete":
            $jobApplicationOop->delete();
            break;
        case  "print_report":
            $jobApplicationOop->print_report();
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
