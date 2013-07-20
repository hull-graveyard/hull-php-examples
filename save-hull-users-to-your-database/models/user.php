<?php

class User extends ActiveRecord\Model {
  static $validates_presence_of = array(
    array('name'),
    array('email')
  );

  static $validates_uniqueness_of = array(
    array('email')
  );

  static $validates_format_of = array(
    array('email', 'with' => '/^[^0-9][A-z0-9_]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_]+)*[.][A-z]{2,4}$/')
  );
}
