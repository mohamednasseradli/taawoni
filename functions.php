<?php 
    session_start(); // starting session
    include('connect.php'); // including file used to connect to database
// This File Contains Function To Be Used All Over the Project

// This function checks if a user is authenticated.
// If the user is authenticated, it redirects them to the appropriate page based on their 'role' (trainee or org).
function isAuthenticated ()
{
    
    if (isset($_SESSION['email']))
    {
        if ($_SESSION['role'] === 'trainee')
        {
            header('location: ../trainee/home.php');

        }
        elseif ($_SESSION['role'] === 'org')
        {
            header('location: ../org/home.php');
        }
    }
}

// This function is used to determine if the user is not authenticated.
// If the user is not authenticated, they will be redirected to the index.php page.
function isNotAuthenticated ()
{
    if (! isset($_SESSION['email']))
    {
        header('location: ./index.php');
    }

}

// This function creates a user session which stores values such as user id, first name, last name, email and role.
// The values are obtained from the argument being passed to the function 
function traineeSession ($user)
{
    $_SESSION['id']             = $user['id'];
    $_SESSION['name']           = $user['name'];
    $_SESSION['email']          = $user['email'];
    $_SESSION['phone']          = $user['phone']    ;
    $_SESSION['average']        = $user['average'];
    $_SESSION['affirmedOrg']    = $user['affirmed_org'];
    $_SESSION['role']           = $user['role'];

}

// This function creates a user session which stores values such as user id, name, email, phone, average and role.
// The values are obtained from the argument being passed to the function 
function orgSession ($user)
{
    $_SESSION['id']         = $user['id'];
    $_SESSION['name']       = $user['name'];
    $_SESSION['email']      = $user['email'];
    $_SESSION['phone']      = $user['phone']    ;
    $_SESSION['role']       = $user['role'];

}

// Function to authenticate Trainee
// If the login data is valid the authenticate trainee and creeate session
// If not return login page with errors
function authTrainee ($email, $password)
{
    global $con; 

    $hashed_pass    = sha1($password); // Hashing password to compare with hashed password in database

    // checking if client registered in database
    $query      = $con->prepare("SELECT * FROM trainees WHERE email = ? AND password = ? LIMIT 1");
    $query->execute([$email, $hashed_pass]);

    if ($query->rowCount() == 0)
    {
        return false;

    } else 
    {
        $trainee = $query->fetch();

        traineeSession($trainee); // Storing trainee Data in session to be accessible 

        return true;
    }
}


// Function to authenticate Org
// If the login data is valid the authenticate org and creeate session
// If not return login page with errors
function authOrg ($email, $password)
{
    global $con; 

    $hashed_pass    = sha1($password); // Hashing password to compare with hashed password in database

    // checking if tech registered in database
    $query      = $con->prepare("SELECT * FROM orgs WHERE email = ? AND password = ? AND status = 1 LIMIT 1");
    $query->execute([$email, $hashed_pass]);

    if ($query->rowCount() == 0)
    {
        return false;

    } else 
    {
        $org = $query->fetch();

        orgSession($org); // Storing org Data in session to be accessible 

        return true;
    }
}


// Function to authenticate Admin
// If the login data is valid the authenticate admin and creeate session
// If not return login page with errors
function authAdmin ($email, $password)
{
    global $con; 

    $hashed_pass    = sha1($password); // Hashing password to compare with hashed password in database

    // checking if tech registered in database
    $query      = $con->prepare("SELECT * FROM admins WHERE email = ? AND password = ? LIMIT 1");
    $query->execute([$email, $hashed_pass]);

    if ($query->rowCount() == 0)
    {
        return false;

    } else 
    {
        $org = $query->fetch();

        orgSession($org); // Storing org Data in session to be accessible 

        return true;
    }
}

