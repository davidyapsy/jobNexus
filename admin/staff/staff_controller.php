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

class StaffModel
{
    private int $staffId;
    private String $staffName;
    private String $staffPassword;
    private String $phoneNumber;
    private String $emailAddress;
    private String $status;
    private String $position;
    private int $isDeleted;

    public function getStaffId(): int
    {
        return $this->staffId;
    }

    public function setStaffId(int $staffId): StaffModel
    {
        $this->staffId = $staffId;
        return $this;
    }

    public function getStaffName(): String
    {
        return $this->staffName;
    }

    public function setStaffName(String $staffName): StaffModel
    {
        $this->staffName = $staffName;
        return $this;
    }

    public function getStaffPassword(): String
    {
        return $this->staffPassword;
    }

    public function setStaffPassword(String $staffPassword): StaffModel
    {
        $this->staffPassword = $staffPassword;
        return $this;
    }

    public function getPhoneNumber(): String
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(String $phoneNumber): StaffModel
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

    public function getEmailAddress(): String
    {
        return $this->emailAddress;
    }

    public function setEmailAddress(String $emailAddress): StaffModel
    {
        $this->emailAddress = $emailAddress;
        return $this;
    }

    public function getStatus(): String
    {
        return $this->status;
    }

    public function setStatus(String $status): StaffModel
    {
        $this->status = $status;
        return $this;
    }

    public function getPosition(): String
    {
        return $this->position;
    }

    public function setPosition(String $position): StaffModel
    {
        $this->position= $position;
        return $this;
    }

    public function getIsDeleted(): int
    {
        return $this->isDeleted;
    }

