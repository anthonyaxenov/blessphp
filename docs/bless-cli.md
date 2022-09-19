# Bless CLI script

This script placed in root project repo and allows you to do almost anything with project containers and files.

You can edit it as you want and extend with commands of your choice.

These commands are available out of the box:

```
# set up bless stack for the first run
./bless init

# build and start containers
./bless up

# start containers built earlier
./bless start

# restart containers
./bless restart

# stop runnings containers
./bless stop

# stop and remove containers
./bless down

# remove old containers and build them again
./bless rebuild

# open app in web browser
./bless web

# clear view cache
./bless clear-views

# clear logs written in `log/*`
./bless clear-logs

# clear view cache && logs
./bless clear

# get IPs of Bless containers
./bless ip

# run ANY command inside bless-php container
# double-quotes are recommended
./bless "composer update"

# get help
./bless [help]
```
