# REST API for delivery

## Resources
The API has been built with two resources 1) Tasks 2) Transactions

## Prerequisite 

You will need to make sure your server meets the following requirements:

- PHP >= 7.1.3
- MySql >= 5.7
- Composer
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- Ctype PHP Extension
- JSON PHP Extension
- BCMath PHP Extension

You can check all the laravel related dependecies <a href="https://laravel.com/docs/5.7/installation#server-requirements"  target="_blank"> here </a>.

## Installation steps

Follow the bellow steps to install and set up the application.

**Step 1: Clone the Application**<br>
Download the ZIP file or git clone from repo into your project  directory.

**Step 2: Configure the Application**<br>
Set up by following commands-

- Run in terminal, project root directory
    
        composer install 
    
- Rename the .env.example file to .env file in the project root folder

- Edit the .env file by filling all required data for the next variables
    
        APP_URL=http://localhost //application domain URL
    
        DB_HOST=127.0.0.1 // DB host
        DB_PORT=3306 // DB Port
        DB_DATABASE=db_name // DB Name
        DB_USERNAME=db_username // DB Username
        DB_PASSWORD=db_password // DB Password
    
- To set the Application key run the bellow command in your terminal.
    
        php artisan key:generate
    
- Make your storage and bootstrap folder writable by your application user.

- Migrate db tables by running command.
    
        php artisan migrate

- Fill default data by running command.

        php artisan db:seed

## API Endpoints and Routes

Bellow are the all resources API endpoints - 

        POST   | api/login | api,guest 

        POST   | api/logout | api

        POST   | api/transaction | api,auth:api

        PUT    | api/task/{id} | api,auth:api 

## API Authentication 

Api endpoints are protected by a simple API Authentication process. To access the resource data, the request header need api_token field. The **api_token** value need to be taken from the **api/login** API by passing valid username and password.
    
   **Example Of Login API request**
    
        $ curl -X POST appurl/api/login \
        -H "Accept: application/json" \
        -H "Content-type: application/json" \
        -d "{\"email\": \"john@gmail.com\", \"password\": \"123456\" }"
        
   **Response Of Valid Login API**
        
        {
            "data": {
                    "id": 1,
                    "name": "John Smith",
                    "email": "john@gmail.com",
                    "balance": 180.6,
                    "api_token": "aNOxdZ4L246Fk1MU7iB33MMSNk2MdNYlcWQ1AEtNiLPoFieTdP",
                    "created_at": "2020-04-24 13:00:17",
                    "updated_at": "2020-04-24 20:13:37"
                }
        }



Then you can send api_token as a bearer token in the request headers in the form of **Authorization: Bearer aNOxdZ4L246Fk1MU7iB33MMSNk2MdNYlcWQ1AEtNiLPoFieTdP**

   **To set task as complete and visit location to get parcel**
    
        $ curl -X POST application_url/api/task/1 \
        -H "Accept: application/json" \
        -H "Authorization: Bearer aNOxdZ4L246Fk1MU7iB33MMSNk2MdNYlcWQ1AEtNiLPoFieTdP" \
        -H "Content-type: application/json" \
        -d "{\"user_id\": \"1\" }"

   **To receive parcel and monye on you balance for delivery**
        
        $ curl -X POST application_url/api/task/2 \
        -H "Accept: application/json" \
        -H "Authorization: Bearer aNOxdZ4L246Fk1MU7iB33MMSNk2MdNYlcWQ1AEtNiLPoFieTdP" \
        -H "Content-type: application/json" \
        -d "{\"user_id\": \"1\" }"

   **To send money between users**
        
        $ curl -X POST application_url/api/transaction \
        -H "Accept: application/json" \
        -H "Authorization: Bearer aNOxdZ4L246Fk1MU7iB33MMSNk2MdNYlcWQ1AEtNiLPoFieTdP" \
        -H "Content-type: application/json" \
        -d "{\"from_user_id\": \"1\",  \"to_user_id\": \"2\",  \"amount\": \"22\"}"

