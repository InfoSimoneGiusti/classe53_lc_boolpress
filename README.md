Cloniamo la repo esistente da GitHub
Composer install
Npm install
Copia il file .env (cp .env.example .env da riga di comando)
Crea un nuovo DB in phpmyadmin
Configura il file .env per DB e Mail
Rigeneriamo la nostra App Key ( php artisan key:generate )
Cancelliamo la cache delle impostazioni ( php artisan config:clear )
Lanciamo le migrazioni ( php artisan migrate )
Lanciamo i seeder ( php artisan db:seed se abbiamo un metodo definito nella DatabaseSeeder.php oppure php artisan db:seed --class=NomeDelSeeder)
Creiamo il link da storage alla cartella public php artisan storage:link
