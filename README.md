
//Descargar php y sus funciones auxiliares
sudo apt install -y php php-cli php-common php-xml php-mbstring php-zip php-curl php-intl php-sqlite3 php-mysql unzip git


//Descargar symfony 
wget https://get.symfony.com/cli/installer -O - | bash
mv ~/.symfony*/bin/symfony /usr/local/bin/symfony
symfony -v

//crear proyecto con composer
composer create-project symfony/skeleton mi_proyecto
cd mi_proyecto
composer require symfony/webapp-pack
symfony serve

//crear controladores
composer require make
composer require doctrine/annotations
php bin/console make:controller Usuarios

//crear entidades
//ORM 
composer require symfony/orm-pack
composer require --dev symfony/maker-bundle
//crear entidad
php bin/console make:entity
//crear Base de datos
php bin/console doctrine:database:create
//migrar entidad a la DB
php bin/console make:migration
php bin/console doctrine:migrations:migrate

//style and objet asset
composer require symfony/asset

//agregar bootstrap
composer require twbs/bootstrap

//crear formularios  ...type
composer require form validator
php bin/console make:form Usuarios

//ASIGNANDO EL LOGIN 
composer require "lexik/jwt-authentication-bundle"
mkdir -p config/jwt
php bin/console lexik:jwt:generate-keypair --overwrite --no-interaction


