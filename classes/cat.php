<?php

class Cat extends Pet
{
    function fetch()
    {
        echo "<p>" . $this->getName() . " is fetching.</p>";
    }

    function talk()
    {
        echo $this->getName() . " is meowing</br>";
    }
}
