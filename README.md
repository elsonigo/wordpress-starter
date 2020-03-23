# wordpress template with laravel mix

## set up local wordpress server

### add wordpress-starter theme
``` bash
# clone repo into wordpress folder
$ git clone https://github.com/elsonigo/wordpress-starter.git

# change theme name in .gitignore file

# change theme name in webpack.mix.js file

# install dependencies
$ npm install

# create files in development mode
$ npm run dev

# select theme in WordPress

# set up hot-reloading server
change proxy address within the .env file

# start dev server 
$ npm run watch

# generate production ready files in /dist folder
$ npm run prod
```