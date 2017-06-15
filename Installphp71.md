# mac安装PHP71
```
$ brew isntall nginx
$ brew install php71
$ brew services start php71
```
nginx配置:
```
server {
    listen       8089;
    server_name  dev.local;
    root   /html;
    index  index.html index.htm index.php;

    autoindex_localtime on;
    #error_page  404 /404.html;
    error_page   500 502 503 504  /50x.html;
    location = /50x.html {root html;}
    location ~ .*\.(php)?$ {
        fastcgi_pass 127.0.0.1:9000;
        fastcgi_index index.php;
        include fastcgi.conf;
    }

    location / {
        if (!-e $request_filename){
                rewrite ^(.*)$ /index.php?s=$1 last;
                break;
        }
    }

    access_log off;
}
```