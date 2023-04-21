## Cloning the Project

Clone the project in the Code Tab of the respository

 > `git clone https://github.com/KWangechi/solutech_code_challenge.git`
 
 ## Setting Up the Project
 
 - After cloning the Project, update composer using the following command: but first make sure you have composer installed first
 
>  `composer update`
 
 - Remember to define your environmental variables by copying the `.env.example` file into your own `.env` file
 > `cp .env.example .env`

 
- Next, install the npm packages since the project using Vue JS as the frontend framework
 
> `npm install`
 
- Seed the database and migrate the table
> `php artisan migrate --seed`

- Run the Laravel app
> `php artisan serve`

- Run the frontend(Vue)
> `npm run dev`

# Demo Example
## Login

### Login![Login_Page](https://user-images.githubusercontent.com/54848316/233610074-0a715f77-9d11-47be-8b42-e13a9468bfa9.PNG)
- One is redirected to this page since authentication is required

### Login with errors![Login_Error](https://user-images.githubusercontent.com/54848316/233610202-86080b6b-dcb5-4dde-ad0d-4bee4054a556.PNG)
- This is shown when there is a login error

### Successful Login![DashBoard_After_Login](https://user-images.githubusercontent.com/54848316/233610800-514cabc2-c7b4-4a47-a8b3-7c01aa433b0f.PNG)
- On successful login, the user is redirected to the dashboard page

## Status CRUD
![Status_Table](https://user-images.githubusercontent.com/54848316/233611040-94b41e55-6cbf-416d-9b83-533d4767510d.PNG)
- Showing all the task status tables

![Creating a New Status](https://user-images.githubusercontent.com/54848316/233611165-761ff6ea-08e4-4d35-b438-34a69e52149a.PNG)
- Creating a new Task status using a modal

![Edit_Status_Page](https://user-images.githubusercontent.com/54848316/233611543-b2a36918-baaa-4b9b-8e59-8d1c643ccd25.PNG)
- Editing a Task Status

![Succesful Updates](https://user-images.githubusercontent.com/54848316/233611619-368cf4fe-cc37-4e77-90be-3936bdb78156.PNG)
- Succesful updates for the Task Status

![Status_Deletion_Alert](https://user-images.githubusercontent.com/54848316/233611745-152e09a3-92e6-47ef-add3-90b62ace3f0f.PNG)
- Confirmation of deleteing a task status

![Successful_Status_Deletion](https://user-images.githubusercontent.com/54848316/233611945-5e6e7b7e-ac35-44f5-a643-e37af0e62f77.PNG)
- When the task is deleted successfully





