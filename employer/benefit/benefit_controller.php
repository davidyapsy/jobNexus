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

class BenefitModel
{
    private String $benefitID;
    private String $employerID;
    private String $benefitTitle;
    private String $benefitDescription;
    private String $icon;
    private int $isDeleted;

    public function getBenefitID(): String {
        return $this->benefitID;
    }
    
    public function setBenefitID(String $benefitID): BenefitModel {
        $this->benefitID = $benefitID;
        return $this;
    }
    
    public function getEmployerID(): String {
        return $this->employerID;
    }
    
    public function setEmployerID(String $employerID): BenefitModel {
        $this->employerID = $employerID;
        return $this;
    }
    
    public function getBenefitTitle(): String {
        return $this->benefitTitle;
    }
    
    public function setBenefitTitle(String $benefitTitle): BenefitModel {
        $this->benefitTitle = $benefitTitle;
        return $this;
    }
    
    public function getBenefitDescription(): String {
        return $this->benefitDescription;
    }
    
    public function setBenefitDescription(String $benefitDescription): BenefitModel {
        $this->benefitDescription = $benefitDescription;
        return $this;
    }
    
    public function getIcon(): String {
        return $this->icon;
    }
    
    public function setIcon(String $icon): BenefitModel {
        $this->icon = $icon;
        return $this;
    }
    
    public function getIsDeleted(): int {
        return $this->isDeleted;
    }
    
    public function setIsDeleted(int $isDeleted): BenefitModel {
        $this->isDeleted = $isDeleted;
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

class BenefitOop
{
    private ConnectionString $connectionString;
    private BenefitModel $model;
    private mysqli $connection;

    private $page;

    public function getPage()
    {
        return $this->page;
    }

    public function setPage($page=NULL): BenefitOop
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
        $this->model = new BenefitModel();
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
        $benefitID = base64_decode(filter_input(INPUT_POST, "benefitID", FILTER_SANITIZE_STRING));
        $employerID = base64_decode($_SESSION['employerID']);
        $benefitTitle = filter_input(INPUT_POST, "benefitTitle", FILTER_SANITIZE_STRING);
        $benefitDescription = filter_input(INPUT_POST, "benefitDescription", FILTER_SANITIZE_STRING);
        $icon = filter_input(INPUT_POST, "icon", FILTER_SANITIZE_STRING);
        $isDeleted = filter_input(INPUT_POST, "isDeleted", FILTER_SANITIZE_NUMBER_INT);
        $page = filter_input(INPUT_POST, "page", FILTER_SANITIZE_NUMBER_INT);

        
        if(filter_input(INPUT_POST, "mode", FILTER_SANITIZE_STRING) == "create"){
            $this->model->setEmployerID($employerID);
            $this->model->setBenefitTitle($benefitTitle);
            $this->model->setBenefitDescription($benefitDescription);
            $this->model->setIcon($icon);
        }else if(filter_input(INPUT_POST, "mode", FILTER_SANITIZE_STRING) == "delete"){
            $this->model->setBenefitID($benefitID);
        }else if(filter_input(INPUT_POST, "mode", FILTER_SANITIZE_STRING) == "update"){
            $this->model->setBenefitID($benefitID);
            $this->model->setEmployerID($employerID);
            $this->model->setBenefitTitle($benefitTitle);
            $this->model->setBenefitDescription($benefitDescription);
            $this->model->setIcon($icon);
        }else if(filter_input(INPUT_POST, "mode", FILTER_SANITIZE_STRING) == "check_validation"){
            $this->model->setBenefitTitle($benefitTitle);
        }else if(filter_input(INPUT_POST, "mode", FILTER_SANITIZE_STRING) == "search"){
            $this->setPage($page);
            $this->model->setEmployerID($employerID);
            $this->model->setBenefitTitle($benefitTitle);
            $this->model->setBenefitDescription($benefitDescription);
        }       
    }

    /**
     * @throws Exception
     */
    function create()
    {
        $this->connection->autocommit(false);

        $employerID = $this->model->getEmployerID();
        $benefitTitle = $this->model->getBenefitTitle();
        $benefitDescription = $this->model->getBenefitDescription();
        $icon = $this->model->getIcon();
        $isDeleted = 0;

        //get number of records
        $total_data=0;
        $stat = $this->connection->query("SELECT count(*) as totalRecord
                                                FROM benefit");
        while (($row = $stat->fetch_assoc()) == TRUE) {
            $total_data = $row['totalRecord'];
        }
        $benefitID = "B".sprintf('%010d', $total_data+1);

        //insert into db
        if (strlen($benefitTitle) > 0 ) {
            $statement = $this->connection->prepare("INSERT INTO benefit VALUES (?, ?, ?, ?, ?, ?)");
            $statement->bind_param("sssssi", $benefitID, $employerID, $benefitTitle, $benefitDescription, $icon, $isDeleted);
            
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

        // table data !
        $employerID = $this->model->getEmployerID();
        $benefitTitle = $this->model->getBenefitTitle();
        $benefitDescription = $this->model->getBenefitDescription();

        $sql = "SELECT benefitID, benefitTitle, benefitDescription, icon
        FROM benefit
        WHERE employerID = '$employerID' AND isDeleted=0 ";

        $filter_options ="";
        if($benefitTitle!=""){
            $filter_options.=" AND benefitTitle LIKE '%$benefitTitle%'";
        }
        if($benefitDescription!=""){
            $filter_options.=" AND benefitDescription LIKE '%$benefitDescription%'";
        }
        $filter_options.=" ORDER BY benefitID";
        $sql.=$filter_options;

        $total_data=0;
        $statement = $this->connection->query("SELECT count(*) as totalRecord
                                                FROM benefit
                                                WHERE employerID = '$employerID' AND isDeleted=0 ". $filter_options);
                                                
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

        $benefitID = $this->model->getBenefitID();
        $employerID = $this->model->getEmployerID();
        $benefitTitle = $this->model->getBenefitTitle();
        $benefitDescription = $this->model->getBenefitDescription();
        $icon = $this->model->getIcon();

        //update db
        if (strlen($benefitTitle) > 0 ) {
            $statement = $this->connection->prepare("UPDATE benefit
                                                     SET benefitTitle = ?, benefitDescription = ?, icon = ?
                                                     WHERE benefitID = ? AND employerID = ?");
            $statement->bind_param("sssss", $benefitTitle, $benefitDescription, $icon, $benefitID, $employerID);
            
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

        $benefitID = $this->model->getBenefitID();

        if (strlen($benefitID) > 0) {
            $statement = $this->connection->prepare("UPDATE benefit SET isDeleted = 1
                                                        WHERE benefitID = ? ");
            $statement->bind_param("s", $benefitID);
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

        $benefitTitle = $this->model->getBenefitTitle();
        $i=0;
        
        //null checking
        if($benefitTitle==""){
            $datas[$i]['inputName']="benefitTitle";
            $datas[$i]['errorMessage']="Benefit Title is required";
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

$benefitOop = new BenefitOop();
try {
    switch ($mode) {
        case  "create":
            $benefitOop->create();
            break;
        case  "search":
            $benefitOop->search();
            break;
        case  "update":
            $benefitOop->update();
            break;
        case  "delete":
            $benefitOop->delete();
            break;
        case "check_validation":
            $benefitOop->check_validation();
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
