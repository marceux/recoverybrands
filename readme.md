# Code Test v2
## by Marco Salazar de Leon

### Objective
Write a PHP script that requests all the meetings in San Diego, CA and sorts all Monday meetings by their distance from the below address.

### Requirements
- PHP 5.4
- Composer

### Installation
Download the code into a directory.  From the command line run the following command:

`composer install`

This will install all of the dependencies needed to run the test.

### Running the Test
Go into the source directory and run the following PHP command.

`php artisan serve`

This should run a PHP server that will host the test.  You can visit the test in your browser by going to:
`http://localhost:8000`

You can use your own custom parameters in the URL for state, city, and day of the week.  Simply follow this structure:

`http://domain/s/{state abbreviation}/c/{city}/d/{day of the week, lowercase}`

### Test Specs
This test submission uses the following 3rd-party libraries:
- Composer
- Laravel
- fguillot/JSON-RPC
- calcdistance
- Predis

As well a few of these front-end 3rd-party frameworks...
- Font-Awesome
- Bootstrap

### Contact
Any questions?  You may contact me at <msalazardeleon@gmail.com>.  Thank you!