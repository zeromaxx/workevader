# WorkEvader App

Working demo of the app can be found here : http://work-evader.great-site.net/

Local Setup Proccess :
 
Technologies Used : Docker, PHP, Boostrap

Prerequisites : Docker and Docker Compose installed on your machine.

1. Clone the repository
2. Data for the database can be found in db.sql
3. Start the Containers

    Use Docker Compose to build and run the containers:

    docker-compose up -d

4. Database Import

    After the containers are up, import the initial database data:

    Open phpMyAdmin (http://localhost:8081).
    Select the workevader_db database.
    Use the Import feature to upload db.sql

5. Manager Role Credentials

Email : john.doe@example.com

Psw : john.doe@example.com
