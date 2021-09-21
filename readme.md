
## About PRAXXYS Test

Please use the following frameworks:
    ● Bootstrap 3
    ● jQuery
    ● Laravel 5.8 (it has to be this version specifically)
    
And using the following template:

https://startbootstrap.com/template-overviews/sb-admin/

(Please use download link for Bootstrap 3 version)
    
Please create a simple CMS that will allow users to Manage a database of song lyrics. 
    ● We’d like the CMS to be password protected using Laravel’s built-in auth system.
    ● Unauthenticated users should redirect to the login page.
    ● Authenticated users should have the option to:
        ● Create a new database entry with a title, an artist, and the song lyrics.
        ● Edit an existing entry, and update the values for their title, artist and song lyrics.
        ● Delete a song lyrics entry.
        ● List all song lyrics in the database. Show the title, the artist, and date created.
    ● List of song lyrics from #3 should use Datatables 
    https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/dist/tables.html
    ● Please include database migrations, and seeders.
    ● All web pages must be responsive.
    ● Push your code to a repository on Github.com

## Composer Packages Installed
    ● "laravel/framework": "5.8.*"
    
## Usage

1. Clone/Download a repo.
2. Copy .env.example file to .env & Setup your environment variables
3. Run ***composer install***
4. Generate application key by running ***php artisan key:generate***
5. Migrate database by running ***php artisan migrate***
6. Seed database by running ***php artisan db:seed***
7. Run ***npm install*** then ***npm run dev*** to load modules and assets
8. Run ***php artisan serve***

Default email: songwriter@test.com
Default Password: songwriter
