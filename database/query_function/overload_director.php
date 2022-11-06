<?php
trait overload
{
    function __call($name, $arguments)
    {
        // if ($name == 'select')
        //     switch (count($arguments)) {
        //         case 2:
        //             return $this->select_no_condition($arguments[0], $arguments[1]);
        //         case 3:
        //             return $this->select_with_condition($arguments[0], $arguments[1], $arguments[2]);
        //         default:
        //             die('select function unvalid');
        //     }

        // else if ($name == 'update')
        //     switch (count($arguments)) {
        //         case 2:
        //             $this->update_no_condition($arguments[0], $arguments[1]);
        //             break;
        //         case 3:
        //             $this->update_with_condition($arguments[0], $arguments[1], $arguments[2]);
        //             break;
        //         default:

        //             die('update function unvalid');
        //     }
        // if ($name == 'join')
        //     switch (count($arguments)) {
        //         case 3:
        //             return $this->join_no_condition($arguments[0], $arguments[1], $arguments[2]);
        //             break;
        //         case 4:
        //             return $this->join_with_condition($arguments[0], $arguments[1], $arguments[2], $arguments[3]);
        //             break;
        //         default:
        //             die('join function unvalid');
        //     }
    }
}