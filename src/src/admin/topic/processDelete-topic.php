<?php
require_once('../../db/dbhelper.php');
if(!empty($_POST)){
    if(isset($_POST['action'])){
        $action = $_POST['action'];

        switch($action){
            case'delete':
                if(isset($_POST['id'])){
                    $id= $_POST['id'];
                    $sql_topic_post = 'DELETE FROM posts WHERE topic_id ='.$id;
                    $sql ='DELETE from topics WHERE id ='.$id;
                    execute($sql_topic_post);
                    execute($sql);
                } 
            break;
        }
    }
    
}