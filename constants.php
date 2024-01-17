<?php

//database credentials
const DB_HOSTNAME = 'localhost';
const DB_USERNAME = 'onlineshop';
const DB_PASSWORD = 'onlinesho';
const DB_DATABASE = 'onlineshop';   

//session info
const SESSIONID_LENGTH = 50;
const SESSIONID_VALIDITY_TIME_SECONDS = 60*60*24; //1 day in seconds

//security
const PASSWD_HASH_FUNC = 'sha256'; //php hash() function argument
const SQL_UNSAFE_CHARS = '-;"/'."'";

?>