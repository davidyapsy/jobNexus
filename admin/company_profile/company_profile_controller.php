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

class EmployerModel
{
    private String $employerID;
    private String $companyName;
    private String $contactPersonName;
    private String $emailAddress;
    private String $password;
    private String $phoneNumber;
    private String $address;
    private String $numberOfEmployees;
    private String $industry;
    private String $state;
    private String $aboutUs;
    private String $logo;
    private String $backgroundPicture;
    private String $officePictures;
    private String $facebookUrl;
    private String $linkedinUrl;
    private String $whatsappUrl;
    private String $status;
    private String $dateJoined;

    public function getEmployerID(): String
    {
        return $this->employerID;
    }

    public function setEmployerID(String $employerID): EmployerModel
    {
        $this->employerID = $employerID;
        return $this;
    }

    public function getCompanyName(): String
    {
        return $this->companyName;
    }

    public function setCompanyName(String $companyName): EmployerModel
    {
        $this->routeId = $routeId;
        return $this;
    }

    public function getContactPersonName(): int
    {
        return $this->contactPersonName;
    }

    public function setcontactPersonName(int $contactPersonName): EmployerModel
    {
        $this->contactPersonName = $contactPersonName;
        return $this;
    }

    public function getEmailAddress(): String
    {
        return $this->emailAddress;
    }

    public function setEmailAddress(String $emailAddress): EmployerModel
    {
        $this->emailAddress = $emailAddress;
        return $this;
    }

    public function getPassword(): String
    {
        return $this->password;
    }

    public function setPassword(String $password): EmployerModel
    {
        $this->password = $password;
        return $this;
    }

    public function getPhoneNumber(): String
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(String $phoneNumber): EmployerModel
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

    public function getAddress(): String
    {
        return $this->address;
    }

    public function setAddress(String $address): EmployerModel
    {
        $this->address = $address;
        return $this;
    }

    public function getNumberOfEmployees(): String
    {
        return $this->numberOfEmployees;
    }

    public function setNumberOfEmployees(String $numberOfEmployees): EmployerModel
    {
        $this->numberOfEmployees = $numberOfEmployees;
        return $this;
    }

    public function getIndustry(): String
    {
        return $this->industry;
    }

    public function setIndustry(String $industry): EmployerModel
    {
        $this->industry = $industry;
        return $this;
    }

    public function getState(): String
    {
        return $this->state;
    }

    public function setState(String $state): EmployerModel
    {
        $this->state = $state;
        return $this;
    }

    public function getAboutUs(): String
    {
        return $this->aboutUs;
    }

    public function setAboutUs(String $aboutUs): EmployerModel
    {
        $this->aboutUs = $aboutUs;
        return $this;
    }

    public function getLogo(): String
    {
        return $this->logo;
    }

    public function setLogo(String $logo): EmployerModel
    {
        $this->logo = $logo;
        return $this;
    }

    public function getBackgroundPicture(): String
    {
        return $this->backgroundPicture;
    }

    public function setBackgroundPicture(String $backgroundPicture): EmployerModel
    {
        $this->backgroundPicture = $backgroundPicture;
        return $this;
    }

    public function getOfficePictures(): String
    {
        return $this->officePictures;
    }

    public function setOfficePictures(String $officePictures): EmployerModel
    {
        $this->officePictures = $officePictures;
        return $this;
    }

    public function getFacebookUrl(): String
    {
        return $this->facebookUrl;
    }
    
    public function setFacebookUrl(String $facebookUrl): EmployerModel
    {
        $this->facebookUrl = $facebookUrl;
        return $this;
    }
    
    public function getLinkedinUrl(): String
    {
        return $this->linkedinUrl;
    }
    
    public function setLinkedinUrl(String $linkedinUrl): EmployerModel
    {
        $this->linkedinUrl = $linkedinUrl;
        return $this;
    }
    
    public function getWhatsappUrl(): String
    {
        return $this->whatsappUrl;
    }
    
    public function setWhatsappUrl(String $whatsappUrl): EmployerModel
    {
        $this->whatsappUrl = $whatsappUrl;
        return $this;
    }
    