//This function is used to check if the provided email exists in the trainees table in the database.
// The function takes in an email and returns a boolean value of either true or false based on the result of the query.
function traineeEmailExists($email)
{
    global $con;

    $query      = $con->prepare("SELECT * FROM trainees WHERE email = ? LIMIT 1");
    $query->execute([$email]);

    if ($query->rowCount() == 0)
    {
        return false;

    } else 
    {
        return true;
    }
}



function traineePhoneExists($phone)
{
    global $con;

    $query      = $con->prepare("SELECT * FROM orgs WHERE phone = ? LIMIT 1");
    $query->execute([$phone]);

    if ($query->rowCount() == 0)
    {
        return false;

    } else 
    {
        return true;
    }
}

//This function is used to check if the provided email exists in the orgs table in the database.
// The function takes in an email and returns a boolean value of either true or false based on the result of the query.
function orgEmailExists($email)
{
    global $con;

    $query      = $con->prepare("SELECT * FROM orgs WHERE email = ? LIMIT 1");
    $query->execute([$email]);

    if ($query->rowCount() == 0)
    {
        return false;

    } else 
    {
        return true;
    }
}


function orgPhoneExists($phone)
{
    global $con;

    $query      = $con->prepare("SELECT * FROM orgs WHERE phone = ? LIMIT 1");
    $query->execute([$phone]);

    if ($query->rowCount() == 0)
    {
        return false;

    } else 
    {
        return true;
    }
}

/**
* storeCv() is used to store files in the uploads folder by giving file name as the tainee_id.
*
* @param $file     string   The file name to be stored in the server
* @param $tainee_id  integer  ID of the trainee 
*
* @return true/false. true if success, false if failed.
*/

function storeCv($filename, $file)
{

    $destination_path = './trainee/uploads/cv/'; // Path to store uploaded file at

    $upload     = move_uploaded_file($file['tmp_name'], $destination_path.$filename); // Storing Uploaded File
    if($upload)
    {
        return true;

    } else {

        return false;
    }
}
/**
* storeLetter() is used to store files in the uploads folder by giving file name as the tainee_id.
*
* @param $file     string   The file name to be stored in the server
* @param $tainee_id  integer  ID of the trainee 
*
* @return true/false. true if success, false if failed.
*/

function storeLetter($filename, $file)
{

    $destination_path = '../trainee/uploads/letter/'; // Path to store uploaded file at

    $upload     = move_uploaded_file($file['tmp_name'], $destination_path.$filename); // Storing Uploaded File
    if($upload)
    {
        return true;

    } else {

        return false;
    }
}


/**  
* This function allows a user to register with the system 
* The function takes in an array with the data of the user and stores it in the database. 
* It also checks if the operation was successful and in that case sets up the 
**/
function registerTrainee (array $data)
{
    global $con;

    // query to add register data in database table clients
    $query      = $con->prepare("INSERT INTO trainees (name, email, password, phone, speciality, sex, cv, average) VALUES (:name, :email, :password, :phone, :speciality, :sex, :cv, :average)");
    $success    = $query->execute(
        [
            'name'          => $data['name'],
            'email'         => $data['email'],
            'password'      => $data['password'],
            'phone'         => $data['phone'],
            'speciality'    => $data['speciality'],
            'sex'           => $data['sex'],
            'cv'            => $data['cv'],
            'average'       => $data['average'],
        ]
    );

    if ($success)   // checking if data added to database successfully
    {

        return true; // return true if everthing is ok
        
    }

    return false; // return false if something wrong happened
}


//This function returns the data of an Trainee based on the Trainee id passed in as a parameter.
// It returns null if there is no Trainee with the specified id.
function getTrainee ($trainee_id)
{
    global $con;

    $query      = $con->prepare("SELECT * FROM trainees WHERE id = ? LIMIT 1");
    $query->execute([$trainee_id]);

    if ($query->rowCount() == 0)
    {
        return null;

    } else 
    {
        return $query->fetch();
    }
}

