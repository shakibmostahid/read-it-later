# READ IT LATER

A platform where user can create pockets and inside pockets multiple URLs can be stored. User can view given URL's major contents(if any) in pockets list page where pockets and contents details are available.  

## Getting Started
To get a local copy up and running follow these simple example steps.

### Prerequisites
* php >= 7.2
* MySQL >= 5.6

### Installation
1. Clone the repo
   ```sh
   git clone https://github.com/your_username_/Project-Name.git
   ```
2. Install Composer packages
   ```sh
   composer install
   ```
3. Copy `.env.example` file to `.env` on the root folder

4. Open your `.env` file and change the database name (`DB_DATABASE`), username (`DB_USERNAME`) and password (`DB_PASSWORD`) to whatever you have.
5. Generate app key 
    ```sh
    php artisan key:generate
    ```
6. Migrate Database 
    ```sh
    php artisan migrate
    ```
7. If you want to add test data
    ```sh
    php artisan db:seed
    ```
8. To run app in development mode
    ```sh
    php artisan serve
    ```
9. To finish queue jobs
    ```sh
    php artisan queue:work --tries=2
    ```

## Usage
### Web Pages
`\pocket` => to view available pockets and contents

### APIs
* To create a Pocket
    `POST` **/api/v1/pockets**
    **Request Body**: *{"title": "Pocket 1"}*
* To store a content in the pocket
    `POST` **/api/v1/pockets/{id}/contents**
    **Request Body**: *{"url": "valid-url-only"}*
* To view all contents in one pocket
    `GET` **/api/v1/pockets/{id}/contents**
* To delete one stored content url
    `DELETE` **/api/v1/contents/{id}**