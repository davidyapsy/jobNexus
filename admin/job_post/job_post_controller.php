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

class FlightScheduleModel
{
    private int $flightScheduleId;
    private int $routeId;
    private int $airplaneId;
    private String $departureTime;
    private String $arrivalTime;
    private String $departureDay;
    private float $price;
    private String $startingDate;

    public function getFlightScheduleId(): int
    {
        return $this->flightScheduleId;
    }

    public function setFlightScheduleId(int $flightScheduleId): FlightScheduleModel
    {
        $this->flightScheduleId = $flightScheduleId;
        return $this;
    }

    public function getRouteId(): int
    {
        return $this->routeId;
    }

    public function setRouteId(int $routeId): FlightScheduleModel
    {
        $this->routeId = $routeId;
        return $this;
    }

    public function getAirplaneId(): int
    {
        return $this->airplaneId;
    }

    public function setAirplaneId(int $airplaneId): FlightScheduleModel
    {
        $this->airplaneId = $airplaneId;
        return $this;
    }

    public function getDepartureTime(): String
    {
        return $this->departureTime;
    }

    public function setDepartureTime(String $departureTime): FlightScheduleModel
    {
        $this->departureTime = $departureTime;
        return $this;
    }

    public function getArrivalTime(): String
    {
        return $this->arrivalTime;
    }

    public function setArrivalTime(String $arrivalTime): FlightScheduleModel
    {
        $this->arrivalTime = $arrivalTime;
        return $this;
    }

    public function getDepartureDay(): String
    {
        return $this->departureDay;
    }

    public function setDepartureDay(String $departureDay): FlightScheduleModel
    {
        $this->departureDay = $departureDay;
        return $this;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): FlightScheduleModel
    {
        $this->price = $price;
        return $this;
    }

    public function getStartingDate(): String
    {
        return $this->startingDate;
    }

