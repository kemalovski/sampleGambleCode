# demoSlotMachine


Installation with Docker
------
1. git clone https://github.com/kemalovski/GamblingGroupDevCodeTest.git
2. cd GamblingGroupDevCodeTest/app
3. composer update
4. cd ..
5. docker-compose up -d
6. http://localhost:8000/affiliates

Tests
------
Warn: If you are not installing with docker please change in GamblingGroupDevCodeTest/app/tests/Unit/AffiliateServiceTest.php 20th Line path way. 
If you installed with docker just follow the sections.
1. docker exec -it app bash
2. ./vendor/bin/phpunit  tests/Unit/GreatCircleServiceTest.php
3. ./vendor/bin/phpunit  tests/Unit/AffiliateServiceTest.php