/**
* This function creates a new tech entry in the orgs table in the database.
* It takes in an array of data which contains the first name, last name, email and password of the tech it is creating.
* It returns true if the query is successful or false if it fails.
**/
function registerOrg (array $data)
{
    global $con;

    // query to add register data in database table clients
    $query      = $con->prepare("INSERT INTO orgs (name, email, password, phone, org_type, training_date) VALUES (:name, :email, :password, :phone, :org_type, :training_date)");
    $success    = $query->execute(
        [
            'name'          => $data['name'],
            'email'         => $data['email'],
            'password'      => $data['password'],
            'phone'         => $data['phone'],
            'org_type'      => $data['org_type'],
            'training_date' => $data['training_date'],
        ]
    );

    if ($success)   // checking if data added to database successfully
    {
        return true; // return true if everthing is ok
    }

    return false; // return false if something wrong happened
}

// orgNotAcceptedYet() is a function that takes two parameters - $email and $password -
// and checks if the credentials match a record in the 'orgs' table with a status of 0 (not yet accepted).
// If a matching record is found it returns true, otherwise it returns false.
function orgNotAcceptedYet ($email, $password)
{
    global $con; 

    $hashed_pass    = sha1($password); // Hashing password to compare with hashed password in database

    // checking if tech registered in database
    $query      = $con->prepare("SELECT * FROM orgs WHERE email = ? AND password = ? AND status = 0 LIMIT 1");
    $query->execute([$email, $hashed_pass]);

    if ($query->rowCount() == 0)
    {
        return false;

    } else 
    {

        return true;
    }

}


function orgRejected ($email, $password)
{
    global $con; 

    $hashed_pass    = sha1($password); // Hashing password to compare with hashed password in database

    // checking if tech registered in database
    $query      = $con->prepare("SELECT * FROM orgs WHERE email = ? AND password = ? AND status = -1 LIMIT 1");
    $query->execute([$email, $hashed_pass]);

    if ($query->rowCount() == 0)
    {
        return false;

    } else 
    {

        return $query->fetch();
    }
}


// This function is used to accept an organization.
// It takes the org id as an argument and updates the status field to 1 in the orgs table.
// It then returns true or false depending on the success of the update.
function acceptOrg ($org_id)
{
    global $con;

    $query      = $con->prepare("UPDATE orgs SET status = 1 WHERE id = ?");
    $query->execute([$org_id]);

    if ($query->rowCount() == 0)
    {
        return false;

    } else 
    {
        return true;
    } 

}

// This function is used to reject an organization.
// It takes the org id as an argument and updates the status field to -1 in the orgs table.
// It then returns true or false depending on the success of the update.
function rejectOrg ($org_id, $rejection_reason = null)
{
    global $con;

    $query      = $con->prepare("UPDATE orgs SET status = -1, rejection_reason = '$rejection_reason' WHERE id = ?");
    $query->execute([$org_id]);

    if ($query->rowCount() == 0)
    {
        return false;

    } else 
    {
        return true;
    } 

}

function blockOrg ($org_id)
{
    global $con;

    $query      = $con->prepare("UPDATE orgs SET status = -2 WHERE id = ?");
    $query->execute([$org_id]);

    if ($query->rowCount() == 0)
    {
        return false;

    } else 
    {
        return true;
    } 

}

//This function returns the data of an organization based on the organization id passed in as a parameter.
// It returns null if there is no organization with the specified id.
function getOrg ($org_id)
{
    global $con;

    $query      = $con->prepare("SELECT * FROM orgs WHERE id = ? LIMIT 1");
    $query->execute([$org_id]);

    if ($query->rowCount() == 0)
    {
        return null;

    } else 
    {
        return $query->fetch();
    }
}


// Function to retrieve all organizations from the db
// Input: none
// Output: list of organizations from the db, empty list if there are no organizations in the
function getOrgs ()
{
    global $con;

    $query      = $con->prepare("SELECT * FROM orgs ORDER BY id DESC");
    $query->execute();

    if ($query->rowCount() == 0)
    {
        return [];

    } else 
    {
        return $query->fetchAll();
    }
}