    public function getStatus(): String
    {
        return $this->status;
    }
    
    public function setStatus(String $status): EmployerModel
    {
        $this->status = $status;
        return $this;
    }
    
    public function getDateJoined(): String
    {
        return $this->dateJoined;
    }
    
    public function setDateJoined(String $dateJoined): EmployerModel
    {
        $this->dateJoined = $dateJoined;
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

class EmployerOop
{
    private ConnectionString $connectionString;
    private EmployerModel $model;
    private mysqli $connection;

    private $destination;
    
    public function getDestination(): String
    {
        return $this->destination;
    }

    public function setDestination($destination=""): EmployerOop
    {
        $this->destination = $destination;
        return $this;
    }

    /**
     * SimpleOop constructor.
     * @throws Exception
     */
    function __construct()
    {
        // declare object / injection
        $this->model = new EmployerModel();
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
        $companyName = filter_input(INPUT_POST, "companyName", FILTER_SANITIZE_STRING);
        $contactPersonName = filter_input(INPUT_POST, "contactPersonName", FILTER_SANITIZE_STRING);
        $emailAddress = filter_input(INPUT_POST, "emailAddress", FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
        $phoneNumber = filter_input(INPUT_POST, "phoneNumber", FILTER_SANITIZE_STRING);
        $address = filter_input(INPUT_POST, "address", FILTER_SANITIZE_STRING);
        $numberOfEmployees = filter_input(INPUT_POST, "numberOfEmployees", FILTER_SANITIZE_STRING);
        $industry = filter_input(INPUT_POST, "industry", FILTER_SANITIZE_STRING);
        $state = filter_input(INPUT_POST, "state", FILTER_SANITIZE_STRING);
        $aboutUs = filter_input(INPUT_POST, "aboutUs", FILTER_SANITIZE_STRING);
        $logo = filter_input(INPUT_POST, "logo", FILTER_SANITIZE_STRING);
        $backgroundPicture = filter_input(INPUT_POST, "backgroundPicture", FILTER_SANITIZE_STRING);
        $officePictures = filter_input(INPUT_POST, "officePictures", FILTER_SANITIZE_STRING);
        $facebookUrl = filter_input(INPUT_POST, "facebookUrl", FILTER_SANITIZE_URL);
        $linkedinUrl = filter_input(INPUT_POST, "linkedinUrl", FILTER_SANITIZE_URL);
        $whatsappUrl = filter_input(INPUT_POST, "whatsappUrl", FILTER_SANITIZE_URL);
        $status = filter_input(INPUT_POST, "status", FILTER_SANITIZE_STRING);
        $dateJoined = filter_input(INPUT_POST, "dateJoined", FILTER_SANITIZE_STRING);
        
        $this->model->setEmployerID($employerID);
        $this->model->setCompanyName($companyName);
        $this->model->setContactPersonName($contactPersonName);
        $this->model->setEmailAddress($emailAddress);
        $this->model->setPassword($password);
        $this->model->setPhoneNumber($phoneNumber);
        $this->model->setAddress($address);
        $this->model->setNumberOfEmployees($numberOfEmployees);
        $this->model->setIndustry($industry);
        $this->model->setState($state);
        $this->model->setAboutUs($aboutUs);
        $this->model->setLogo($logo);
        $this->model->setBackgroundPicture($backgroundPicture);
        $this->model->setOfficePictures($officePictures);
        $this->model->setFacebookUrl($facebookUrl);
        $this->model->setLinkedinUrl($linkedinUrl);
        $this->model->setWhatsappUrl($whatsappUrl);
        $this->model->setStatus($status);
        $this->model->setDateJoined($dateJoined);
    }

    /**
     * @throws Exception
     */
    function update()
    {
        $this->connection->autocommit(false);

        $employerID = $this->model->getEmployerID();
        $companyName = $this->model->getCompanyName();
        $contactPersonName = $this->model->getContactPersonName();
        $emailAddress = $this->model->getEmailAddress();
        $password = $this->model->getPassword();
        $phoneNumber = $this->model->getPhoneNumber();
        $address = $this->model->getAddress();
        $numberOfEmployees = $this->model->getNumberOfEmployees();
        $industry = $this->model->getIndustry();
        $state = $this->model->getState();
        $aboutUs = $this->model->getAboutUs();
        $logo = $this->model->getLogo();
        $backgroundPicture = $this->model->getBackgroundPicture();
        $officePictures = $this->model->getOfficePictures();
        $facebookUrl = $this->model->getFacebookUrl();
        $linkedinUrl = $this->model->getLinkedinUrl();
        $whatsappUrl = $this->model->getWhatsappUrl();
        $status = $this->model->getStatus();
        $dateJoined = $this->model->getDateJoined();

        // if (strlen($name) > 0 &&  strlen($phoneNumber) > 0 &&  strlen($emailAddress) > 0 &&  strlen($status) > 0 &&  strlen($position) > 0) {
            if($password!=""){
                $password = md5($password);
                $statement = $this->connection->prepare("UPDATE employer 
                SET companyName = ?, contactPersonName = ?, emailAddress = ?, password = ?, phoneNumber = ?, address = ?, numberOfEmployees = ?, industry = ?, 
                    state = ?, aboutUs = ?, logo = ?, backgroundPicture = ?, officePictures = ?, facebookUrl = ?, linkedinUrl = ?, whatsappUrl = ?, status = ?, dateJoined = ?
                WHERE employerID = ?");
                $statement->bind_param("sssssssssssssssssss", $companyName, $contactPersonName, $emailAddress, $password, $phoneNumber, $address, $numberOfEmployees, $industry, $state, 
                    $aboutUs, $logo, $backgroundPicture, $officePictures, $facebookUrl, $linkedinUrl, $whatsappUrl, $status, $dateJoined, $employerID);
            }else{
                $statement = $this->connection->prepare("UPDATE employer 
                SET companyName = ?, contactPersonName = ?, emailAddress = ?, password = ?, phoneNumber = ?, address = ?, numberOfEmployees = ?, industry = ?, 
                    state = ?, aboutUs = ?, logo = ?, backgroundPicture = ?, officePictures = ?, facebookUrl = ?, linkedinUrl = ?, whatsappUrl = ?, status = ?, dateJoined = ?
                WHERE employerID = ?");
                $statement->bind_param("sssssssssssssssssss", $companyName, $contactPersonName, $emailAddress, $password, $phoneNumber, $address, $numberOfEmployees, $industry, $state, 
                    $aboutUs, $logo, $backgroundPicture, $officePictures, $facebookUrl, $linkedinUrl, $whatsappUrl, $status, $dateJoined, $employerID);
            }
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

        // } else {
        //     throw new Exception(ReturnCode::ACCESS_DENIED);
        // }
    }

    function check_validation(){
        $datas[]['inputName']="";
        $datas[]['errorMessage']="";

        $contactPersonName = $this->model->getcontactPersonName();
        $origin = $this->getOrigin();
        $destination = $this->getDestination();
        $phoneNumber = $this->model->getDepartureDay();
        $emailAddress = $this->model->getemailAddress();
        $price = $this->model->getPrice();
        $address = $this->model->getStartingDate();
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
        if($contactPersonName==0){
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
        if($phoneNumber==""){
            $datas[$i]['inputName']="phoneNumber";
            $datas[$i]['errorMessage']="Departure day is required";
            $i++;
        }
        if($emailAddress==""){
            $datas[$i]['inputName']="emailAddress";
            $datas[$i]['errorMessage']="Departure Time is required";
            $i++;
        }
        if($price==0){
            $datas[$i]['inputName']="price";
            $datas[$i]['errorMessage']="Price is required";
            $i++;
        }
        if($address==""){
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
        if($contactPersonName!=0 && $origin !="" && $type=="add"){
            $lastDestination = "";
            $airplaneName = "";
            foreach ($db_datas as $db_data){
                if($db_data['airplane_id'] == $contactPersonName){
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

$employerOop = new EmployerOop();
try {
    switch ($mode) {
        case  "update":
            $employerOop->update();
            break;
        case "check_validation":
            $employerOop->check_validation();
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
