# Docker environment

You can use docker to get an isolated environment.

There are two ways to achieve this.

## Automatic

Just run `./bless init` to let magic happen.

## Manual

1. Run `cp .env.example .env` and set correct parameters in `.env`
2. Run `docker compose up -d --build` (or `./bless up`)
3. Open `http://<APP_URL>:8888` in your browser (или `./bless open`)

## Reverse proxy

### apache2

If apache is used as main web-server then you can create virtual host to proxy requests from host to docker machine.

```
$ sudo a2enmod proxy proxy_http proxy_balancer lbmethod_byrequests
$ sudo nano /etc/apache2/sites-available/bless.conf
```

```apacheconf
# example.com must be replaced with your address

<VirtualHost example.com:80>
    ServerName example.com
    # necessary without SSL:
    ProxyPreserveHost On
    ProxyPass / http://localhost:8888/
    ProxyPassReverse / http://localhost:8888/
    # necessary with SSL:
    # RewriteEngine on
    # RewriteCond %{SERVER_NAME} =example.com
    # RewriteRule ^ https://%{SERVER_NAME}%{REQUEST_URI} [END,NE,R=permanent]
</VirtualHost>

# necessary with SSL:
#<IfModule mod_ssl.c>
#<VirtualHost example.com:443>
#    ServerName example.com
#    ProxyPreserveHost On
#    ProxyPass / http://localhost:8888/
#    ProxyPassReverse / http://localhost:8888/
#    use certbot to get certs for SSL
#    SSLCertificateFile /etc/letsencrypt/live/example.com/fullchain.pem
#    SSLCertificateKeyFile /etc/letsencrypt/live/example.com/privkey.pem
#    Include /etc/letsencrypt/options-ssl-apache.conf
#</VirtualHost>
#</IfModule>

# Ctrl+O
# Enter
# Ctrl+X
```

```shell
$ sudo a2ensite bless
$ # you must 'restart' apache instead of 'reload' to activate proxy modules
$ sudo systemctl restart apache2
```

### nginx

TODO
