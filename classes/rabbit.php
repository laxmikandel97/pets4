<?php

class Rabbit extends Pet
{
    function talk()
    {
        echo $this->getName() . " is squeaking</br>";
    }

    function hop()
    {
        echo $this->getName() . " is Hopping</br>";
    }
}
