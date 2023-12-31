# Colocation Manager

# Installation

The below installation steps are for Ubuntu OS only. Refer to other guides for installation on different OS.

### Dependencies

### APT Update

```bash
apt-get update && apt-get -y upgrade
```

### Curl (used in several places during installation)

```bash
apt-get -y install curl
```

### Installed apt-add-repository

```bash
apt -y install software-properties-common curl apt-transport-https ca-certificates gnupg
```

### Add Ondřej Surý PPA repository

```bash
LC_ALL=C.UTF-8 add-apt-repository -y ppa:ondrej/php
```

### Add Chris-lea redis server repository

```bash
add-apt-repository -y ppa:chris-lea/redis-server
```

### Download mariadb setup and install it

```bash
curl -sS https://downloads.mariadb.com/MariaDB/mariadb_repo_setup | sudo bash
```

### Install Dependencies

```bash
apt -y install php8.0 php8.0-{cli,gd,mysql,pdo,mbstring,tokenizer,bcmath,xml,fpm,curl,zip} mariadb-server nginx tar unzip git redis-server npm
```

### Composer

```bash
curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer
```

### Downloading files

```bash
mkdir -p /var/www/colocation_manager
cd /var/www/colocation_manager
git clone https://github.com/RyderAsKing/colocation-manager.git ./
chmod -R 755 storage/* bootstrap/cache/
```

### Storage setup, Key setup, Packages install using composer and NPM

```bash
# Copy .env.example to .env
cp .env.example .env

# Composer install
composer install --no-dev --optimize-autoloader

# NPM install
npm install

# building assets
npm run build

# Only run the command below if you are installing this Panel for the first time
php artisan key:generate --force

# You should create a symbolic link from public/storage to storage/app/public
php artisan storage:link
```

### Database Setup

#### Login as root

```bash
mysql -u root -p
```

#### Create database, user and grant all privileges

```bash
CREATE DATABASE colocation_manager;
CREATE USER 'colocation_manager'@'127.0.0.1' IDENTIFIED BY 'colocation_manager';
GRANT ALL PRIVILEGES ON *.* TO 'colocation_manager'@'127.0.0.1' WITH GRANT OPTION;
FLUSH PRIVILEGES;
```

### Configuration

```bash
nano .env
#Example .env vars
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=colocation_manager
DB_USERNAME=colocation_manager
DB_PASSWORD=colocaiton_manager
```

### Installing tables and setting up permission

```bash
php artisan migrate --seed --force
chown -R www-data:www-data /var/www/colocation_manager/*
```

# Example NGINX Config

```bash
nano /etc/nginx/sites-available/colocation_manager.conf
# Paste the code below in the file and then save and exit
server {
        listen 80;
        root /var/www/colocation_manager/public;
        index index.php index.html index.htm index.nginx-debian.html;
        server_name yourdomain.com; # Change this

        location / {
                try_files $uri $uri/ /index.php?$query_string;
        }

        location ~ \.php$ {
                include snippets/fastcgi-php.conf;
                fastcgi_pass unix:/var/run/php/php8.0-fpm.sock;
        }

        location ~ /\.ht {
                deny all;
        }
}

# Enable NGINX Config
# You do not need to symlink this file if you are using CentOS.
sudo ln -s /etc/nginx/sites-available/colocation_manager.conf /etc/nginx/sites-enabled/colocation_manager.conf

# Check for nginx errors
sudo nginx -t

# You need to restart nginx regardless of OS. only do this you haven't received any errors
systemctl restart nginx
```

### SSL (Optional but recommended)

```bash
# Make sure you have python3 installed
sudo add-apt-repository ppa:certbot/certbot
sudo apt-get update
sudo apt-get install python3-certbot-nginx
sudo certbot --nginx -d yourdomain.com
```

## Finishing up

Congratulations, you are now running a instance of server manager on your server.

# Updating

### Enable Maintenance Mode

```bash
cd /var/www/colocation_manager
sudo php artisan down
```

### Downloading new files

```bash
sudo git stash
sudo git pull
sudo chmod -R 755 /var/www/colocation_manager
```

### Updating database

```bash
sudo php artisan migrate --seed --force
```

### Clear cache

```bash
sudo php artisan view:clear
sudo php artisan config:clear
```

### Updating dependencies

```bash
sudo composer install --no-dev --optimize-autoloader
```

```bash
npm install express express-ws ws axios
```

### Updating permissions

```bash
sudo chown -R www-data:www-data /var/www/colocation_manager/*
```

### Restarting queue workers

```bash
sudo php artisan queue:restart
```

### Disable maintenance mode

```bash
sudo php artisan up
```

# Debugging

Get the past 100 logs

```bash
tail -n 100 /var/www/colocation_manager/storage/logs/laravel.log | nc termbin.com 9999
```

Paste the URL in the support discord server at https://discord.gg/6ET3NPYn3a

Do note that this is a open source project and we are not obligated to provide support.

# Finishing up

Congratulations, you have successfully updated and are now running the latest instance of server manager on your server.

# Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

# License

The MIT License ([MIT](https://choosealicense.com/licenses/mit/))

Copyright (c) 2021 Server Manager by Ryder Asking

Permission is hereby granted, free of charge, to any person obtaining a copy of
this software and associated documentation files (the "Software"), to deal in
the Software without restriction, including without limitation the rights to
use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of
the Software, and to permit persons to whom the Software is furnished to do so,
subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS
FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR
COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER
IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN
CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
