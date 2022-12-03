# Potato
### Simple Slim4 application skelleton

Dillinger is a cloud-enabled, mobile-ready, offline-storage compatible,

### Contains:

- All slim4 features including routing, middleware etc
- MVC
- Eloquent + Models
- Phinx migrations.

#### Usage

Clone
```sh
git clone https://github.com/kubastanclik/potato.git
```

Make .env file (based on .env.example)

Install dependencies:
```sh
composer install
```

#### Fries CLI (alpha)
Potato include CLI to make your work easier. On this moment contains only most importants features.

Starting development server:
```sh
php fries.php serve
```

Add controller:
```sh
php fries.php c:controller YourNewController
```

Add model:
```sh
php fries.php c:model YourNewModel
```

#### Phinx
To read more about phinx go to official documentation [here](https://phinx.org/ "Phinx Documentation")