    public function setStartingDate(String $startingDate): FlightScheduleModel
    {
        $this->startingDate = $startingDate;
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
    private FlightScheduleModel $model;
    private mysqli $connection;

    private $origin;
    private $destination;
    private $departureTimeFrom;
    private $departureTimeTo;
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

    public function getDepartureTimeFrom(): String
    {
        return $this->departureTimeFrom;
    }

    public function setDepartureTimeFrom($departureTimeFrom=""): FlightScheduleOop
    {
        $this->departureTimeFrom = $departureTimeFrom;
        return $this;
    }

    public function getDepartureTimeTo(): String
    {
        return $this->departureTimeTo;
    }

    public function setDepartureTimeTo($departureTimeTo=""): FlightScheduleOop
    {
        $this->departureTimeTo = $departureTimeTo;
        return $this;
    }
    
    public function getOrigin(): String
    {
        return $this->origin;
    }

    public function setOrigin($origin=""): FlightScheduleOop
    {
        $this->origin = $origin;
        return $this;
    }
    
    public function getDestination(): String
    {
        return $this->destination;
    }

    public function setDestination($destination=""): FlightScheduleOop
    {
        $this->destination = $destination;
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
        $this->model = new FlightScheduleModel();
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
        $this->connectionString->setDatabase("flight_ticketing");
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
        $flightScheduleId =  base64_decode(filter_input(INPUT_POST, "flightScheduleId", FILTER_SANITIZE_STRING));
        $airplaneId = filter_input(INPUT_POST, "airplaneId", FILTER_SANITIZE_NUMBER_INT);
        $departureTime = filter_input(INPUT_POST, "departureTime", FILTER_SANITIZE_STRING);
        $departureDay = filter_input(INPUT_POST, "departureDas", FILTER_SANITIZE_STRING);
        $price = filter_input(INPUT_POST, "price", FILTER_SANITIZE_NUMBER_FLOAT);
        $startingDate = filter_input(INPUT_POST, "startingDate", FILTER_SANITIZE_STRING);

        //
        $origin = filter_input(INPUT_POST, "origin", FILTER_SANITIZE_STRING);
        $destination = filter_input(INPUT_POST, "destination", FILTER_SANITIZE_STRING);
        //
        $departureDay = filter_input(INPUT_POST, "departureDay", FILTER_SANITIZE_STRING);
        $departureTimeFrom = filter_input(INPUT_POST, "departureTimeFrom", FILTER_SANITIZE_STRING);
        $departureTimeTo = filter_input(INPUT_POST, "departureTimeTo", FILTER_SANITIZE_STRING);

        $page = filter_input(INPUT_POST, "page", FILTER_SANITIZE_NUMBER_INT);
        
        if( filter_input(INPUT_POST, "mode", FILTER_SANITIZE_STRING) == "create"){
            $this->model->setAirplaneId($airplaneId);
            $this->setOrigin($origin);
            $this->setDestination($destination);
            $this->model->setDepartureDay($departureDay);
            $this->model->setDepartureTime($departureTime);
            $this->model->setPrice($price);
            $this->model->setStartingDate($startingDate);
        }else if(filter_input(INPUT_POST, "mode", FILTER_SANITIZE_STRING) == "delete"){
            if ($flightScheduleId && is_numeric($flightScheduleId)) {
                if ($flightScheduleId > 0) {
                    $this->model->setFlightScheduleId($flightScheduleId);
                }
            }
        }else if(filter_input(INPUT_POST, "mode", FILTER_SANITIZE_STRING) == "generateDestination"){
            $this->setOrigin($origin);
        }else if(filter_input(INPUT_POST, "mode", FILTER_SANITIZE_STRING) == "update"){
            if ($flightScheduleId && is_numeric($flightScheduleId)) {
                if ($flightScheduleId > 0) {
                    $this->model->setFlightScheduleId($flightScheduleId);
                }
            }
            $this->model->setAirplaneId($airplaneId);
            $this->setOrigin($origin);
            $this->setDestination($destination);
            $this->model->setDepartureDay($departureDay);
            $this->model->setDepartureTime($departureTime);
            $this->model->setPrice($price);
            $this->model->setStartingDate($startingDate);
        }else if(filter_input(INPUT_POST, "mode", FILTER_SANITIZE_STRING) == "check_validation"){
            $this->model->setAirplaneId($airplaneId);
            $this->setOrigin($origin);
            $this->setDestination($destination);
            $this->model->setDepartureDay($departureDay);
            $this->model->setDepartureTime($departureTime);
            $this->model->setPrice($price);
            $this->model->setStartingDate($startingDate);
        }else if(filter_input(INPUT_POST, "mode", FILTER_SANITIZE_STRING) == "search"){
            $this->setPage($page);
            $this->setOrigin($origin);
            $this->setDestination($destination);
            $this->model->setAirplaneId($airplaneId);
            $this->setDepartureDay($departureDay);
            $this->setDepartureTimeFrom($departureTimeFrom);
            $this->setDepartureTimeTo($departureTimeTo);
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

        $sql = "SELECT A.flight_schedule_id, B.origin, B.destination, C.name, A.departure_day, A.departure_time
        FROM flight_schedule A
        JOIN route B ON A.route_id = B.route_id
        JOIN airplane C ON A.airplane_id = C.airplane_id
        WHERE starting_date >= '2000-01-01'";

        if($origin!=""){
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
        $sql.=" ORDER BY flight_schedule_id ASC";

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

    function generateDestination(){
        $origin = $this->getOrigin();
        $sql = "SELECT DISTINCT destination 
                FROM route
                WHERE origin = '$origin'";
        try {
            $statement = $this->connection->prepare($sql);
            try {
                $statement->execute();
                $result = $statement->get_result();
                $data = [];
                while (($row = $result->fetch_assoc()) == TRUE) {
                    $data[] = $row;
                }
                echo json_encode(
                    [
                        "status" => true,
                        "code" => ReturnCode::READ_SUCCESS,
                        "data" => $data
                    ]
                );
            } catch (Exception $exception) {
                throw new Exception($exception->getMessage(), ReturnCode::QUERY_FAILURE);
            }

        } catch (Exception $exception) {
            throw new Exception(ReturnCode::ACCESS_DENIED, ReturnCode::QUERY_FAILURE);
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
        case "generateDestination":
            $flightScheduleOop->generateDestination();
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
