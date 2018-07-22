<?php

    class Post{
        private $db;

        public function __construct(){

            $this->db = new Database;
        }
        public function getPosts(){
            $this->db->query('SELECT *,posts.id as postID,posts.created_at,
            users.id as userID
             FROM posts
             inner join users
             on posts.user_id = users.id
             order by posts.created_at desc');

            return $this->db->resultSet();
        }
        public function getPost($id){
            $this->db->query('SELECT * from posts where id = :id');
            $this->db->bind(':id',$id);
            
            return $this->db->single();
        }
        public function create($data){
            $this->db->query('insert into posts (user_id,title,body) values(:user_id,:title,:body)');
            $this->db->bind(':user_id',$_SESSION['user_id']);
            $this->db->bind(':title',$data['title']);
            $this->db->bind(':body',$data['body']);
        
    
            if($this->db->execute()){
                return true;
            }
            else{
    
             return false;
            }
        }
        public function edit($data){
            $this->db->query('update posts set title=:title, body=:body where id = :id ');
            $this->db->bind(':id',$data['id']);
            $this->db->bind(':title',$data['title']);
            $this->db->bind(':body',$data['body']);
        
    
            if($this->db->execute()){
                return true;
            }
            else{
    
             return false;
            }
        }
        public function delete($data){
            $this->db->query('delete from posts where id = :id ');
            $this->db->bind(':id',$data['id']);
            if($this->db->execute()){
                return true;
            }
            else{
    
             return false;
            }
        }
    }