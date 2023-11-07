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

class JobPostingModel
{
    private String $employerID;
    private String $jobPostingID;
    private String $jobCategoryID;
    private String $jobTitle;
    private String $jobDescription;
    private String $jobRequirement;
    private String $skills;
    private String $experienceLevel;
    private String $locationState;
    private float $salary;
    private String $employmentType;
    private String $applicationDeadline;
    private String $postDate;
    private String $status;

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

    public function getSkills(): String
    {
        return $this->skills;
    }

    public function setSkills(String $skills): JobPostingModel
    {
        $this->skills = $skills;
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

    public function getPostDate(): String
    {
        return $this->postDate;
    }

    public function setPostDate(String $postDate): JobPostingModel
    {
        $this->postDate = $postDate;
        return $this;
    }

    public function getStatus(): String
    {
        return $this->status;
    }

    public function setStatus(String $status): JobPostingModel
    {
        $this->status = $status;
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

class FlightScheduleOop
{
    private ConnectionString $connectionString;
    private JobPostingModel $model;
    private mysqli $connection;

    private $departureDay;
    private $page;

    public function getDepartureDay(): String
    {
        return $this->departureDay;
    }

    public function setDepartureDay($departureDay=""): FlightScheduleOop
    {
        $this->departureDay = $departureDay;
        return $this;
    }

    public function getPage()
    {
        return $this->page;
    }

    public function setPage($page=NULL): FlightScheduleOop
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
        $employerID =  base64_decode(filter_input(INPUT_POST, "employerID", FILTER_SANITIZE_STRING));
        $jobPostingID =  base64_decode(filter_input(INPUT_POST, "jobPostingID", FILTER_SANITIZE_STRING));
        $jobCategoryID =  base64_decode(filter_input(INPUT_POST, "jobCategoryID", FILTER_SANITIZE_STRING));
        $jobTitle = filter_input(INPUT_POST, "jobTitle", FILTER_SANITIZE_STRING);
        $jobDescription = filter_input(INPUT_POST, "jobDescription", FILTER_SANITIZE_STRING);
        $skills = filter_input(INPUT_POST, "skills", FILTER_SANITIZE_STRING);
        $experienceLevel = filter_input(INPUT_POST, "experienceLevel", FILTER_SANITIZE_STRING);
        $locationState = filter_input(INPUT_POST, "locationState", FILTER_SANITIZE_STRING);
        $salary = filter_input(INPUT_POST, "salary", FILTER_SANITIZE_NUMBER_FLOAT);
        $employmentType = filter_input(INPUT_POST, "employmentType", FILTER_SANITIZE_STRING);
        $applicationDeadline = filter_input(INPUT_POST, "applicationDeadline", FILTER_SANITIZE_STRING);
        $postDate = filter_input(INPUT_POST, "postDate", FILTER_SANITIZE_STRING);
        $status = filter_input(INPUT_POST, "status", FILTER_SANITIZE_STRING);
        $page = filter_input(INPUT_POST, "page", FILTER_SANITIZE_NUMBER_INT);
        
        $this->model->setEmployerID($employerID);
        $this->model->setJobPostingID($jobPostingID);
        $this->model->setJobCategoryID($jobCategoryID);
        $this->model->setJobTitle($jobTitle);
        $this->model->setJobDescription($jobDescription);
        $this->model->setSkills($skills);
        $this->model->setExperienceLevel($experienceLevel);
        $this->model->setLocationState($locationState);
        $this->model->setSalary($salary);
        $this->model->setEmploymentType($employmentType);
        $this->model->setApplicationDeadline($applicationDeadline);
        $this->model->setPostDate($postDate);
        $this->model->setStatus($status);
        $this->setPage($page);

        if( filter_input(INPUT_POST, "mode", FILTER_SANITIZE_STRING) == "create"){

        }else if(filter_input(INPUT_POST, "mode", FILTER_SANITIZE_STRING) == "delete"){

        }else if(filter_input(INPUT_POST, "mode", FILTER_SANITIZE_STRING) == "update"){

        }else if(filter_input(INPUT_POST, "mode", FILTER_SANITIZE_STRING) == "check_validation"){

        }else if(filter_input(INPUT_POST, "mode", FILTER_SANITIZE_STRING) == "search"){

        }       
    }

    /**
     * @throws Exception
     */
    function create()
    {
        $this->connection->autocommit(false);

        $airplaneId = $this->model->getAirplaneId();
        $origin = $this->getOrigin();
        $destination = $this->getDestination();
        $departureDay = $this->model->getDepartureDay();
        $departureTime = $this->model->getDepartureTime();
        $price = $this->model->getPrice();
        $startingDate = $this->model->getStartingDate();
        
        $findRoute = $this->connection->query("SELECT route_id, time_taken_hour, time_taken_min
                                                FROM route WHERE origin = '$origin' AND destination = '$destination'");
        while (($row = $findRoute->fetch_assoc()) == TRUE) {
            $routeId =  $row['route_id'];
            $time_taken_hour = $row['time_taken_hour'];
            $time_taken_min = $row['time_taken_min'];
        }

        $arrivalTimeHour = (int)(substr($departureTime,0,2)) + $time_taken_hour;
        $arrivalTimeMin =(int)(substr($departureTime,3,2)) + $time_taken_min;
        
        if($arrivalTimeMin>=60){
            $arrivalTimeMin -= 60;
            $arrivalTimeHour += 1;
        }
        if($arrivalTimeHour>=24){
            $arrivalTimeHour-=24;
        }

        $arrivalTime = $arrivalTimeHour .":".$arrivalTimeMin;

        if ($routeId > 0 &&  $airplaneId > 0 &&  strlen($departureTime) > 0 &&  strlen($arrivalTime) > 0 &&  strlen($departureDay) > 0 &&  strlen($startingDate) > 0) {
            $statement = $this->connection->prepare("INSERT INTO flight_schedule VALUES (null, ?, ?, ?, ?, ?, ?, ?)");
            $statement->bind_param("iisssds", $routeId, $airplaneId, $departureTime, $arrivalTime, $departureDay, $price, $startingDate);
            try {
                $statement->execute();
                $statement->insert_id;
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
        $origin = $this->getOrigin();
        $destination = $this->getDestination();
        $airplaneId = $this->model->getAirplaneId();
        $departureTimeFrom = $this->getDepartureTimeFrom();
        $departureTimeTo = $this->getDepartureTimeTo();
        $departureDay = $this->getDepartureDay();

        $sql = "SELECT jobTitle, skills, experienceLevel, locationState, salary, employmentType, applicationDeadline, status
        FROM job_posting A
        JOIN employer B ON A.employerID = B.employerID
        JOIN job_category C ON A.jobCategoryID = C.jobCategoryID
        WHERE A.employerID = 'E2300000'";

        if($jobTitle!=""){
            $sql.=" AND B.origin = '$origin'";
        }
        if($destination!=""){
            $sql.=" AND B.destination = '$destination'";
        }
        if($airplaneId!=0){
            $sql.=" AND A.airplane_id = $airplaneId";
        }
        if($departureDay!=""){
            $sql.=" AND A.departure_day LIKE '%$departureDay%'";
        }
        if($departureTimeFrom!=""){
            $sql.=" AND A.departure_time >= '$departureTimeFrom'";
        }
        if($departureTimeTo!=""){
            $sql.=" AND A.departure_time <= '$departureTimeTo'";
        }
        $sql.=" ORDER BY postDate DESC";

        $statement = $this->connection->prepare($sql);
        $statement->execute();
        $statement->store_result();
        $statement->fetch();
        $total_data = $statement->num_rows;

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

        $flightScheduleId = $this->model->getFlightScheduleId();
        $airplaneId = $this->model->getAirplaneId();
        $origin = $this->getOrigin();
        $destination = $this->getDestination();
        $departureDay =$this->model->getDepartureDay();
        $departureTime = $this->model->getDepartureTime();
        $price = $this->model->getPrice();
        $startingDate = $this->model->getStartingDate();
        
        $findRoute = $this->connection->query("SELECT route_id, time_taken_hour, time_taken_min
                                                FROM route WHERE origin = '$origin' AND destination = '$destination'");
        while (($row = $findRoute->fetch_assoc()) == TRUE) {
            $routeId =  $row['route_id'];
            $time_taken_hour = $row['time_taken_hour'];
            $time_taken_min = $row['time_taken_min'];
        }

        $arrivalTimeHour = (int)(substr($departureTime,0,2)) + $time_taken_hour;
        $arrivalTimeMin =(int)(substr($departureTime,3,2)) + $time_taken_min;
        
        if($arrivalTimeMin>=60){
            $arrivalTimeMin -= 60;
            $arrivalTimeHour += 1;
        }
        if($arrivalTimeHour>=24){
            $arrivalTimeHour-=24;
        }

        $arrivalTime = $arrivalTimeHour .":".$arrivalTimeMin;

        if ($routeId > 0 &&  $airplaneId > 0 &&  strlen($departureTime) > 0 &&  strlen($arrivalTime) > 0 &&  strlen($departureDay) > 0 &&  strlen($startingDate) > 0) {
            $statement = $this->connection->prepare("UPDATE flight_schedule 
                                                    SET route_id = ?, airplane_id = ?, departure_time = ?, arrival_time = ?, departure_day = ?, 
                                                        price = ?, starting_date = ?
                                                    WHERE flight_schedule_id = ?");
            $statement->bind_param("iisssdsi", $routeId, $airplaneId, $departureTime, $arrivalTime, $departureDay, $price, $startingDate, $flightScheduleId);
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

        $var1 = $this->model->getFlightScheduleId();

        if ($var1 > 0) {

            $statement = $this->connection->prepare("UPDATE flight_schedule SET starting_date = '1900-01-01'
                WHERE flight_schedule_id = ? ");
            // s -> string, i -> integer , d -  double , b - blob
            $statement->bind_param("i", $var1);
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

        $airplaneId = $this->model->getAirplaneId();
        $origin = $this->getOrigin();
        $destination = $this->getDestination();
        $departureDay = $this->model->getDepartureDay();
        $departureTime = $this->model->getDepartureTime();
        $price = $this->model->getPrice();
        $startingDate = $this->model->getStartingDate();
        $type = filter_input(INPUT_POST, "type", FILTER_SANITIZE_STRING);

        $i=0;

        //db loading
        $db_datas=[];
        $result = $this->connection->query("SELECT B.origin, B.destination, C.airplane_id, C.name, A.departure_day, A.departure_time, A.arrival_time, B.time_taken_hour
                                            FROM flight_schedule A
                                            JOIN route B ON A.route_id = B.route_id
                                            JOIN airplane C ON A.airplane_id = C.airplane_id
                                            WHERE starting_date >= '2000-01-01'");
        while (($row = $result->fetch_assoc()) == TRUE) {
            $db_datas[] = $row;
        }
        
        //null checking
        if($airplaneId==0){
            $datas[$i]['inputName']="planeName";
            $datas[$i]['errorMessage']="Plane Number is required";
            $i++;
        }
        if($origin==""){
            $datas[$i]['inputName']="origin";
            $datas[$i]['errorMessage']="Origin is required";
            $i++;
        }
        if($destination==""){
            $datas[$i]['inputName']="destination";
            $datas[$i]['errorMessage']="Destination is required";
            $i++;
        }
        if($departureDay==""){
            $datas[$i]['inputName']="departureDay";
            $datas[$i]['errorMessage']="Departure day is required";
            $i++;
        }
        if($departureTime==""){
            $datas[$i]['inputName']="departureTime";
            $datas[$i]['errorMessage']="Departure Time is required";
            $i++;
        }
        if($price==0){
            $datas[$i]['inputName']="price";
            $datas[$i]['errorMessage']="Price is required";
            $i++;
        }
        if($startingDate==""){
            $datas[$i]['inputName']="scheduleStartDate";
            $datas[$i]['errorMessage']="Schedule start date is required";
            $i++;
        }

        //logical checking
        if($origin!="" && $origin==$destination){
            $datas[$i]['inputName']="origin";
            $datas[$i]['errorMessage']="Origin must not be same as destination";
            $i++;
            $datas[$i]['inputName']="destination";
            $datas[$i]['errorMessage']="Origin must not be same as destination";
            $i++;
        }

        //server validation
        if($airplaneId!=0 && $origin !="" && $type=="add"){
            $lastDestination = "";
            $airplaneName = "";
            foreach ($db_datas as $db_data){
                if($db_data['airplane_id'] == $airplaneId){
                    $lastDestination = $db_data['destination'];
                    $airplaneName = $db_data['name'];
                }
            }

            if($lastDestination !="" && $lastDestination != $origin){
                $datas[$i]['inputName']="origin";
                $datas[$i]['errorMessage']="Airplane $airplaneName last destination is in $lastDestination";
                $i++; 
            }
        }

        if($origin != "" && $destination != "" && $price != 0){
            foreach ($db_datas as $db_data){
                $db_min_price = $db_data['time_taken_hour']*50;

                if($db_data['origin'] == $origin && $db_data['destination'] == $destination  && $price < $db_min_price){
                    $datas[$i]['inputName']="price";
                    $datas[$i]['errorMessage']="From $origin to $destination, price must be larger than $db_min_price";
                    $i++; 
                }
            }
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

$flightScheduleOop = new FlightScheduleOop();
try {
    switch ($mode) {
        case  "create":
            $flightScheduleOop->create();
            break;
        case  "read":
            $flightScheduleOop->read();
            break;
        case  "search":
            $flightScheduleOop->search();
            break;
        case  "update":
            $flightScheduleOop->update();
            break;
        case  "delete":
            $flightScheduleOop->delete();
            break;
        case "check_validation":
            $flightScheduleOop->check_validation();
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
