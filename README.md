# Moodle Plugin Template

**ONLY THE FILES INSIDE OF /source ARE RELEVANT FOR YOU.**  
Everything else is just for CI stuff or for setting coding standards inside of your IDE. You can safely ignore them. If you'd like to know what they are used for, ask #t-infrastructure.

## Prerequisites 

1. Install [PhpStorm](https://www.jetbrains.com/phpstorm/download/#section=windows)
1. Clone this template

## Code style
To make sure that we all share a common code style, **make sure** to go to Settings -> Editor -> Code Style -> PHP, next to Scheme click on the menu, select "Import Scheme" -> "IntelliJ IDEA code style XML", and import the file "style.xml" inside this repository.

If you want to make sure that your files adhere to the code style, just press ctrl + alt + L - PhpStorm will auto-format your code.

## How to use the template?

The following steps should get you up and running with this module template code.

For the sake of this tutorial, it is assumed that you have a shell (or cmd on Windows) in the directory of this cloned repository. In all following command lines, it is assumed that you are not in any subdirectory. If `/` is used leading a path, it is assumed that this means the directory of this cloned repository and not your systems root directory. 

* Clone the repository and read this file

* Pick a name for your module (e.g. "newname").

  **The module name MUST be lower case and can't contain underscores.**

 * Keep in mind Moodle does not like numbers or special characters like `.` or `,` in names or paths. Name your plugin accordingly.

* Edit all the files in this directory and its subdirectories and change
  all the instances of the string "spsupervisorapplication" to your module name
  (eg "newname"). 

  On a Windows system, you can use the following PowerShell commands. Use the command `cd` to change into the directory of your code.  
  `$files = Get-ChildItem . -recurse -include *.* ; foreach ($file in $files) { (Get-Content $file.PSPath) | ForEach-Object { $_ -replace "spsupervisorapplication", "newname" } | Set-Content $file.PSPath }`  

  Replace "newname" in the commands above with your module name.

* Rename the file `/source/lang/en/spsupervisorapplication.php` to lang/en/newname.php
  where "newname" is the name of your module

* Rename all files in `/source/backup/moodle2/` folder by replacing "spsupervisorapplication" with
  the name of your module

  On a Windows system, you can use the following PowerShell command to perfrom this and the previous step:  
  `$files = Get-ChildItem . -recurse -include *.* | Where-Object {$_.Name -like "*spsupervisorapplication*"}; foreach ($file in $files) { $newname = ([String]$file).Replace("spsupervisorapplication", "newname"); Rename-Item -Path $file $newname }`

* Version your plugin accordingly. In the file `version.php`, replace the value for the version with a value combined of the current date (e.g. `20180706` for the 6th of July 2018) and the number of releases on this day (in most cases, `00`. If you update your plugin multiple times during one day, simply increase this number). This might look something like this: `2018070800`. Also replace the value of the variable `VERSION` in the second line of the file `db/install.xml`. 

## Deep-Dive Development 

For Developers the most interesting files are the views, forms and the db-folder to successfully create a working prototype.
Read the following explanations to understand what should happen in the files and how to use the template. 

### .ini-file
* Type of Initialization/Configuration File
* The INI file format is an informal standard for configuration files
* The File should be used to configure URLs, User-Names, Passwords and every other String that is used to initialize your project.
* Example .ini
    ```
    [Example]
    url = https://de.wikipedia.org/
    ```

* Example usage
    ```php
    $ini = parse_ini_file(__DIR__.'/.ini');
    $url = $ini['url'];
    ```

### $SESSION
* Session support in PHP consists of a way to preserve certain data across subsequent accesses.
* It is used to move data across different views or forms
* Example:    
    ```php
    global $SESSION;
    
    //Push new Data to the Session
    $SESSION->data = $data;
     
    //Update the Session-Data 
    $SESSION->data=$updateddata;
  
    //Remove Session-Data from SESSION
    unset($SESSION->data);
    ```

### HTTP-Guzzle
* Guzzle is a PHP HTTP client that makes it easy to send HTTP requests and trivial to integrate with web services.
* Example:
    ```php
    $client = new GuzzleHttp\Client(); 
    // Send an asynchronous request.
       $request = new \GuzzleHttp\Psr7\Request('GET', 'http://httpbin.org');
       $promise = $client->sendAsync($request)->then(function ($response) {
       echo 'I completed! ' . $response->getBody();
    });
    $promise->wait();
    ```

### *_form.php
* Used for user-input (Views)
* To complete a field the submit-button should be used 
* Example:
    ```php
    $mform->addElement('submit', 'btnSubmit', 'Submit');
    ```
* To use a Form you have to use the constructor in your view_*.php files
* Example:
    ```php
    require_once(__DIR__ . '/forms/your_form.php');
    $mform = new your_form();
    ...
    ```
    * for details try to understand the template files 

### view_*.php-files
* Used for handling forms (Controllers)
* The business logic will take place here
* Example logic:
    ```php
    ...
    require_once(__DIR__ . '/forms/your_form.php');
    $mform = new your_form();
    $mform->render();
    
    //Form processing and displaying is done here
    if ($mform->is_cancelled()) {
        //Handle form cancel operation, if cancel button is present on form
    } else if ($fromform = $mform->get_data()) {
        //Handle form successful operation, if button is present on form
    } else {
        // this branch is executed if the form is submitted but the data doesn't validate and the form should be redisplayed
        // or on the first display of the form.
    }
  ...
    ```
### locallib.php vs lib.php
* All the core Moodle functions, neeeded to allow the module to work integrated in Moodle should be placed here.
* All the  specific functions, needed to implement all the module logic, should go to locallib.php.
* #### For understanding
    * lib.php: moodle related functions like functions with DB-access etc.
    * locallib.php: project related functions like standard api-access for Camunda etc.

### version.php
* Used for version control in moodle

### index.php
* Autogenerated file by Moodle for Navigation Bar.
* Do not change any code here

### db-folder
* Used to setup the DB of your plugin
* #### How to use?
    * Example: Get Records
      ```php
      ///Get all records where foo = bar
      $result = $DB->get_records($table,array('foo'=>'bar'));
             
      ///Get all records where foo = bar and jon = doe
      $result = $DB->get_records($table,array('foo' => 'bar' , 'jon' => 'doe'));
             
      ///Get all records where foo = bar, but only return the fields foo,bar,jon,doe
      $result = $DB->get_records($table,array('foo'=>'bar'),null,'foo,bar,jon,doe');
      ///The previous example would cause data issues unless the 'foo' field happens to have unique values
      ```
     
   * Example: Insert Record
     ```php
     $record = new stdClass();
     $record->name         = 'overview';
     $record->displayorder = '10000';
     $lastinsertid = $DB->insert_record('quiz_report', $record, false);
     ```
     
   * Example: Update Record
     ```php
     $DB->update_record($table, $dataobject, $bulk=false)
     /// Update a record in a table.
     /// 
     /// $dataobject is an object containing needed data
     /// Relies on $dataobject having a variable "id" to
     /// specify the record to update
     /// 
     /// @param string $table The database table to be checked against.
     /// @param object $dataobject An object with contents equal to fieldname=>fieldvalue.
     ///        Must have an entry for 'id' to map to the table specified.
     /// @param bool $bulk true means repeated updates expected
     /// @return bool true
     /// @throws dml_exception if an error occurs.
     ```
     
   * Example: Delete record
     ```php
     $select = 'jon = ? AND bob <> ? '; //is put into the where clause
     $DB->delete_records_select($table, $select, array('doe', 'tom'))
     /// Delete one or more records from a table which match a particular WHERE clause.
     ```
* For more details: https://docs.moodle.org/dev/Data_manipulation_API 

### long-folder
* Language file to be used with the get_string()-function

## How to deploy?

* Create a ZIP archive of the `/source` folder and name it according to your app (in this tutorial "newname").

* Login in to [our Moodle instance](https://moodle.ganymed.me), navigate to the Management of Moodle and select the Option to install a new plugin.

* Upload your ZIP archive and click the button to proceed. You do not need to edit any other fields in this interface. 

* When asked if you want to update the Moodle database, do so. 

* Go the main page of Moodle, select a Course and click "Enable Editing" in the options on the upper right. by clicking the option of "Add a resource ...", you should see a list of available plugins including your new module.

*Good luck, you will need it...*
