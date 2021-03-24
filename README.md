# Levi Ceccato's Portfolio Website

## 📖 About

Welcome to the repository of Levi Ceccato's portfolio website. It’s built using [Kirby](https://getkirby.com), an awesome CMS. Check it the live site at [levic.com.au](https://levic.com.au).

## 🤠 Usage

### Requirements

- Docker 19

### Development

Make sure you run all commands from the root of this project.

**Install dependencies. Make sure to do this first.**
```shell
docker-compose run php composer install
docker-compose run node npm install
```

**Run development server & webpack in watch mode.**
```shell
docker-compose up
```

**Build webpack assets.**
```shell
docker-compose run npm run build
```

## ⭐️ Things Used

### Dev Tech
- [Kirby](https://getkirby.com) for content management
- [webpack](https://webpack.js.org) for asset bundling
- [Sass](https://sass-lang.com) for CSS preprocessing

### Fonts
- [Manrope](https://manropefont.com)

## 👮‍ Licenses

All non-third-party source code is licensed under the [MIT license](http://opensource.org/licenses/mit-license.php). Content and images are © 2019 Levi Ceccato.