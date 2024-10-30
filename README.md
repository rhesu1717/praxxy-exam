# Getting started
Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/11.x/installation#meet-laravel)

## Installation

Clone the repository
```
git clone https://github.com/rhesu1717/praxxy-exam.git
```
Switch to the repo folder
```
cd praxxy-exam
```
Install all the dependencies using composer
```
composer install
```
Copy the example env file and make the required configuration changes in the .env file
```
cp .env.example .env
```
Generate a new application key
```
php artisan key:generate
```
Run the database migrations (Set the database connection in .env before migrating)
```
php artisan migrate
```
> [!WARNING]
> The SQLite database configured for this application does not exist: C:\ComputerName\praxxy-exam\database\database.sqlite.
> Would you like to create it? (yes/no) [yes]
> yes

Run the database seeder and you're done
```
php artisan db:seed
```
Run npm module
```
npm install
```
Run npm build
```
npm run build
```
Start the local development server
```
php artisan serve
```
