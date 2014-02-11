<?php
require_once("PlexWatchWatched.php");

class PlexWatchWatchedIterator implements Iterator {
    public function __construct($result) {
        $this->_result = $result;
        $this->next();
        $this->_counter = 0;
    }

    public function rewind() {
        $this->_counter = 0;
        $this->_result->reset();
    }

    public function current() {
        return $this->_current;
    }

    public function key() {
        return $this->_counter;
    }

    public function next() {
        $res = $this->_result->fetchArray(SQLITE3_ASSOC);
        if ($res) {
            $this->_current = new PlexWatchWatched($res);
            $this->_counter += 1;
        } else {
            $this->_current = null;
        }
    }

    public function valid() {
        return $this->_current !== null;
    }

    private $_counter;
    private $_result;
    private $_current;
}

?>