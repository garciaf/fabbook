## ProjectBundle

This bundle's purpose is to provide tools for project management

Install & setup the bundle
--------------------------

You hae first to install the bundle TranslatorBundle that you can find in :
https://github.com/docteurklein/TranslatorBundle

then you will allow this bundle only in the test environnement : 

    ``` bash 

        if (in_array($this->getEnvironment(), array('test'))) {
            $bundles[] = new Knp\Bundle\TranslatorBundle\KnpTranslatorBundle;
            $bundles[] = new A5sys\ProjectBundle\A5sysProjectBundle();
        }

    ```
Then you will access to different command in test environnement

    ``` bash 
        ./app/console a5sys:i18n:dump
        ./app/console a5sys:i18n:list

    ```
a5sys:i18n:dump : will generate files for a choosen language with all the translation available
a5sys:i18n:list : show all the translation available 

Usage 
--------------------------

You can use the command a5sys:i18n:dump to centralize all your translation in your bundle

    ``` bash 
        ./app/console -e=test a5sys:i18n:dump fr --override
        ./app/console -e=test a5sys:i18n:dump fr --override

    ```

the first argument allow you to choose the language to generate the translation
the --override option erase the old gloabl file with a safe copy
