### Setting Up
Set up development environment; recommend: [Laravel Valet](https://laravel.com/docs/8.x/valet)

- Move to your parked projects directory: ``cd ~/Sites``
- Get code: ``git clone repo-name new-site-name``  then ``git checkout develop``
- Rename .env.example to .env, and update ``SITE_URL``
- ``cd new-site-name``
- ``composer install``
- Create a new database ``mysql -u root -e "CREATE DATABASE new_db_name"``
- navigate to root of project
- Run: ``php craft setup`` filling in database credentials, with username root and no password

**bug here related to super table* project config won't apply. 
``Exception 'craft\errors\MigrationException' with message 'An error occurred while executing the "craft\migrations\Install migration: The following config paths could not be processed successfully:``
database import is required to fire things up the first time. [bug here](https://github.com/craftcms/cms/issues/4789#issuecomment-606596010)

- ``new-site-name`` will automatically be served at ``http://<new-site-name>.test``
- Run ``npm install`` from project root to download dependencies
- Run ``gulp`` to build assets

#### Gulp Tasks
The default ``gulp``  task is all you should need to use ins development, but ``scssProd`` should be used for production assets. Commands should be run in the root of the project. These tasks are also hooked up to NPM, using ``npm run`` instead of ``gulp``.

- ``gulp`` - Runs ``js``/``scss`` & watches for changes
- ``gulp js`` -  Bundles vendor & custom scripts
- ``gulp scss`` - Process styles with auto-prefixer & sourcemaps
- ``gulp scssProd`` - Minify styles
- ``gulp watchStyles`` - Watch the styles for changes
- ``gulp watchScripts`` - Watch the scripts for changes
- ``gulp dumpDatabase`` - Pulls a copy of the database

Some IDE's support UI's for these kinda of tasks, usually accessed by right clicking the ``gulpfile.js`` or ``package.json``

