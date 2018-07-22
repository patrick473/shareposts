<?php

class Posts extends Controller
{
    public function __construct()
    {
        if (!isset($_SESSION['user_id'])) {
            redirect('users/login');
        }
        $this->postModel = $this->model('Post');
        $this->userModel = $this->model('User');
    }
    public function index()
    {
        $posts = $this->postModel->getPosts();

        $data = [
            'posts' => $posts,
        ];
        $this->view('posts/index', $data);

    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'title_error' => '',
                'body_error' => '',
            ];
            //validate rules

            if (empty($data['title'])) {
                $data['title_error'] = 'please fill in a title.';
            }
            if (empty($data['body'])) {
                $data['body_error'] = 'please fill in a body.';
            }
            if (empty($data['title_error']) && empty($data['body_error'])) {
                //hash password

                if ($this->postModel->create($data)) {

                    redirect('posts');
                } else {
                    die('Post did not get created please try again');
                }

            } else {
                $this->view('posts/add', $data);
            }
        } else {
            $data = [
                'title' => '',
                'body' => '',
                'title_error' => '',
                'body_error' => '',
            ];
            $this->view('posts/add', $data);
        }
    }

    public function edit($id)
    {
        $post = $this->postModel->getPost($id);
        if ($_SESSION['user_id'] == $post->user_id) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data = [
                    'id' => $id,
                    'title' => trim($_POST['title']),
                    'body' => trim($_POST['body']),
                    'title_error' => '',
                    'body_error' => '',
                ];
                //validate rules

                if (empty($data['title'])) {
                    $data['title_error'] = 'please fill in a title.';
                }
                if (empty($data['body'])) {
                    $data['body_error'] = 'please fill in a body.';
                }
                if (empty($data['title_error']) && empty($data['body_error'])) {
                    //hash password

                    if ($this->postModel->edit($data)) {

                        redirect('posts');
                    } else {
                        die('Post did not get created please try again');
                    }

                } else {
                    $this->view('posts/edit', $data);
                }
            } else {
                $data = [
                    'id' => $id,
                    'title' => $post->title,
                    'body' => $post->body,
                    'title_error' => '',
                    'body_error' => '',
                ];
                $this->view('posts/edit', $data);
            }
        } else {
            die('Permission denied');
        }

    }
    public function delete($id){
        $post = $this->postModel->getPost($id);
        if ($_SESSION['user_id'] == $post->user_id) {
            if($this->postModel->delete($id)){
                redirect('posts');
            }
            else{
                die('post did not get deleted please try again');
            }
        }
        else{
            die('permission denied');
        }
    }
    public function show($id)
    {
        $post = $this->postModel->getPost($id);
        $user = $this->userModel->findUserByID($post->user_id);
        $data = [
            'post' => $post,
            'user' => $user,
        ];

        $this->view('posts/show', $data);
    }

}
