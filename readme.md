# Demo of catching and logging locally

This is just one approach to logging.  The philosophy is to catch exceptions as close to where they occur as possible.  This means that you have access to the context of the error (local variables and callstack).  You then rethrow your error to allow a central error handler to act as a safety net and manage setting response values.

# Usage

Install the dependencies with `composer install` 

Edit `index.php` and place your Rollbar token into the placeholder on line 11.

Fuinally, run the project with `php index.php`