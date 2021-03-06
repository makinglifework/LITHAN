<?php

/**
 * process_email.php 
 * 
 * Script validate email forms to block email header injection attacks.
 * 
 */

/**
 * @var boolean $suspect
 */
$suspect = false;

/**
 * Regular expression to match patterns of email headers
 * 
 * @var string $pattern
 */
$pattern = '/Content-type:|Bcc:|Cc:/i';

/**
 * Function to validate the post array
 * 
 * @param array $value
 * @param string $pattern
 * @param boolean $suspect
 * 
 * @return boolean
 */
function isSuspect($value, $pattern, &$suspect) {
    if (is_array($value)) {
        foreach ($value as $item) {
            isSuspect($item, $pattern, $suspect);
        }
    }
    else {
        if (preg_match($pattern, $value)) {
            $suspect = true;
        }
    }
}

isSuspect($_POST, $pattern, $suspect);

if (!$suspect) :
    // Check for required fields is not empty or re-assign expected elements
    foreach ($_POST as $key => $value) {
        $value = is_array($value) ? $value : trim($value);
        if (empty($value) && in_array($key, $required)) {
            $missing[] = $key;
            $$key = '';
        }
        elseif (in_array($key, $expected)) {
            $$key = $value;
        }
    }
    
    // Validate email address
    if (!$missing && !empty($email)) :
        $validemail = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        if ($validemail) {
            $headers[] = "Reply-to: $validemail";
        } else {
            $errors['email'] = true;
        }
    endif;
endif;
?>