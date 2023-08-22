<?php

define("HOST", "localhost");
define("USER", "root");
define("PASSWORD", "");
define("DATABASE", "costs");

define("REGEX_NAME", "/^[a-zA-ZÀ-ÿ\-\s]+$/");
define("REGEX_PHONE", "/^[0-9]{10}$/");
define("REGEX_EMAIL", "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-zA-Z]{2,4}$/");
define("REGEX_PASSWORD", "/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,}$/");
define("REGEX_DATE", "/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/");
define("REGEX_AMOUNT", "/^[0-9]{1,4}\.[0-9]{2}$/");
define("REGEX_AMOUNT2", "/^[0-9]{1,4}$/");
define("REGEX_MOTIVE", "/^[a-zA-ZÀ-ÿ\-\s]+$/");