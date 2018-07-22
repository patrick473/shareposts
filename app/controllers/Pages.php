<?php

class Pages extends Controller{
    public function __construct(){
       $this->postModel = $this->model('Post');
    }
    public function index(){
        if(isset($_SESSION['user_id'])){
            redirect('posts');
        }
        $posts =$this->postModel->getPosts();
        $data = [
            'title' => 'SharePosts',
            'description' => 'Simple Social Network'
        ];
        
        $this->view('pages/index',$data);
    }
    public function about(){
        $data = [
            'title' => 'about shareposts',
            'description' => 'App to share posts with other users'
        ];
        $this->view('pages/about',$data);
    }
    }
