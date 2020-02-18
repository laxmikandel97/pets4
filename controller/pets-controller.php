<?php

class PetController
{
    private $_f3; //router

    public function __construct($f3)
    {
        $this->_f3 = $f3;
    }

    public function home()
    {
        echo "<h1>My Pets</h1>";
        echo "<a href='order'>Order a Pet</a>";

    }

    public function formOne()
    {
        $_SESSION=array();//clear the session
        if(isset($_POST['animal']))
        {
            $animal = $_POST['animal'];
            if(validAnimal($animal))
            {
                $this->_f3->set('animal', $animal);
                if (strtolower($animal) == "dog" ){
                    $pet1 = new Dog($animal);
                }
                elseif (strtolower($animal) == "cat"){
                    $pet1 = new Cat($animal);
                }
                else if(strtolower($animal)=="rabbit"){
                    $pet1 = new Rabbit($animal);

                }
                else {
                    $pet1 = new Pet("$animal");
                }
                $_SESSION['animal']=$animal;
                $_SESSION['pet1']= $pet1;
                $this->_f3->reroute('/order2');
            }
            else{
                $this->_f3->set("errors['animal']","Please enter an animal.");
            }
        }
        $view = new Template();
        echo $view->render('views/form1.html');
    }

    public function formTwo()
    {
        $name = $_POST['name'];
        $this->_f3->set('animalName', $name);

        if(isset($_POST['color']))
        {
            $color = $_POST['color'];
            if(validColor($color))
            {
                $_SESSION['pet1']->setColor("$color");
                $_SESSION['color']=$color;
                $name = $_POST['name'];
                echo "$name";
                $this->_f3->set('animalName', $name);
                $_SESSION['pet1']->setName("$name");
                $this->_f3->reroute('/results');
            }
            else{
                $this->_f3->set("errors['color']","Please enter an color.");
            }
        }

//    $_SESSION['animal'] = $_POST['animal'];
        $view = new Template();
        echo $view->render('views/form2.html');

    }

    public function summary()
    {
        $view = new Template();
        echo $view->render('views/results.html');

    }

}
