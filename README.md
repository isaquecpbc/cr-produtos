# cr-produtos
Teste para automtech laravel Blade CRUDE de produtos simples



### Para iniciar o laravel com o docker:


1. na raiz do projeto
2. ``` $ docker-compose up -d ```
3. ``` $ docker-compose exec app bash ```
4. ``` $ php artisan key:generate ```
5. ``` $ composer update ```
6. ``` $ php artisan optimize:clear ```



#### Para configurar o BD no docker:
Favor usar o env.example como base nas mesmas variveis e suas definições


#### Para popular o banco de dados:

```
$ docker-compose exec app bash 
```

```
php artisan migrate:fresh --seed
```

### Teste o acesso em http://localhost/
