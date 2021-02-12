<?php
class Posts extends Controller {
    public function __construct() {
        $this->postModel = $this->model('Post');
    }

    public function index() {
        $posts = $this->postModel->findAllPosts();

        $data = [
            'posts' => $posts
        ];

        $this->view('posts/index', $data);
    }

    public function create() {
        if(!isLoggedIn()) {  // if its not in session. method isLoggedIn is in helpers/session_helper
            header("Location: " . URLROOT . "/posts"); // go back to posts/index
        }
        // assign keys to each from form to remove error
        $data = [
            'title' => '',
            'body' => '',
            'titleError' => '',
            'bodyError' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST') {  // check is a post is sent
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);  // sanitize form data
//            filter_sanitize_string is how u want t sanitize so we want in string
            $data = [
                'user_id' => $_SESSION['user_id'],
                'title' => trim($_POST['title']),  // from form name= "title"
                'body' => trim($_POST['body']),  // from form name = "body"
                'titleError' => '',
                'bodyError' => ''
            ];
            // test
//            var_dump($data['title']);

            if(empty($data['title'])) {  // check if title is empty
                $data['titleError'] = 'The title of a post cannot be empty';  // if yes show error
            }

            if(empty($data['body'])) {
                $data['bodyError'] = 'The body of a post cannot be empty';
            }

            if (empty($data['titleError']) && empty($data['bodyError'])) {  // if no error
                if ($this->postModel->addPost($data)) { // addPost is a method in post model
                    header("Location: " . URLROOT . "/posts");  // if added then redirect
                } else {
                    die("Something went wrong, please try again!");
                }
            } else {
                $this->view('posts/create', $data);  // passing data to show if error or not if not then redirect
            }
        }

        $this->view('posts/create', $data); // after everything redirect to create and pass the data
    }

    public function update($id) {

        $post = $this->postModel->findPostById($id);

        if(!isLoggedIn()) {
            header("Location: " . URLROOT . "/posts");
        } elseif($post->user_id != $_SESSION['user_id']){
            header("Location: " . URLROOT . "/posts");
        }

        $data = [
            'post' => $post,
            'title' => '',
            'body' => '',
            'titleError' => '',
            'bodyError' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'post' => $post,
                'user_id' => $_SESSION['user_id'],
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'titleError' => '',
                'bodyError' => ''
            ];

            if(empty($data['title'])) {
                $data['titleError'] = 'The title of a post cannot be empty';
            }

            if(empty($data['body'])) {
                $data['bodyError'] = 'The body of a post cannot be empty';
            }

            if($data['title'] == $this->postModel->findPostById($id)->title) {
                $data['titleError'] == 'At least change the title!';
            }

            if($data['body'] == $this->postModel->findPostById($id)->body) {
                $data['bodyError'] == 'At least change the body!';
            }

            if (empty($data['titleError']) && empty($data['bodyError'])) {
                if ($this->postModel->updatePost($data)) {
                    header("Location: " . URLROOT . "/posts");
                } else {
                    die("Something went wrong, please try again!");
                }
            } else {
                $this->view('posts/update', $data);
            }
        }

        $this->view('posts/update', $data);
    }

    public function delete($id) {

        $post = $this->postModel->findPostById($id);

        if(!isLoggedIn()) {
            header("Location: " . URLROOT . "/posts");
        } elseif($post->user_id != $_SESSION['user_id']){
            header("Location: " . URLROOT . "/posts");
        }

        $data = [
            'post' => $post,
            'title' => '',
            'body' => '',
            'titleError' => '',
            'bodyError' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if($this->postModel->deletePost($id)) {
                    header("Location: " . URLROOT . "/posts");
            } else {
               die('Something went wrong!');
            }
        }
    }
}

