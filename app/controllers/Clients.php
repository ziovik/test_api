<?php


class Clients  extends Controller
{
    public function __construct() {
        $this->clientModel = $this->model('Client');

    }

    public function index() {
        $clients = $this->clientModel->findAllClients();

        $data = [
            'clients' => $clients
        ];

        $this->view('clients/index', $data);
    }

    public function create() {
        if(!isLoggedIn()) {  // if its not in session. method isLoggedIn is in helpers/session_helper
            header("Location: " . URLROOT . "/posts"); // go back to posts/index
        }
        // assign keys to each from form to remove error
        $data = [
            'client_name' => '',
            'address' => '',
            'email' => '',
            'created_on' => '',
            'telephone' => '',
            'clientError' => '',
            'emailError' => '',
            'addressError' => '',
            'createdError' => '',
            'telephoneError' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST') {  // check is a client is sent
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);  // sanitize form data
//            filter_sanitize_string is how u want t sanitize so we want in string
            $data = [
                'user_id' => $_SESSION['user_id'],
                'client_name' => trim($_POST['client_name']),  // from form name= "client_name"
                'address' => trim($_POST['address']),  // from form name = "address"
                'email' => trim($_POST['email']),
                'created_on' => trim($_POST['created_on']),
                'telephone' => trim($_POST['telephone']),

                'clientError' => '',
                'emailError' => '',
                'addressError' => '',
                'createdError' => '',
                'telephoneError' => ''
            ];
            // test
//            var_dump($data['title']);

            if(empty($data['client_name'])) {  // check if client_name is empty
                $data['clientError'] = 'Client Name cannot be empty';  // if yes show error
            }

            if(empty($data['address'])) {
                $data['addressError'] = 'Address cannot be empty';
            }

            if (empty($data['clientError']) && empty($data['addressError'])) {  // if no error
                if ($this->clientModel->addClient($data)) { // addClient is a method in client model
                    header("Location: " . URLROOT . "/clients");  // if added then redirect
                } else {
                    die("Something went wrong, please try again!");
                }
            } else {
                $this->view('clients/create', $data);  // passing data to show if error or not if not then redirect
            }
        }

        $this->view('clients/create', $data); // after everything redirect to create and pass the data
    }

    public function update($id) {

        $client = $this->clientModel->findClientById($id);

        if(!isLoggedIn()) {
            header("Location: " . URLROOT . "/clients");
        } elseif($client->user_id != $_SESSION['user_id']){
            header("Location: " . URLROOT . "/clients");
        }

        $data = [
            'client' => $client,
            'client_name' => '',
            'address' => '',
            'email' => '',
            'created_on' => '',
            'telephone' => '',
            'clientError' => '',
            'emailError' => '',
            'addressError' => '',
            'createdError' => '',
            'telephoneError' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'client' => $client,
                'user_id' => $_SESSION['user_id'],
                'client_name' => trim($_POST['client_name']),  // from form name= "client_name"
                'address' => trim($_POST['address']),  // from form name = "address"
                'email' => trim($_POST['email']),
                'created_on' => trim($_POST['created_on']),
                'telephone' => trim($_POST['telephone']),
                'clientError' => '',
                'emailError' => '',
                'addressError' => '',
                'createdError' => '',
                'telephoneError' => ''
            ];

            if(empty($data['client_name'])) {
                $data['clientError'] = 'Client Name cannot be empty';
            }

            if(empty($data['address'])) {
                $data['addressError'] = 'Address cannot be empty';
            }

            if($data['client_name'] == $this->clientModel->findClientById($id)->client_name) {
                $data['clientError'] == 'At least change the Client Name!';
            }

            if($data['address'] == $this->addressModel->findClientById($id)->address) {
                $data['addressError'] == 'At least change the address!';
            }

            if (empty($data['clientError']) && empty($data['addressError'])) {
                if ($this->clientModel->updateClient($data)) {
                    header("Location: " . URLROOT . "/clients");
                } else {
                    die("Something went wrong, please try again!");
                }
            } else {
                $this->view('clients/update', $data);
            }
        }

        $this->view('clients/update', $data);
    }

    public function delete($id) {

        $client = $this->clientModel->findClientById($id);

        if(!isLoggedIn()) {
            header("Location: " . URLROOT . "/clients");
        } elseif($client->user_id != $_SESSION['user_id']){
            header("Location: " . URLROOT . "/clients");
        }

        $data = [
            'client' => $client,
            'client_name' => '',
            'address' => '',
            'email' => '',
            'created_on' => '',
            'telephone' => '',
            'clientError' => '',
            'emailError' => '',
            'addressError' => '',
            'createdError' => '',
            'telephoneError' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if($this->clientModel->deleteClient($id)) {
                header("Location: " . URLROOT . "/clients");
            } else {
                die('Something went wrong!');
            }
        }
    }
}