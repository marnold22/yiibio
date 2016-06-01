

cd C:\xampp\htdocs
git clone "git://github.com/marnold22/yiibio"
cd .\yiibio
composer update
composer install
(echo 0 & echo yes ) | php init

# Edit /commmon/config/main-local.php and add database name and
# password. 'password' => 'put your password here',

C:\xampp\mysql\bin\mysql -u root -p -e "CREATE DATABASE yiibio COLLATE utf8_general_ci;"
.\yii migrate  # enter yes
C:\xampp\mysql\bin\mysql -u root -p -e "source yiibio_Bioinformatics.sql" 
