<?php

class doc {
    public static $TABLE = 'doc';
    public static $modifiable = ['name', 'datecreation'];
    protected $id;
    protected $ref;
    protected $name;
    protected $datecreation;
    protected $lastverion;
    protected $versions = [];
    protected $mustupdate = false;

    function __construct($ref) {
        global $db;
        if (!empty($docs = $db->select(self::$TABLE, '*', ['ref' => $ref]))) {
            $this->ref = $ref;
            $lastdoc = new stdClass();
            while ($doc = $docs->fetch()) {
                $this->versions[] = $doc->version;
                $lastdoc = $doc;
            }
            $this->id = $lastdoc->id;
            $this->name = $lastdoc->name;
            $this->datecreation = $lastdoc->datecreation;
            $this->lastverion = $lastdoc->version;
        } else {
            throw new Exception('This document does not exist !');
        }
    }

    function __get($name) {
        if ($name == 'file') {
            return $this->get_file();
        } else if (property_exists($this, $name)) {
            return $this->{$name};
        } else {
            throw new Exception('This property does not exist !');
        }
    }

    function __set($name, $value) {
        if (in_array($name, self::$modifiable)) {
            $this->{$name} = $value;
            $this->mustupdate = true;
        }
    }

    public function __destruct() {
        if ($this->mustupdate) {
            global $db;
            $doc = ['ref' => $this->ref, 'name' => $this->name, 'datecreation' => $this->datecreation, 'version' => $this->lastverion + 1];
            $db->create(self::$TABLE, $doc);
        }
    }

    private function get_file() {
        global $db;
        $doc = $db->query("select file from " . self::$TABLE . " where ref = :ref AND file is not null order by id desc", ['ref' => $this->ref])->fetch();
        return $doc->file;
    }

    public static function get_all() {
        global $db;
        $docs = $db->select(self::$TABLE, 'distinct ref as uniqueref', null, 'uniqueref desc');
        $return = [];
        while ($doc = $docs->fetch()) {
            $return[] = new self($doc->uniqueref);
        }
        return $return;
    }
}