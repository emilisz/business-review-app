## Business reviews system

### User:
- Can add business
- Can fill the information about business
### Clients:
- Can leave a comment about business
- Can evaluate business from 1 to 5
### UI:
- Show all information about business
- Show all comments and evaluations

### Added +
- Show all information about business only to premium users
- User can buy premium
- Dashboard to see user related info

### Instruction
- Clone project
- Create .env file with corresponding values from .env.example
- Run in terminal: 
```
$ composer install
$ npm install
$ php artisan migrate --seed
$ php artisan serve
$ npm run dev
```

- Run tests:
```
$ php artisan test
```

- cli commands:
```
$ php artisan user:create {number=1}
$ php artisan business:create {number=1}
```


