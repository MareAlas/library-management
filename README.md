<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Clone the Repository

git clone https://github.com/MareAlas/library-management

## Install Dependencies

composer install

## Start the Development Server

php artisan serve

## Testing API Endpoints with Postman

Import Collection (Optional):
If you have a Postman collection file (*.json) that includes your API requests, you can import it into Postman. This helps in organizing and running your API tests efficiently.

Configure Environment (Optional):
Set up a Postman environment to manage variables like base_url (http://localhost:8000 in this case) for easier testing across different environments.

Make API Requests:

Use different HTTP methods (GET, POST, PUT, DELETE) as per your defined routes.
Include required headers (like Authorization for authenticated routes).

## API Endpoints

POST Register User

URL: http://localhost:8000/register
Method: POST
Description: Allows a user to register in the system.
Body: JSON payload containing user registration details.

POST Login User

URL: http://localhost:8000/login
Method: POST
Description: Allows a user to log in to the system.
Body: JSON payload with user credentials (email and password).

GET All Books

URL: http://localhost:8000/api/books
Method: GET
Description: Retrieves all books available in the system.
Headers: Authorization: Bearer {token} - Optional, required if route requires authentication.

POST Create Book

URL: http://localhost:8000/api/books
Method: POST
Description: Allows an administrator to create a new book in the system.
Headers: Authorization: Bearer {token} - Required, admin access only.
Body: JSON payload with details of the new book such as title, author, etc.

GET Specific Book

URL: http://localhost:8000/api/books/{id}
Method: GET
Description: Retrieves details of a specific book based on its ID.
Headers: Authorization: Bearer {token} - Optional, required if route requires authentication.

PUT Update Book

URL: http://localhost:8000/api/books/{id}
Method: PUT
Description: Allows an administrator to update details of an existing book.
Headers: Authorization: Bearer {token} - Required, admin access only.
Body: JSON payload with new details of the book to be updated.

DELETE Delete Book

URL: http://localhost:8000/api/books/{id}
Method: DELETE
Description: Allows an administrator to delete a book from the system.
Headers: Authorization: Bearer {token} - Required, admin access only.

GET All Authors

URL: http://localhost:8000/authors
Method: GET
Description: Retrieves all authors available in the system.
Headers: Authorization: Bearer {token} - Optional, required if route requires authentication.

POST Create Author

URL: http://localhost:8000/authors
Method: POST
Description: Allows an administrator to create a new author in the system.
Headers: Authorization: Bearer {token} - Required, admin access only.
Body: JSON payload with details of the new author such as name, biography, etc.

PUT Update Author

URL: http://localhost:8000/authors/{id}
Method: PUT
Description: Allows an administrator to update details of an existing author.
Headers: Authorization: Bearer {token} - Required, admin access only.
Body: JSON payload with new details of the author to be updated.

DELETE Delete Author

URL: http://localhost:8000/authors/{id}
Method: DELETE
Description: Allows an administrator to delete an author from the system.
Headers: Authorization: Bearer {token} - Required, admin access only.

GET All Members

URL: http://localhost:8000/members
Method: GET
Description: Retrieves all members available in the system.
Headers: Authorization: Bearer {token} - Required, admin access only.

POST Create Member

URL: http://localhost:8000/members
Method: POST
Description: Allows an administrator to create a new member in the system.
Headers: Authorization: Bearer {token} - Required, admin access only.
Body: JSON payload with details of the new member such as name, membership number, etc.

PUT Update Member

URL: http://localhost:8000/members/{id}
Method: PUT
Description: Allows an administrator to update details of an existing member.
Headers: Authorization: Bearer {token} - Required, admin access only.
Body: JSON payload with new details of the member to be updated.

DELETE Delete Member

URL: http://localhost:8000/members/{id}
Method: DELETE
Description: Allows an administrator to delete a member from the system.
Headers: Authorization: Bearer {token} - Required, admin access only.

GET All Reservations

URL: http://localhost:8000/api/reservations
Method: GET
Description: Retrieves all reservations available in the system.
Headers: Authorization: Bearer {token} - Required, admin access only.

POST Create Reservation

URL: http://localhost:8000/api/reservations
Method: POST
Description: Allows a member to create a new reservation for a book.
Headers: Authorization: Bearer {token} - Required, member access only.
Body: JSON payload with details of the new reservation such as membership number, book ID, reservation date, etc.

GET Specific Reservation

URL: http://localhost:8000/api/reservations/{id}
Method: GET
Description: Retrieves details of a specific reservation based on its ID.
Headers: Authorization: Bearer {token} - Required, admin access only.

PUT Update Reservation

URL: http://localhost:8000/api/reservations/{id}
Method: PUT
Description: Allows an administrator to update details of an existing reservation.
Headers: Authorization: Bearer {token} - Required, admin access only.
