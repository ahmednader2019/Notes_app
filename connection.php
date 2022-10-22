<?php
class connection
{
            public  $pdo ;
           
            public function __construct()
            {
                $this->pdo = new PDO('mysql:server=localhost;dbname=notes','root','');
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            } 
            public function getNotes()
            {
                $statement = $this->pdo->prepare("SELECT *FROM notes ORDER BY create_date DESC");
                $statement->execute();
                return $statement->fetchAll(PDO::FETCH_ASSOC);
            }
            public function addNote()
            {
                if(isset($_POST['title'])){
                    $title = $_POST['title'] ;
                }
                if(isset($_POST['description'])){
                    $description = $_POST['description'];
                }
                $date = date('Y-m-d H:i:s');

                if($title && $description){
                    $statement = $this->pdo->prepare("INSERT INTO notes (`title` , `description`,`create_date`) VALUES ('$title','$description','$date')");
                    return $statement->execute(); 
                    echo "The Note added successfully....!";
                }
                else{
                               echo "Please , Fill The informations ";
                        }   
            }
            public function getNoteById($id)
            {
               $statement = $this->pdo->prepare("SELECT *FROM notes WHERE id = :id");
               $statement->bindvalue('id',$id);
               $statement->execute();
               return $statement->fetch(PDO::FETCH_ASSOC);
            }
            public function updateNote($id, $note)
            {
                $statement = $this->pdo->prepare("UPDATE notes SET title = :title, description = :description WHERE id = :id");
                $statement->bindValue('id', $id);
                $statement->bindValue('title', $note['title']);
                $statement->bindValue('description', $note['description']);
                return $statement->execute();
            }

            public function removeNote($id)
            {
                $statement = $this->pdo->prepare("DELETE FROM notes WHERE id = :id");
                $statement->bindvalue('id',$id);
                return $statement->execute();
            }
            public function removeAllNotes()
           {
               $statement = $this->pdo->prepare("DELETE  FROM notes ");
               return $statement->execute();
          }

}

return  new  connection();