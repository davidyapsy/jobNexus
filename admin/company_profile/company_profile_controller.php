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
        $facebookUrl = filter_input(INPUT_POST, "facebookUrl", FILTER_SANITIZE_URL);
        $linkedinUrl = filter_input(INPUT_POST, "linkedinUrl", FILTER_SANITIZE_URL);
        $whatsappUrl = filter_input(INPUT_POST, "whatsappUrl", FILTER_SANITIZE_URL);
        $status = filter_input(INPUT_POST, "status", FILTER_SANITIZE_STRING);
        $dateJoined = filter_input(INPUT_POST, "dateJoined", FILTER_SANITIZE_STRING);

        $confirmPassword = filter_input(INPUT_POST, "confirmPassword", FILTER_SANITIZE_STRING);

        
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
        $this->model->setFacebookUrl($facebookUrl);
        $this->model->setLinkedinUrl($linkedinUrl);
        $this->model->setWhatsappUrl($whatsappUrl);
        $this->model->setStatus($status);
        $this->model->setDateJoined($dateJoined);
        $this->setConfirmPassword($confirmPassword);
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
        $facebookUrl = $this->model->getFacebookUrl();
        $linkedinUrl = $this->model->getLinkedinUrl();
        $whatsappUrl = $this->model->getWhatsappUrl();
        $status = $this->model->getStatus();
        $dateJoined = $this->model->getDateJoined();


        if (strlen($companyName) > 0 &&  strlen($contactPersonName) > 0 &&  strlen($emailAddress) > 0 &&  strlen($addressLineOne) > 0 &&  strlen($addressLineTwo) > 0 && strlen($city) > 0 &&  strlen($numberOfEmployees) > 0 &&  strlen($industry) > 0 &&  strlen($state) > 0) {
            if($password!=""){
                $password = md5($password);
                $statement = $this->connection->prepare("UPDATE employer 
                SET companyName = ?, contactPersonName = ?, emailAddress = ?, password = ?, phoneNumber = ?, addressLineOne = ?, addressLineTwo = ?, addressLineThree = ?,
                     postcode = ?, city = ?, state = ?, numberOfEmployees = ?, industry = ?, aboutUs = ?, logo = ?, backgroundPicture = ?, officePictures = ?, facebookUrl = ?, 
                     linkedinUrl = ?, whatsappUrl = ?, status = ?, dateJoined = ?
                WHERE employerID = ?");
                $statement->bind_param("ssssssssissssssssssssss", $companyName, $contactPersonName, $emailAddress, $password, $phoneNumber, $addressLineOne, $addressLineTwo, $addressLineThree,
                    $postcode, $city, $state, $numberOfEmployees, $industry, $aboutUs, $logo, $backgroundPicture, $officePictures, $facebookUrl, 
                    $linkedinUrl, $whatsappUrl, $status, $dateJoined, $employerID);
            }else{
                $statement = $this->connection->prepare("UPDATE employer 
                SET companyName = ?, contactPersonName = ?, emailAddress = ?, phoneNumber = ?, addressLineOne = ?, addressLineTwo = ?, addressLineThree = ?,
                     postcode = ?, city = ?, state = ?, numberOfEmployees = ?, industry = ?, aboutUs = ?, logo = ?, backgroundPicture = ?, officePictures = ?, facebookUrl = ?, 
                     linkedinUrl = ?, whatsappUrl = ?, status = ?, dateJoined = ?
                WHERE employerID = ?");
                $statement->bind_param("sssssssissssssssssssss", $companyName, $contactPersonName, $emailAddress, $phoneNumber, $$addressLineOne, $addressLineTwo, $addressLineThree,
                    $postcode, $city, $state, $numberOfEmployees, $industry, $aboutUs, $logo, $backgroundPicture, $officePictures, $facebookUrl, 
                    $linkedinUrl, $whatsappUrl, $status, $dateJoined, $employerID);
            }

            $this->uploadImages("logo");
            // uploadImages("backgroundPicture");
            // uploadImages("officePictures");

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
        $aboutUs = $this->model->getAboutUs();
        $logo = $this->model->getLogo();
        $backgroundPicture = $this->model->getBackgroundPicture();
        $officePictures = $this->model->getOfficePictures();
        $facebookUrl = $this->model->getFacebookUrl();
        $linkedinUrl = $this->model->getLinkedinUrl();
        $whatsappUrl = $this->model->getWhatsappUrl();
        $status = $this->model->getStatus();
        $dateJoined = $this->model->getDateJoined();

        $i=0;

        //db loading
        // $db_datas=[];
        // $result = $this->connection->query("SELECT B.origin, B.destination, C.airplane_id, C.name, A.departure_day, A.departure_time, A.arrival_time, B.time_taken_hour
        //                                     FROM flight_schedule A
        //                                     JOIN route B ON A.route_id = B.route_id
        //                                     JOIN airplane C ON A.airplane_id = C.airplane_id
        //                                     WHERE starting_date >= '2000-01-01'");
        // while (($row = $result->fetch_assoc()) == TRUE) {
        //     $db_datas[] = $row;
        // }

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
        }else if(!preg_match('/^[0-9]{9,10}+$/', $phoneNumber) || substr_count($phoneNumber, '-')>1){
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
        
        // if($logo != ""){
        //     $ext = strtolower(pathinfo($logo, PATHINFO_EXTENSION));
        //     if ($ext !== 'gif' && $ext !== 'png' && $ext !== 'jpg') {
        //         $datas[$i]['inputName'] = "logo";
        //         $datas[$i]['errorMessage'] = "File should only in .gif | .png | .jpg format";
        //         $i++;
        //     }
        // }

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

    private function uploadImages($inputFieldName){
        $target_dir = "/jobnexus/admin/assets/images/company_profile/";
        $target_file = $target_dir . basename($_FILES[$inputFieldName]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        // if(isset($_POST["submit"])) {
        //     $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        //     if($check !== false) {
        //         echo "File is an image - " . $check["mime"] . ".";
        //         $uploadOk = 1;
        //     } else {
        //         echo "File is not an image.";
        //         $uploadOk = 0;
        //     }
        // }

        // Check if file already exists
        // if (file_exists($target_file)) {
        //     echo "Sorry, file already exists.";
        //     $uploadOk = 0;
        // }

        // Check file size
        // if ($_FILES["fileToUpload"]["size"] > 500000) {
        //     echo "Sorry, your file is too large.";
        //     $uploadOk = 0;
        // }

        // Allow certain file formats
        // if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        //     echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        //     $uploadOk = 0;
        // }

        if (move_uploaded_file($_FILES[$inputFieldName]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES[$inputFieldName]["name"])). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
            die();
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
