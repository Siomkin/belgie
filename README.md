#####  Подготовка файла с данными для регистрация информационных сетей, систем и ресурсов в АИС БелГИЭ.  

Возможности
 - Учёт списка оборудования и места установки
 - Учёт линий связи
 - Учёт каналов связи
 - Типы оборудования
 - Разделение на организации или отдельные объекты
 - Работа с адресами
 - Выбор данных для подготовки xml и загрузки на портал   


#### Установка

    composer create-project siomkin/belgie

Изменить настройки подключения к бд в .env

Создать таблицы бд

    php bin/console doctrine:schema:create

Загрузить данные типпов оборудования и адреса 

    php bin/console doctrine:fixtures:load    

#### Работа с пользователя
###### Creates users and stores them in the database

Usage:
`app:add-user [options] [--] [<username> [<password>]]`

The app:add-user command creates new users and saves them in the database:
  
    php bin/console app:add-user username password
    
By default the command creates regular users. To create administrator users, add the --admin option:
    
    php bin/console app:add-user username password --admin

  
###### Deletes users from the database

Usage:
`app:delete-user <username>`

The app:delete-user command deletes users from the database:
  
    php bin/console app:delete-user username
  
If you omit the argument, the command will ask you to provide the missing value:
  
    php bin/console app:delete-user



###### Lists all the existing users

Usage:
`  app:list-users [options]`

The app:list-users command lists all the users registered in the application:
  
    php bin/console app:list-users
    
By default the command only displays the 50 most recent users. Set the number of results to display with the --max-results option:
  
    php bin/console app:list-users --max-results=2000
    