function getAvailableOrgs ()
{
    global $con;

    $query      = $con->prepare("SELECT * FROM orgs WHERE status = 1 ORDER BY id DESC");
    $query->execute();

    if ($query->rowCount() == 0)
    {
        return [];

    } else 
    {
        return $query->fetchAll();
    }
}

// This function is used to add request to the database.
// It takes an array of data as an argument containing values for trainee_id and org_id to be used for the request.
// The function then prepares a query to insert the data into the database and executes it.
// Finally, it returns true if the query was successful or false if not.
function addRequest ($data)
{
    global $con;
    // Query to add new rating
    $query      = $con->prepare('INSERT INTO requests (trainee_id, org_id, letter) VALUES (:trainee_id, :org_id, :letter)');
    $success    = $query->execute(
        [
            'trainee_id'     => $data['trainee_id'],
            'org_id'         => $data['org_id'],
            'letter'         => $data['letter'],
        ]
    );

    if ($success)   // checking if data added to database successfully
    {
        return true; // return true if everthing is ok
    }

    return false; // return false if something wrong happened
}

/*
This function retrieves a list of requests from the database.
It uses a prepared statement to protect against SQL injection attacks and then returns the result set.
If no records were found, the function returns null.
*/
function getRequestsTrainee ($trainee_id, $status = 0)
{
    global $con;

    $query      = $con->prepare("SELECT requests.*, orgs.name AS org_name FROM requests
                                INNER JOIN orgs ON requests.org_id = orgs.id
                                WHERE trainee_id = ? AND requests.status = ?
                                ORDER BY date DESC");
    $query->execute([$trainee_id, $status]);

    if ($query->rowCount() == 0)
    {
        return [];

    } else 
    {
        return $query->fetchAll();
    }
}


function affirmOrg ($trainee_id, $org_id)
{
    global $con;

    $query      = $con->prepare("UPDATE trainees SET affirmed_org = ? WHERE id = '$trainee_id' ");
    $query->execute([$org_id]);

    if ($query->rowCount() == 0)
    {
        return false;

    } else 
    {
        $_SESSION['affirmedOrg'] = $org_id;
        return true;
    } 
}
/*
This function retrieves a list of requests from the database.
It uses a prepared statement to protect against SQL injection attacks and then returns the result set.
If no records were found, the function returns null.
*/
function getRequestsOrg ($org_id)
{
    global $con;

    $query      = $con->prepare("SELECT requests.id AS request_id, requests.date, requests.status, requests.letter, trainees.* FROM requests
                                INNER JOIN trainees ON requests.trainee_id = trainees.id
                                WHERE org_id = ? ORDER BY requests.id DESC");
    $query->execute([$org_id]);

    if ($query->rowCount() == 0)
    {
        return [];

    } else 
    {
        return $query->fetchAll();
    }
}


function acceptRequest ($request_id)
{
    global $con;

    $query      = $con->prepare("UPDATE requests SET status = 1 WHERE id = ? ");
    $query->execute([$request_id]);

    if ($query->rowCount() == 0)
    {
        return false;

    } else 
    {
        return true;
    }   
}


function rejectRequest ($request_id)
{
    global $con;

    $query      = $con->prepare("UPDATE requests SET status = -1 WHERE id = ? ");
    $query->execute([$request_id]);

    if ($query->rowCount() == 0)
    {
        return false;

    } else 
    {
        return true;
    }   
}


// This function is used to add a new rating to the rating table.
// It takes the data array and inserts it into the rating table in the database.
// It returns true if the record was successfully added and false if it wasn't.
function addRating ($data)
{
    global $con;

    // Query to add new rating
    $query      = $con->prepare('INSERT INTO ratings (trainee_id, org_id, rating, description) VALUES (:trainee_id, :org_id, :rating, :description)');
    $success    = $query->execute(
        [
            'trainee_id'   => $data['trainee_id'],
            'org_id'       => $data['org_id'],
            'rating'       => $data['rating'],
            'description'  => $data['description'],
        ]
    );

    if ($success)   // checking if data added to database successfully
    {
        return true; // return true if everthing is ok
    }

    return false; // return false if something wrong happened
}


//This function is used to get ratings from the ratings table in the database for a particular Technician ID.
// It takes the Technician ID as an input and returns an associative array containing the rating information or null if the query result is empty.
function getRatings ($org_id)
{
    global $con;

    $query      = $con->prepare("SELECT ratings.*, trainees.name AS trainee_name FROM ratings
                                INNER JOIN trainees ON ratings.trainee_id = trainees.id
                                WHERE org_id = ?");
    $query->execute([$org_id]);

    if ($query->rowCount() == 0)
    {
        return null;

    } else 
    {
        return $query->fetchAll();
    }
}

// This function is used to retrieve the organizations that a specific trainee has received training from.
// It makes use of an inner join between the requests and organizations tables to retrieve the name of the organizations, as well as the status of the request.
// Additionally, it groups the results by the organization ID and orders them in descending order by the ID.
function getTrainedAtOrgs ($trainee_id)
{
    global $con;

    $query      = $con->prepare("SELECT requests.*, orgs.name FROM requests
                                INNER JOIN orgs ON requests.org_id = orgs.id
                                WHERE trainee_id = ? AND requests.status = 1
                                GROUP BY requests.org_id
                                ORDER BY requests.id DESC");
    $query->execute([$trainee_id]);

    if ($query->rowCount() == 0)
    {
        return [];

    } else 
    {
        return $query->fetchAll();
    }  
}


function getOrgsRatings ()
{
    global $con;

    $query      = $con->prepare("SELECT ratings.*, orgs.name AS org_name, trainees.name AS trainee_name FROM ratings
                                INNER JOIN orgs ON ratings.org_id = orgs.id
                                INNER JOIN trainees ON ratings.trainee_id = trainees.id
                                ORDER BY ratings.date DESC");
    $query->execute();

    if ($query->rowCount() == 0)
    {
        return [];

    } else 
    {
        return $query->fetchAll();
    }  
}

// Statistics

function getSpecialityAccepted ($speciality)
{
    global $con;

    $query      = $con->prepare("SELECT requests.* FROM requests
                                INNER JOIN trainees ON requests.trainee_id = trainees.id
                                WHERE trainees.affirmed_org IS NULL
                                AND trainees.speciality = ?
                                AND requests.status = 1 ");
    $query->execute([$speciality]);

    if ($query->rowCount() == 0)
    {
        return [];

    } else 
    {
        return $query->fetchAll();
    }
}

function getSpecialityRejected ($speciality)
{
    global $con;

    $query      = $con->prepare("SELECT requests.* FROM requests
                                INNER JOIN trainees ON requests.trainee_id = trainees.id
                                WHERE trainees.affirmed_org IS NULL
                                AND trainees.speciality = ?
                                AND requests.status = -1 ");
    $query->execute([$speciality]);

    if ($query->rowCount() == 0)
    {
        return [];

    } else 
    {
        return $query->fetchAll();
    }
}

function getSpecialityAffirmedOrg ($speciality)
{
    global $con;

    $query      = $con->prepare("SELECT * FROM trainees WHERE speciality = ? AND affirmed_org IS NOT NULL");
    $query->execute([$speciality]);

    if ($query->rowCount() == 0)
    {
        return [];

    } else 
    {
        return $query->fetchAll();
    }
}

// Trainees by speciality
function traineesByspeciality ($speciality)
{
    global $con;

    $query      = $con->prepare("SELECT * FROM trainees WHERE speciality = ? ");
    $query->execute([$speciality]);

    if ($query->rowCount() == 0)
    {
        return [];

    } else 
    {
        return $query->fetchAll();
    }
}