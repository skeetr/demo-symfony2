Skeetr Symfony2 Demo's
=======================

What's inside?
--------------

This is a demo of Skeetr based on Sonata Sandbox.


Installation
------------

Run the following commands::

    git clone http://github.com/sonata-project/sandbox.git demo
    cd demo

    php composer.phar install
    cp app/config/parameters.yml.sample app/config/parameters.yml
    cp app/config/parameters.yml.sample app/config/validation_parameters.yml
    cp app/config/parameters.yml.sample app/config/production_parameters.yml

    app/console doctrine:database:create
    app/console doctrine:schema:create
    app/console assets:install web


    app/console sonata:page:create-site --enabled=true --name=localhost --host=localhost --relativePath=/ --enabledFrom=now --enabledTo="+10 years" --default=true
    app/console doctrine:fixtures:load
 
    app/console sonata:page:update-core-routes --site=all
    app/console sonata:page:create-snapshots --site=all
