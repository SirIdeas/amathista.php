<?php

return array(
  
  "init" => array(),

  "files" => array(
    "AmCredentials.class"
    "AmCredentialsHandler.class"
  ),

  "requires" => array(
    "exts/am_session/",
  ),

  "mergeFunctions" => array(
    "credentials" => "merge_r_if_are_array_and_first_not_false",
  )

);