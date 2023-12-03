<?php

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

class EmployerModel
{
    private String $employerID;
    private String $companyName;
    private String $contactPersonName;
    private String $emailAddress;
    private String $password;
    private String $phoneNumber;
    private String $addressLineOne;
    private String $addressLineTwo;
    private String $addressLineThree;
    private int $postcode;
    private String $city;
    private String $state;
    private String $numberOfEmployees;
    private String $industry;
    private String $aboutUs;
    private String $logo;
    private String $backgroundPicture;
    private String $officePictures;
    private String $websiteUrl;
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
        $this->companyName = $companyName;
        return $this;
    }

    public function getContactPersonName(): String
    {
        return $this->contactPersonName;
    }

    public function setContactPersonName(String $contactPersonName): EmployerModel
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

    public function getAddressLineOne(): String
    {
        return $this->addressLineOne;
    }

    public function setAddressLineOne(String $addressLineOne): EmployerModel
    {
        $this->addressLineOne = $addressLineOne;
        return $this;
    }

    public function getAddressLineTwo(): String
    {
        return $this->addressLineTwo;
    }

    public function setAddressLineTwo(String $addressLineTwo): EmployerModel
    {
        $this->addressLineTwo = $addressLineTwo;
        return $this;
    }

    public function getAddressLineThree(): String
    {
        return $this->addressLineThree;
    }

    public function setAddressLineThree(String $addressLineThree): EmployerModel
    {
        $this->addressLineThree = $addressLineThree;
        return $this;
    }

    public function getPostcode(): int
    {
        return $this->postcode;
    }

    public function setPostcode(int $postcode): EmployerModel
    {
        $this->postcode = $postcode;
        return $this;
    }

    public function getCity(): String
    {
        return $this->city;
    }

    public function setCity(String $city): EmployerModel
    {
        $this->city = $city;
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

    public function getWebsiteUrl(): String
    {
        return $this->websiteUrl;
    }
    
    public function setWebsiteUrl(String $websiteUrl): EmployerModel
    {
        $this->websiteUrl = $websiteUrl;
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
    const ACCESS_GRANTED = "200";

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

    private $confirmPassword;
    
    public function getConfirmPassword()
    {
        return $this->confirmPassword;
    }

    public function setConfirmPassword($confirmPassword=NULL): EmployerOop
    {
        $this->confirmPassword = $confirmPassword;
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
        $addressLineOne = filter_input(INPUT_POST, "addressLineOne", FILTER_SANITIZE_STRING);
        $addressLineTwo = filter_input(INPUT_POST, "addressLineTwo", FILTER_SANITIZE_STRING);
        $addressLineThree = filter_input(INPUT_POST, "addressLineThree", FILTER_SANITIZE_STRING);
        $postcode = filter_input(INPUT_POST, "postcode", FILTER_SANITIZE_NUMBER_INT);
        $city = filter_input(INPUT_POST, "city", FILTER_SANITIZE_STRING);
        $state = filter_input(INPUT_POST, "state", FILTER_SANITIZE_STRING);
        $numberOfEmployees = filter_input(INPUT_POST, "numberOfEmployees", FILTER_SANITIZE_STRING);
        $industry = filter_input(INPUT_POST, "industry", FILTER_SANITIZE_STRING);
        $aboutUs = filter_input(INPUT_POST, "aboutUs");
        $logo = filter_input(INPUT_POST, "logo", FILTER_SANITIZE_STRING);
        $backgroundPicture = filter_input(INPUT_POST, "backgroundPicture", FILTER_SANITIZE_STRING);
        $officePictures = filter_input(INPUT_POST, "officePictures", FILTER_SANITIZE_STRING);
        $websiteUrl = filter_input(INPUT_POST, "websiteUrl", FILTER_SANITIZE_URL);
        $facebookUrl = filter_input(INPUT_POST, "facebookUrl", FILTER_SANITIZE_URL);
        $linkedinUrl = filter_input(INPUT_POST, "linkedinUrl", FILTER_SANITIZE_URL);
        $whatsappUrl = filter_input(INPUT_POST, "whatsappUrl", FILTER_SANITIZE_URL);
        $status = filter_input(INPUT_POST, "status", FILTER_SANITIZE_STRING);
        $dateJoined = filter_input(INPUT_POST, "dateJoined", FILTER_SANITIZE_STRING);

        $confirmPassword = filter_input(INPUT_POST, "confirmPassword", FILTER_SANITIZE_STRING);

        if(filter_input(INPUT_POST, "mode", FILTER_SANITIZE_STRING) == "create"){
            $this->model->setEmailAddress($emailAddress);
            $this->model->setContactPersonName($contactPersonName);
            $this->model->setPhoneNumber($phoneNumber);
            $this->model->setCompanyName($companyName);
            $this->model->setPassword($password);
            $this->model->setStatus("Under Review");
        }elseif(filter_input(INPUT_POST, "mode", FILTER_SANITIZE_STRING) == "update"){
            $this->model->setEmployerID($employerID);
            $this->model->setCompanyName($companyName);
            $this->model->setContactPersonName($contactPersonName);
            $this->model->setEmailAddress($emailAddress);
            $this->model->setPassword($password);
            $this->model->setPhoneNumber($phoneNumber);
            $this->model->setAddressLineOne($addressLineOne);
            $this->model->setAddressLineTwo($addressLineTwo);
            $this->model->setAddressLineThree($addressLineThree);
            $this->model->setPostcode($postcode);
            $this->model->setCity($city);
            $this->model->setState($state);
            $this->model->setNumberOfEmployees($numberOfEmployees);
            $this->model->setIndustry($industry);
            $this->model->setAboutUs($aboutUs);
            $this->model->setLogo($logo);
            $this->model->setBackgroundPicture($backgroundPicture);
            $this->model->setOfficePictures($officePictures);
            $this->model->setWebsiteUrl($websiteUrl);
            $this->model->setFacebookUrl($facebookUrl);
            $this->model->setLinkedinUrl($linkedinUrl);
            $this->model->setWhatsappUrl($whatsappUrl);
            $this->model->setStatus($status);
            $this->model->setDateJoined($dateJoined);
            $this->setConfirmPassword($confirmPassword);
        }elseif(filter_input(INPUT_POST, "mode", FILTER_SANITIZE_STRING) == "update_password"){
            $this->model->setEmployerID($employerID);
            $this->model->setPassword($password);
        }elseif(filter_input(INPUT_POST, "mode", FILTER_SANITIZE_STRING) == "login_validation"){
            $this->model->setEmailAddress($emailAddress);
            $this->model->setPassword($password);
        }elseif(filter_input(INPUT_POST, "mode", FILTER_SANITIZE_STRING) == "check_validation"){
            $this->model->setCompanyName($companyName);
            $this->model->setContactPersonName($contactPersonName);
            $this->model->setEmailAddress($emailAddress);
            $this->model->setPassword($password);
            $this->model->setPhoneNumber($phoneNumber);
            $this->model->setAddressLineOne($addressLineOne);
            $this->model->setAddressLineTwo($addressLineTwo);
            $this->model->setPostcode($postcode);
            $this->model->setCity($city);
            $this->model->setState($state);
            $this->model->setNumberOfEmployees($numberOfEmployees);
            $this->model->setIndustry($industry);
            $this->model->setLogo($logo);
            $this->model->setBackgroundPicture($backgroundPicture);
            $this->model->setOfficePictures($officePictures);
            $this->setConfirmPassword($confirmPassword);
        
        }elseif(filter_input(INPUT_POST, "mode", FILTER_SANITIZE_STRING) == "register_validation"){
            $this->model->setEmailAddress($emailAddress);
            $this->model->setContactPersonName($contactPersonName);
            $this->model->setPhoneNumber($phoneNumber);
            $this->model->setCompanyName($companyName);
            $this->model->setPassword($password);
            $this->setConfirmPassword($confirmPassword);
        }elseif(filter_input(INPUT_POST, "mode", FILTER_SANITIZE_STRING) == "forgot_password_validation"){
            $this->model->setEmailAddress($emailAddress);
        }elseif(filter_input(INPUT_POST, "mode", FILTER_SANITIZE_STRING) == "reset_password_validation"){
            $this->model->setPassword($password);
            $this->setConfirmPassword($confirmPassword);
        }
        
    }

    /**
     * @throws Exception
     */
    function create()
    {
        $this->connection->autocommit(false);

        $tempID = "E".date('y');
        $currentID = $tempID."00000";

        // Generate new employerID
        //get number of records
        $total_data=0;
        $stat = $this->connection->query("SELECT count(*) as totalRecord
                                                FROM employer");
        while (($row = $stat->fetch_assoc()) == TRUE) {
            $total_data = $row['totalRecord'];
        }

        if($total_data > 0){
            $result = $this->connection->query("SELECT employerID
                                                FROM employer
                                                ORDER BY employerID ASC");
            while (($row = $result->fetch_assoc()) == TRUE) {
                if(substr($row['employerID'], 0, 3)==$tempID){
                    $currentID = $row['employerID'];
                }
            }
        }

        $newNumber = (int)(substr($currentID, 3)) + 1;
        $newNumber = sprintf('%05d', $newNumber);
        
        $newID = $tempID.$newNumber;

        $companyName = $this->model->getCompanyName();
        $contactPersonName = $this->model->getContactPersonName();
        $emailAddress = $this->model->getEmailAddress();
        $password = md5($this->model->getPassword());
        $phoneNumber = $this->model->getPhoneNumber();
        $status = $this->model->getStatus();

        if (strlen($companyName) > 0 &&  strlen($contactPersonName) > 0 &&  strlen($emailAddress) > 0 &&  strlen($phoneNumber) > 0 &&  strlen($password) > 0) {
            $statement = $this->connection->prepare("INSERT INTO employer (employerID, companyName, contactPersonName, emailAddress, password, phoneNumber, status) 
                                                    VALUES(?, ?, ?, ?, ?, ?, ?)");

            $statement->bind_param("sssssss", $newID, $companyName, $contactPersonName, $emailAddress, $password, $phoneNumber, $status);

            try {
                $statement->execute();
            } catch (Exception $exception) {
                throw new Exception($exception->getMessage(), ReturnCode::QUERY_FAILURE);
            }

            $this->connection->commit();
            echo json_encode(
                [
                    "status" => true,
                    "employerID" => $newID,
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
    function update()
    {
        $this->connection->autocommit(false);

        $employerID = $this->model->getEmployerID();
        $companyName = $this->model->getCompanyName();
        $contactPersonName = $this->model->getContactPersonName();
        $emailAddress = $this->model->getEmailAddress();
        $password = $this->model->getPassword();
        $phoneNumber = $this->model->getPhoneNumber();
        $addressLineOne = $this->model->getAddressLineOne();
        $addressLineTwo = $this->model->getAddressLineTwo();
        $addressLineThree = $this->model->getAddressLineThree();
        $postcode = $this->model->getPostcode();
        $city = $this->model->getCity();
        $state = $this->model->getState();
        $numberOfEmployees = $this->model->getNumberOfEmployees();
        $industry = $this->model->getIndustry();
        $aboutUs = $this->model->getAboutUs();
        $logo = $this->model->getLogo();
        $backgroundPicture = $this->model->getBackgroundPicture();
        $officePictures = $this->model->getOfficePictures();
        $websiteUrl = $this->model->getWebsiteUrl();
        $facebookUrl = $this->model->getFacebookUrl();
        $linkedinUrl = $this->model->getLinkedinUrl();
        $whatsappUrl = $this->model->getWhatsappUrl();
        $status = $this->model->getStatus();
        $dateJoined = $this->model->getDateJoined();


        if (strlen($companyName) > 0 &&  strlen($contactPersonName) > 0 &&  strlen($emailAddress) > 0 &&  strlen($addressLineOne) > 0 &&  strlen($addressLineTwo) > 0 && strlen($city) > 0 &&  strlen($numberOfEmployees) > 0 &&  strlen($industry) > 0 &&  strlen($state) > 0) {
            $sql = "UPDATE employer 
            SET companyName = '$companyName', contactPersonName = '$contactPersonName', emailAddress = '$emailAddress', phoneNumber = '$phoneNumber', addressLineOne = '$addressLineOne', addressLineTwo = '$addressLineTwo', addressLineThree = '$addressLineThree',
                 postcode = $postcode, city = '$city', state = '$state', numberOfEmployees = '$numberOfEmployees', industry = '$industry', aboutUs = '$aboutUs', websiteUrl = '$websiteUrl',
                 facebookUrl = '$facebookUrl', linkedinUrl = '$linkedinUrl', whatsappUrl = '$whatsappUrl', status = '$status', dateJoined = '$dateJoined' ";

            if($password!=""){
                $password = md5($password);
                $sql.=", password = '$password'";
            }
            if($logo!=""){
                $sql.=", logo = '$logo'";
            }
            if($backgroundPicture!=""){
                $sql.=", backgroundPicture = '$backgroundPicture'";
            }
            if($officePictures!=""){
                $sql.=", officePictures = '$officePictures'";
            }
            $sql.=" WHERE employerID = '$employerID'";

            if ($this->connection->query($sql) === TRUE) {
                // echo "Record updated successfully";
            } else {
                // echo "Error updating record: " . $this->connection->error;
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
    function update_password()
    {
        $this->connection->autocommit(false);

        $employerID = $this->model->getEmployerID();
        $password = md5($this->model->getPassword());

        if (strlen($password) > 0) {
            $statement = $this->connection->prepare("UPDATE employer 
                                                    SET password = ? 
                                                    WHERE employerID = ?");
            $statement->bind_param("ss", $password, $employerID);

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
    

    function login_validation(){
        $datas[]['inputName']="";
        $datas[]['errorMessage']="";

        $emailAddress = $this->model->getEmailAddress();
        $password = $this->model->getPassword();

        $i=0;
        $accountFound = false;
        $employerID="";
        $companyName="";
        $status="";

        //null checking
        if ($emailAddress == "") {
            $datas[$i]['inputName'] = "emailAddress";
            $datas[$i]['errorMessage'] = "Email Address is required";
            $i++;
        }elseif (filter_var($emailAddress, FILTER_VALIDATE_EMAIL)==false) {
            $datas[$i]['inputName'] = "emailAddress";
            $datas[$i]['errorMessage'] = "Invalid email address";
            $i++;
        }
        
        if ($password == "") {
            $datas[$i]['inputName'] = "password";
            $datas[$i]['errorMessage'] = "Password is required";
            $i++;
        }

        if($emailAddress!="" && $password!="" && $i==0){
            $foundEmail=false;
            $emailSql = "SELECT count(*) as totalRecord
                    FROM employer
                    WHERE emailAddress = '$emailAddress'";
            
            $statement = $this->connection->query($emailSql);
            while(($row = $statement->fetch_assoc())==TRUE){
                $row['totalRecord'] > 0?($foundEmail=true):($foundEmail=false);
            }
            if($foundEmail){
                $password = md5($password);
                
                $sql = "SELECT count(*) as totalRecord, employerID, status, companyName
                FROM employer
                WHERE emailAddress = '$emailAddress' AND password = '$password'";
        
                $statement = $this->connection->query($sql);
                while(($row = $statement->fetch_assoc())==TRUE){
                    $row['totalRecord'] > 0?($accountFound=true):($accountFound=false);
                    $employerID = $row['employerID'];
                    $companyName = $row['companyName'];
                    $status = $row['status'];
                }
                
                if($status == "Under Review"){
                    $datas[$i]['inputName']="emailAddress";
                    $datas[$i]['errorMessage']="Your application is under review. Please wait... ";
                    $i++;
                }elseif($status == "Rejected"){
                    $datas[$i]['inputName']="emailAddress";
                    $datas[$i]['errorMessage']="Your application has been rejected";
                    $i++;
                }else if($accountFound==false){
                    $datas[$i]['inputName']="password";
                    $datas[$i]['errorMessage']="Incorrect password";
                    $i++;
                }
            }else{
                $datas[$i]['inputName']="emailAddress";
                $datas[$i]['errorMessage']="Account not found";
                $i++;
            }
        }

        if($i>0){
            echo json_encode(
                [
                    "status" => false,
                    "data" => $datas,
                ]
            );
        } else{
            $todaysDate = date('Y-m-d');
            $subscriptionID = "";
            $selectSQL = "SELECT subscriptionID, endDate
                            FROM subscription
                            WHERE employerID = '$employerID' AND isActive =1";
            $stat = $this->connection->query($selectSQL);
            
            if($stat->num_rows>0){
                while(($row = $stat->fetch_assoc())==TRUE){
                    if($todaysDate>$row['endDate']){
                        $subscriptionID = $row['subscriptionID'];
                    }
                }
            }

            if($subscriptionID!=""){
                $updateSQL = "UPDATE subscription
                                SET isActive = 0
                                WHERE subscriptionID = '$subscriptionID'";
                $stat = $this->connection->query($updateSQL);
                $updateSQL = "UPDATE job_posting
                                SET isPublish = 'Unpublished'
                                WHERE employerID = '$employerID'";
                $stat = $this->connection->query($updateSQL);
            }
            
            session_start();
            $sql = "SELECT B.maxJobPosting, B.maxFeatureJobListing, A.subscriptionID, databaseAccess
                    FROM subscription A
                    JOIN subscription_plan B ON A.subscriptionPlanID = B.subscriptionPlanID
                    WHERE A.employerID = '$employerID' AND A.endDate>='$todaysDate' AND A.startDate<='$todaysDate'  AND A.isActive =1";
            $statement = $this->connection->query($sql);

            if($statement->num_rows > 0){
                while(($row = $statement->fetch_assoc())==TRUE){
                    $_SESSION['maxJobPosting']= $row['maxJobPosting'];
                    $_SESSION['maxFeatureJobListing']= $row['maxFeatureJobListing'];
                    $_SESSION['subscriptionID']=base64_encode($row['subscriptionID']);
                    $_SESSION['db_access'] = $row['databaseAccess'];
                }
            }else{
                $_SESSION['maxJobPosting']= 0;
                $_SESSION['maxFeatureJobListing']= 0;
                $_SESSION['subscriptionID']="";
                $_SESSION['db_access'] = 0;
            }
            $_SESSION['login']=true;
            $_SESSION['employerID']=base64_encode($employerID);
            $_SESSION['companyName']=$companyName;

            echo json_encode(
                [
                    "status" => true,
                ]
            );
        }
    }

    function check_validation(){
        $datas[]['inputName']="";
        $datas[]['errorMessage']="";

        $companyName = $this->model->getCompanyName();
        $contactPersonName = $this->model->getContactPersonName();
        $emailAddress = $this->model->getEmailAddress();
        $password = $this->model->getPassword();
        $confirmPassword = $this->getConfirmPassword();
        $phoneNumber = $this->model->getPhoneNumber();
        $addressLineOne = $this->model->getAddressLineOne();
        $addressLineTwo = $this->model->getAddressLineTwo();
        $postcode = $this->model->getPostcode();
        $city = $this->model->getCity();
        $state = $this->model->getState();
        $numberOfEmployees = $this->model->getNumberOfEmployees();
        $industry = $this->model->getIndustry();
        $logo = $this->model->getLogo();
        $backgroundPicture = $this->model->getBackgroundPicture();
        $officePictures = $this->model->getOfficePictures();

        $i=0;

        //null checking
        if ($companyName == "") {
            $datas[$i]['inputName'] = "companyName";
            $datas[$i]['errorMessage'] = "Company Name is required";
            $i++;
        }
    
        if ($contactPersonName == "") {
            $datas[$i]['inputName'] = "contactPersonName";
            $datas[$i]['errorMessage'] = "Contact Person Name is required";
            $i++;
        }

        if ($emailAddress == "") {
            $datas[$i]['inputName'] = "emailAddress";
            $datas[$i]['errorMessage'] = "Email Address is required";
            $i++;
        }else if (filter_var($emailAddress, FILTER_VALIDATE_EMAIL)==false) {
            $datas[$i]['inputName'] = "emailAddress";
            $datas[$i]['errorMessage'] = "Invalid email address";
            $i++;
        }
        
        if($password!=""){
            $uppercase = preg_match('@[A-Z]@', $password);
            $lowercase = preg_match('@[a-z]@', $password);
            $number    = preg_match('@[0-9]@', $password);
            $specialChars = preg_match('@[^\w]@', $password);
            if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
                $datas[$i]['inputName']="password";
                $datas[$i]['errorMessage']="Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character";
                $i++;
            }

            if($password!=$confirmPassword){
                $datas[$i]['inputName']="password";
                $datas[$i]['errorMessage']="Password does not match with Confirm Password";
                $i++;
                $datas[$i]['inputName']="confirmPassword";
                $datas[$i]['errorMessage']="Password does not match with Confirm Password";
                $i++;
            }
        }

    
        if ($phoneNumber == "") {
            $datas[$i]['inputName'] = "phoneNumber";
            $datas[$i]['errorMessage'] = "Phone Number is required";
            $i++;
        }elseif(substr_count($phoneNumber, '-')>0){
            $datas[$i]['inputName'] = "phoneNumber";
            $datas[$i]['errorMessage'] = "Do not include '-'";
            $i++;
        }elseif(!preg_match('/^[0-9]{9,10}+$/', $phoneNumber)){
            $datas[$i]['inputName'] = "phoneNumber";
            $datas[$i]['errorMessage'] = "Invalid phone number";
            $i++;
        }
    
        if ($addressLineOne == "") {
            $datas[$i]['inputName'] = "addressLineOne";
            $datas[$i]['errorMessage'] = "Address Line One is required";
            $i++;
        }
        if ($addressLineTwo == "") {
            $datas[$i]['inputName'] = "addressLineTwo";
            $datas[$i]['errorMessage'] = "Address Line Two is required";
            $i++;
        }
        if ($postcode == 0) {
            $datas[$i]['inputName'] = "postcode";
            $datas[$i]['errorMessage'] = "Postcode is required";
            $i++;
        }
        if ($city == "") {
            $datas[$i]['inputName'] = "city";
            $datas[$i]['errorMessage'] = "City is required";
            $i++;
        }
        if ($state == "") {
            $datas[$i]['inputName'] = "state";
            $datas[$i]['errorMessage'] = "State is required";
            $i++;
        }
        if ($numberOfEmployees == "") {
            $datas[$i]['inputName'] = "numberOfEmployees";
            $datas[$i]['errorMessage'] = "Number of Employees is required";
            $i++;
        }
    
        if ($industry == "") {
            $datas[$i]['inputName'] = "industry";
            $datas[$i]['errorMessage'] = "Industry is required";
            $i++;
        }
        
        if($logo != ""){
            $ext = strtolower(pathinfo($logo, PATHINFO_EXTENSION));
            if ($ext !== 'gif' && $ext !== 'png' && $ext !== 'jpg') {
                $datas[$i]['inputName'] = "logo";
                $datas[$i]['errorMessage'] = "Logo should only in .gif | .png | .jpg format";
                $i++;
            }
        }

        if($backgroundPicture != ""){
            $ext = strtolower(pathinfo($backgroundPicture, PATHINFO_EXTENSION));
            if ($ext !== 'gif' && $ext !== 'png' && $ext !== 'jpg') {
                $datas[$i]['inputName'] = "backgroundPicture";
                $datas[$i]['errorMessage'] = "Background Picture should only in .gif | .png | .jpg format";
                $i++;
            }
        }

        if($officePictures!=""){
            $officePictureArr = explode(',', $officePictures);
            foreach($officePictureArr as $officePicture){
                $ext = strtolower(pathinfo($officePicture, PATHINFO_EXTENSION));
                if ($ext !== 'gif' && $ext !== 'png' && $ext !== 'jpg') {
                    $datas[$i]['inputName'] = "officePictures";
                    $datas[$i]['errorMessage'] = "Office Pictures should only in .gif | .png | .jpg format";
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

    function register_validation(){
        $datas[]['inputName']="";
        $datas[]['errorMessage']="";

        $companyName = $this->model->getCompanyName();
        $contactPersonName = $this->model->getContactPersonName();
        $emailAddress = $this->model->getEmailAddress();
        $password = $this->model->getPassword();
        $confirmPassword = $this->getConfirmPassword();
        $phoneNumber = $this->model->getPhoneNumber();

        $i=0;

        

        //null checking
        if ($companyName == "") {
            $datas[$i]['inputName'] = "companyName";
            $datas[$i]['errorMessage'] = "Company Name is required";
            $i++;
        }
    
        if ($contactPersonName == "") {
            $datas[$i]['inputName'] = "contactPersonName";
            $datas[$i]['errorMessage'] = "Contact Person Name is required";
            $i++;
        }

        if ($emailAddress == "") {
            $datas[$i]['inputName'] = "emailAddress";
            $datas[$i]['errorMessage'] = "Email Address is required";
            $i++;
        }else if (filter_var($emailAddress, FILTER_VALIDATE_EMAIL)==false) {
            $datas[$i]['inputName'] = "emailAddress";
            $datas[$i]['errorMessage'] = "Invalid email address";
            $i++;
        }else{
            $emailSQL = "
                SELECT employerID
                FROM employer
                WHERE emailAddress = '$emailAddress'
            ";
            $stat = $this->connection->query($emailSQL);
            if($stat->num_rows>0){
                $datas[$i]['inputName'] = "emailAddress";
                $datas[$i]['errorMessage'] = "Email address has been used.";
                $i++;
            }
        }
        
        if($password ==""){
            $datas[$i]['inputName']="password";
            $datas[$i]['errorMessage']="Password is required";
            $i++;
        }else{
            $uppercase = preg_match('@[A-Z]@', $password);
            $lowercase = preg_match('@[a-z]@', $password);
            $number    = preg_match('@[0-9]@', $password);
            $specialChars = preg_match('@[^\w]@', $password);
            if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
                $datas[$i]['inputName']="password";
                $datas[$i]['errorMessage']="Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character";
                $i++;
            }elseif($password!=$confirmPassword){
                $datas[$i]['inputName']="password";
                $datas[$i]['errorMessage']="Password does not match with Confirm Password";
                $i++;
                $datas[$i]['inputName']="confirmPassword";
                $datas[$i]['errorMessage']="Password does not match with Confirm Password";
                $i++;
            }
        }

        if ($phoneNumber == "") {
            $datas[$i]['inputName'] = "phoneNumber";
            $datas[$i]['errorMessage'] = "Phone Number is required";
            $i++;
        }elseif(substr_count($phoneNumber, '-')>0){
            $datas[$i]['inputName'] = "phoneNumber";
            $datas[$i]['errorMessage'] = "Do not include '-'";
            $i++;
        }elseif(!preg_match('/^[0-9]{9,10}+$/', $phoneNumber)){
            $datas[$i]['inputName'] = "phoneNumber";
            $datas[$i]['errorMessage'] = "Invalid phone number";
            $i++;
        }else{
            $phoneSQL = "
                SELECT employerID
                FROM employer
                WHERE phoneNumber = '$phoneNumber'
            ";
            $stat = $this->connection->query($phoneSQL);
            if($stat->num_rows>0){
                $datas[$i]['inputName'] = "phoneNumber";
                $datas[$i]['errorMessage'] = "Phone Number has been used.";
                $i++;
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

    function forgot_password_validation(){
        $datas[]['inputName']="";
        $datas[]['errorMessage']="";

        $emailAddress = $this->model->getEmailAddress();
        $companyName="";
        $employerID="";
        $i=0;

        //null checking
        if ($emailAddress == "") {
            $datas[$i]['inputName'] = "emailAddress";
            $datas[$i]['errorMessage'] = "Email Address is required";
            $i++;
        }elseif (filter_var($emailAddress, FILTER_VALIDATE_EMAIL)==false) {
            $datas[$i]['inputName'] = "emailAddress";
            $datas[$i]['errorMessage'] = "Invalid email address";
            $i++;
        }

        if($emailAddress!="" && $i==0){
            $foundEmail=false;
            $emailSql = "SELECT count(*) as totalRecord, companyName, employerID
                    FROM employer
                    WHERE emailAddress = '$emailAddress'";
            
            $statement = $this->connection->query($emailSql);
            while(($row = $statement->fetch_assoc())==TRUE){
                $row['totalRecord'] > 0?($foundEmail=true):($foundEmail=false);
                $companyName = $row['companyName'];
                $employerID = $row['employerID'];
            }
            if(!$foundEmail){
                $datas[$i]['inputName']="emailAddress";
                $datas[$i]['errorMessage']="Account not found, please register.";
                $i++;
            }else{
                $this->model->setEmployerID($employerID);
                $this->model->setCompanyName($companyName);
                $this->send_email();
            }
        }

        if($i>0){
            echo json_encode(
                [
                    "status" => false,
                    "data" => $datas,
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

    function reset_password_validation(){
        $datas[]['inputName']="";
        $datas[]['errorMessage']="";

        $password = $this->model->getPassword();
        $confirmPassword= $this->getConfirmPassword();
        $i=0;

        //null checking
        if($password ==""){
            $datas[$i]['inputName']="password";
            $datas[$i]['errorMessage']="Password is required";
            $i++;
        }else{
            $uppercase = preg_match('@[A-Z]@', $password);
            $lowercase = preg_match('@[a-z]@', $password);
            $number    = preg_match('@[0-9]@', $password);
            $specialChars = preg_match('@[^\w]@', $password);
            if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
                $datas[$i]['inputName']="password";
                $datas[$i]['errorMessage']="Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character";
                $i++;
            }elseif($password!=$confirmPassword){
                $datas[$i]['inputName']="password";
                $datas[$i]['errorMessage']="Password does not match with Confirm Password";
                $i++;
                $datas[$i]['inputName']="confirmPassword";
                $datas[$i]['errorMessage']="Password does not match with Confirm Password";
                $i++;
            }
        }

        if($i>0){
            echo json_encode(
                [
                    "status" => false,
                    "data" => $datas,
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

    private function send_email(){
        $emailAddress = $this->model->getEmailAddress();
        $companyName = $this->model->getCompanyName();
        $employerID = base64_encode($this->model->getEmployerID());
        // Create a new PHPMailer object
        $mail = new PHPMailer(true);
        
        $content = "
            <!DOCTYPE html>
            <html lang='en'>

            <head>
                <meta charset='UTF-8'>
                <meta http-equiv='X-UA-Compatible' content='IE=edge'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Password Reset</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        margin: 0;
                        padding: 0;
                        background-color: #f4f4f4;
                    }

                    .container {
                        max-width: 600px;
                        margin: 20px auto;
                        background-color: #fff;
                        padding: 20px;
                        border-radius: 5px;
                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    }

                    h2 {
                        color: #333;
                    }

                    p {
                        color: #666;
                    }

                    a {
                        color: #3498db;
                        text-decoration: none;
                        font-weight: bold;
                    }
                </style>
            </head>

            <body>
                    <h2>Password Reset</h2>
                    <p>Dear $companyName,</p>
                    <p>We hope this email finds you well. It appears that you've requested to reset your password for your account with Job Nexus. To complete the password reset process, please click on the following link:</p>
                    <p><a href='localhost/jobnexus/employer/security/reset_password.php?id=$employerID'>Reset Your Password</a></p>
                    <p>If you did not initiate this password reset or if you believe this is an error, please disregard this email. Your password will remain unchanged.</p>
                    <p>For your security, please ensure that you use this link within the next 5 minutes. After this period, the link will expire, and you may need to request another password reset.</p>
                    <p>If you encounter any issues or have questions, feel free to contact our support team at <a href='mailto:jobnexus2@gmail.com'>jobnexus2@gmail.com</a>.</p>
                    <p>Thank you for choosing Job Nexus.</p>
                    <p>Best regards,<br>Job Nexus<br>016-2462609</p>
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
        $mail->addAddress($emailAddress);
        $mail->isHTML(true);
        $mail->Subject = "Reset Your Password";
        $mail->Body = $content;
    
        if($mail->send()){
            session_start();
            $_SESSION['resetPasswordTime']=time()+300;
        }
    }
}

    header('Content-Type: application/json');
    header("Access-Control-Allow-Origin: *"); // this is to prevent from javascript given cors error

    $mode = filter_input(INPUT_POST, "mode", FILTER_SANITIZE_STRING);

    $employerOop = new EmployerOop();
    try {
        switch ($mode) {
            case "create":
                $employerOop->create();
                break;
            case "update":
                $employerOop->update();
                break;
            case "login_validation":
                $employerOop->login_validation();
                break;
            case "check_validation":
                $employerOop->check_validation();
                break;
            case "register_validation":
                $employerOop->register_validation();
                break;
            case "forgot_password_validation":
                $employerOop->forgot_password_validation();
                break;
            case "reset_password_validation":
                $employerOop->reset_password_validation();
                break;
            case "update_password":
                $employerOop->update_password();
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