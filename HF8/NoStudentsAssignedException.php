<?php
class NoStudentsAssignedException extends Exception {
    public function __construct($message = "You cannot delete the subject because it is assigned to a student.")
    {
        parent::__construct($message);
    }
}