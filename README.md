Cистема учёта документации построенная на переделаном шаблоне [Yii 2](http://www.yiiframework.com/)


LOGIN DATA
-------------------
Админка
```
Username: admin
password: admin
```
Rest API - доступно всем

AVAILABLE ENDPOINTS
-------------------

| № | API Method    | Реализовано   |
| ------------- | ------------- | ------------- |
| 1. | GET /orders  | +  |
| 2. | POST /orders  | +  |
| 3. | PATCH /orders/{id}  | -  |
| 4. | GET /orders/{id} | +  |
| 5. | DELETE /orders/{id}  | +  |
| 6. | GET /clients  | -  |
| 7. | GET /documents/{orderId}  | -  |
| 8. | POST /documents  | -  |
| 9. | PATCH /documents/{id} | -  |
| 10. | DELETE /documents/{id}  | -  |

DIRECTORY STRUCTURE
-------------------

```
common
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
    tests/               contains tests for common classes    
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
backend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains backend configurations
    controllers/         contains Web controller classes
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for backend application    
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
```