    public function setIsDeleted(String $isDeleted): StaffModel
    {
        $this->isDeleted= $isDeleted;
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

class StaffOop
{
    private ConnectionString $connectionString;
    private StaffModel $model;
    private mysqli $connection;

    private $page;
    private $confirmPassword;

    public function getPage()
    {
        return $this->page;
    }

    public function setPage($page=NULL): StaffOop
    {
        $this->page = $page;
        return $this;
    }

    public function getConfirmPassword()
    {
        return $this->confirmPassword;
    }

    public function setConfirmPassword($confirmPassword=NULL): StaffOop
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
        $this->model = new StaffModel();
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
        $staffId =  base64_decode(filter_input(INPUT_POST, "staffId", FILTER_SANITIZE_STRING));
        $staffName = filter_input(INPUT_POST, "staffName", FILTER_SANITIZE_STRING);
        $staffPassword = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
        $phoneNumber = filter_input(INPUT_POST, "phoneNumber", FILTER_SANITIZE_STRING);
        $emailAddress = filter_input(INPUT_POST, "emailAddress", FILTER_SANITIZE_STRING);
        $status = filter_input(INPUT_POST, "status", FILTER_SANITIZE_STRING);
        $position = filter_input(INPUT_POST, "position", FILTER_SANITIZE_STRING);

        $confirmPassword = filter_input(INPUT_POST, "confirmPassword", FILTER_SANITIZE_STRING);

        $page = filter_input(INPUT_POST, "page", FILTER_SANITIZE_NUMBER_INT);
        $type = filter_input(INPUT_POST, "type", FILTER_SANITIZE_STRING);

        
        if( filter_input(INPUT_POST, "mode", FILTER_SANITIZE_STRING) == "create"){
            $this->model->setStaffName($staffName);
            $this->model->setStaffPassword($staffPassword);
            $this->model->setPhoneNumber($phoneNumber);
            $this->model->setEmailAddress($emailAddress);
            $this->model->setStatus($status);
            $this->model->setPosition($position);
            $this->setConfirmPassword($confirmPassword);

        }else if(filter_input(INPUT_POST, "mode", FILTER_SANITIZE_STRING) == "delete"){
            if (is_numeric($staffId)) {
                if ($staffId > 0) {
                    $this->model->setStaffId($staffId);
                }
            }

        }else if(filter_input(INPUT_POST, "mode", FILTER_SANITIZE_STRING) == "update"){
            if (is_numeric($staffId)) {
                if ($staffId > 0) {
                    $this->model->setStaffId($staffId);
                }
            }
            $this->model->setStaffName($staffName);
            $this->model->setStaffPassword($staffPassword);
            $this->model->setPhoneNumber($phoneNumber);
            $this->model->setEmailAddress($emailAddress);
            $this->model->setStatus($status);
            $this->model->setPosition($position);

        }else if(filter_input(INPUT_POST, "mode", FILTER_SANITIZE_STRING) == "check_validation"){
            $this->model->setStaffName($staffName);
            $this->model->setStaffPassword($staffPassword);
            $this->model->setPhoneNumber($phoneNumber);
            $this->model->setEmailAddress($emailAddress);
            $this->model->setStatus($status);
            $this->model->setPosition($position);
            $this->setConfirmPassword($confirmPassword);

        }else if(filter_input(INPUT_POST, "mode", FILTER_SANITIZE_STRING) == "search"){
            $this->setPage($page);
            $this->model->setStaffName($staffName);
            $this->model->setPhoneNumber($phoneNumber);
            $this->model->setEmailAddress($emailAddress);
            $this->model->setStatus($status);
            $this->model->setPosition($position);

        }       
    }

    /**
     * @throws Exception
     */
    function create()
    {
        $this->connection->autocommit(false);

        $name = $this->model->getStaffName();
        $staffPassword = md5($this->model->getStaffPassword());
        $phoneNumber = $this->model->getPhoneNumber();
        $emailAddress = $this->model->getEmailAddress();
        $status = $this->model->getStatus();
        $position = $this->model->getPosition();
        $isDeleted = 0;

        if (strlen($name) > 0 &&  strlen($staffPassword) > 0 &&  strlen($phoneNumber) > 0 &&  strlen($emailAddress) > 0 &&  strlen($status) > 0 &&  strlen($position) > 0) {
            $statement = $this->connection->prepare("INSERT INTO staff VALUES (null, ?, ?, ?, ?, ?, ?, ?)");
            $statement->bind_param("ssssssi", $name, $staffPassword, $phoneNumber, $emailAddress, $status, $position, $isDeleted);
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
        $name = $this->model->getStaffName();
        $phoneNumber = $this->model->getPhoneNumber();
        $emailAddress = $this->model->getEmailAddress();
        $status = $this->model->getStatus();
        $position = $this->model->getPosition();

        $sql = "SELECT staff_id, name, phone_number, email_address, status, position
        FROM staff
        WHERE is_deleted = 0";

        if($name!=""){
            $sql.=" AND UPPER(name) LIKE '$name%'";
        }
        if($phoneNumber!=""){
            $sql.=" AND phone_number LIKE '$phoneNumber%'";
        }
        if($emailAddress!=""){
            $sql.=" AND email_address LIKE '$emailAddress%'";
        }
        if($status!=""){
            $sql.=" AND status = '$status'";
        }
        if($position!=""){
            $sql.=" AND position = '$position'";
        }
        $sql.=" ORDER BY staff_id ASC";

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

        $staffId = $this->model->getStaffId();
        $name = $this->model->getStaffName();
        $staffPassword = $this->model->getStaffPassword();
        $phoneNumber = $this->model->getPhoneNumber();
        $emailAddress = $this->model->getEmailAddress();
        $status = $this->model->getStatus();
        $position = $this->model->getPosition();

        if (strlen($name) > 0 &&  strlen($phoneNumber) > 0 &&  strlen($emailAddress) > 0 &&  strlen($status) > 0 &&  strlen($position) > 0) {
            if($staffPassword!=""){
                $staffPassword = md5($staffPassword);
                $statement = $this->connection->prepare("UPDATE staff 
                SET name = ?, password = ?, phone_number = ?, email_address = ?, status = ?, position = ?
                WHERE staff_id = ?");
                $statement->bind_param("ssssssi", $name, $staffPassword, $phoneNumber, $emailAddress, $status, $position, $staffId);
            }else{
                $statement = $this->connection->prepare("UPDATE staff 
                SET name = ?, phone_number = ?, email_address = ?, status = ?, position = ?
                WHERE staff_id = ?");
                $statement->bind_param("sssssi", $name, $phoneNumber, $emailAddress, $status, $position, $staffId);
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

        $staffId = $this->model->getStaffId();

        if ($staffId > 0) {

            $statement = $this->connection->prepare("UPDATE staff SET is_deleted = 1
                WHERE staff_id = ? ");
            // s -> string, i -> integer , d -  double , b - blob
            $statement->bind_param("i", $staffId);
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

        $name = $this->model->getStaffName();
        $staffPassword = $this->model->getStaffPassword();
        $phoneNumber = $this->model->getPhoneNumber();
        $emailAddress = $this->model->getEmailAddress();
        $status = $this->model->getStatus();
        $position = $this->model->getPosition();
        $confirmPassword = $this->getConfirmPassword();
        $type = filter_input(INPUT_POST, "type", FILTER_SANITIZE_STRING);
        $error=0;


        if($name==""){
            $datas[$error]['inputName']="staffName";
            $datas[$error]['errorMessage']="Staff Name is required";
            $error++;
        }

        if($type=="add"){
            if($staffPassword==""){
                $datas[$error]['inputName']="password";
                $datas[$error]['errorMessage']="Password is required";
                $error++;
            }else if(strlen($staffPassword) < 8){
                $datas[$error]['inputName']="password";
                $datas[$error]['errorMessage']="At least 8 characters in length";
                $error++;
            }
            
            if($confirmPassword==""){
                $datas[$error]['inputName']="confirmPassword";
                $datas[$error]['errorMessage']="Confirm Password is required";
                $error++;
            }
        }

        if($staffPassword!=$confirmPassword){
            $datas[$error]['inputName']="password";
            $datas[$error]['errorMessage']="Password does not match with Confirm Password";
            $error++;
            $datas[$error]['inputName']="confirmPassword";
            $datas[$error]['errorMessage']="Password does not match with Confirm Password";
            $error++;
        }

        if($phoneNumber==""){
            $datas[$error]['inputName']="phoneNumber";
            $datas[$error]['errorMessage']="Phone Number is required";
            $error++;
        }else if (preg_match("/[a-z]/i", $phoneNumber)){
            $datas[$error]['inputName']="phoneNumber";
            $datas[$error]['errorMessage']="Phone number should not contains letters";
            $error++;
        }else if(strlen($phoneNumber)<10){
            $datas[$error]['inputName']="phoneNumber";
            $datas[$error]['errorMessage']="At least 10 characters in length";
            $error++;
        }
        
        if($emailAddress==""){
            $datas[$error]['inputName']="emailAddress";
            $datas[$error]['errorMessage']="Email address is required";
            $error++;
        }else if(!filter_var($emailAddress, FILTER_VALIDATE_EMAIL)){
            $datas[$error]['inputName']="emailAddress";
            $datas[$error]['errorMessage']="Invalid email format";
            $error++;        
        }else if($type == "add"){
            $result = $this->connection->query("SELECT phone_number, email_address FROM staff ORDER BY staff_id ASC ");
            while (($row = $result->fetch_assoc()) == TRUE) {
                if($emailAddress == $row['email_address']){
                    $datas[$error]['inputName']="emailAddress";
                    $datas[$error]['errorMessage']="Email address has been used";
                    $error++; 
                }
                if($phoneNumber == $row['phone_number']){
                    $datas[$error]['inputName']="phoneNumber";
                    $datas[$error]['errorMessage']="Phone number has been used";
                    $error++; 
                }
            }
        }

        if($status==""){
            $datas[$error]['inputName']="status";
            $datas[$error]['errorMessage']="Status is required";
            $error++;
        }
        if($position==""){
            $datas[$error]['inputName']="position";
            $datas[$error]['errorMessage']="Position is required";
            $error++;
        }


        if($error>0){
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

$staffOop = new StaffOop();
try {
    switch ($mode) {
        case  "create":
            $staffOop->create();
            break;
        case  "read":
            $staffOop->read();
            break;
        case  "search":
            $staffOop->search();
            break;
        case  "update":
            $staffOop->update();
            break;
        case  "delete":
            $staffOop->delete();
            break;
        case "check_validation":
            $staffOop->check_validation();
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
