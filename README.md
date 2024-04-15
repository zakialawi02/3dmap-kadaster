# 3dmap-kadaster

This project is a simple 3d map viewer using CesiumJs library based on Kadaster 3d data. It was created to show how to use cesium with php, jquery, and ajax to load data from a json file. The project also using cesium's built-in 3dtileset to load data from ion assets.

I hope this project can be useful for you.

## How to use

1. Clone this repository
2. Run composer install
3. Restore database `database.sql`
4. Configure database in `action\db_connect.php`
5. Configure `action\first-load.php`, set base url to your project, `$BASE_URL = "http:localhost:PORT/";`
6. Run local server
