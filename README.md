# OSMVC

## About OSMVC

osmvc is a php boilerplate using the mvc pattern.

it contains:

- easier database connections
- prebuilt url handler
- base controller class

## how to use OSMVC

you can use osmvc as a quickstart to your php application.

## setup

### mysql database
this boilerplate needs a database to function correctly.

only mysql is tested.

### config
in the config folder you need to change these variables to what is needed for your setup.
- db host
- db user
- db name
- db pass
- url root
- site name

### Creating a controller

additional controllers need to go in the controllers folder in app.
Within a controller are multiple functions that show a view.

the way the routing in this boilerplate works is as following:
```
rooturl/controller/function/parameters
```
a controller is created as such:

for example the controller "Pages"
```php
<?php

// a controller always needs to extend the Controller class
class Pages extends Controller{
    // within the __construct function you can call models 
    //that are necessary in the controller
    public function __construct(){

       $this->postModel = $this->model('Post');
    }


    //You can have multiple functions that set a view like this
    //route : root/Pages/index
    public function index(){
        //within a function you can call a method from a model defined in construct
        $posts =$this->postModel->getPosts();

        $data = [
            'title' => 'welcome',
            'posts' => $posts
        ];
        //the view and data is set as an variable of the object.
        //the core library takes care of actually displaying the view to the user
        $this->view('pages/index',$data);
    }
   
    }


```

### Creating a model
the model objects belong in the folder models in the app folder. a model class represents a table in the database. with the model you can create a query that collects,stores or deletes data in the database.

```php
<?php

    class Post{
        private $db;

        public function __construct(){
            // a instance of the database library needs to be created so calls can be made
            $this->db = new Database;
        }

        public function getPosts(){
            //preparing a sql query
            $this->db->query('SELECT * FROM posts');
            // executing the query and returning the result
            return $this->db->resultSet();
        }
    }
```

### views

#### creating a view

```php
// header and footer need to always be imported
<?php require APPROOT . '/views/includes/header.php'; ?>
// data that is sent from the controller can be accessed using the $data['param'] method

<h1><?php echo $data['title']?></h1>
<ul>
    <?php foreach($data['posts'] as $post) : ?>
    <li>
        <?php echo $post->title; ?>
    </li>
    <?php endforeach; ?>
</ul>

<?php require APPROOT . '/views/includes/footer.php'; ?>
```
#### linking css/js and other files 

You can import css and js files from the public folder .
css files are to be imported in header.php and js files in footer.php.

these files are imported using the following syntax.
```php
//URLROOT links to the public directory
<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/style.css">

<script src="<?php echo URLROOT; ?>/js/main.js"></script>
```

### Libraries
in this section the functions that can be called from the libraries are explained.


#### Controller

##### model
require a model so it can be used.

##### view
require a view so it can be shown.

#### Database

##### query($sql)
prepares a sql statement, uses a sql query as parameter.

##### bind($param,$value, $type)
Binds a value to a corresponding named or question mark placeholder in the SQL statement that was used to prepare the statement.

$param is the :param or an integer when it is a question mark.

##### execute
executes the prepared statement, does not return anything.

##### resultSet
executes the prepared statement, use if an array of objects is expected.

##### single
executes the prepared statement, use if a single object is expected.

##### rowCount
finds the amount of rows in the table.
#### Core

This handles routing and calls the correct controller you do not have to touch this.