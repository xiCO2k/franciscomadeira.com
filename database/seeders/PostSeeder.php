<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->posts() as $post) {
            DB::table('posts')->updateOrInsert(['slug' => $post['slug']], $post);
        }
    }

    /**
     * @return list<array<string, mixed>>
     */
    private function posts(): array
    {
        return [
            [
                'id' => 1,
                'slug' => 'termwind-released',
                'category' => 'blog',
                'title' => '🍃 Termwind v1.0 Released!',
                'description' => 'Termwind allows you to build unique and beautiful PHP command-line applications, using the Tailwind CSS API with an HTML Renderer. In short, it\'s like Tailwind CSS, but for the PHP command-line applications.',
                'text' => <<<'MARKDOWN'
![Termwind Released!](https://franciscomadeira.com/images/termwind-released-hero.webp)


Termwind allows you to build unique and beautiful PHP command-line applications, using the Tailwind CSS API with an HTML Renderer. In short, it's like Tailwind CSS, but for the PHP command-line applications.

Termwind was created by [Francisco Madeira](https://twitter.com/xiCO2k) and [Nuno Maduro](https://twitter.com/enunomaduro), and after almost three months of development **Termwind v1.0 is available**, and you can start using on your projects.

Checkout the repository on [GitHub](https://github.com/nunomaduro/termwind)!

## Why?

One of many things that annoyed all the CLI developers was to add some margin before the content, just to have some breathing room, without **Termwind** the only way was to add spaces before each line, now with **Termwind** you can just pass the class `ml-2` and you will have **two spaces** on every line for that element, just like how we do for the browser.

**This example** shows how easy it is to create a beautiful CLI output, with simple knowledge of **HTML** and **TailwindCSS**.

![Termwind Released!](https://franciscomadeira.com/images/termwind-released.webp)

```php
use function Termwind/render;

render(<<<HTML
    <div class="m-1">
        <div class="w-full text-center bg-green-400 text-black">
            <b>Termwind</b> v1.0 Released!
        </div>
        <p class="w-full text-center">
            After almost three months of development <b>Termwind</b> v1.0 is live.
        </p>
    </div>
HTML);
```

## Now, lets create an output just like **PEST**

For this example we will take advantage of the **Laravel Framework** `Command` with a `blade` view.

![PEST Example](https://franciscomadeira.com/images/pest-example.webp)

```php,TermwindReleasedCommand.php
<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use function Termwind\render;

class TermwindReleasedCommand extends Command
{
    protected $signature = 'termwind:released';

    public function handle()
    {
        return render(view('termwind', [
            'files' => [[
                'name' => 'Tests\TermwindReleasedTest',
                'tests' => [[
                    'name' => 'it is ready to use!',
                ]],
            ]],
            'totalTests' => 1,
            'totalTime' => '0.20s',
        ]));
    }
}
```

```blade,termwind.blade.php
<div class="mx-2 my-1">
    @foreach ($files as $file)
        <div>
            <span class="px-1 font-bold bg-green text-black">PASS</span>
            {{ $file['name'] }}
        </div>
        @foreach ($file['tests'] as $test)
            <div class="text-gray-400">
                <b class="text-green">✓</b> {{ $test['name'] }}
            </div>
        @endforeach
    @endforeach

    <div class="mt-1">
        <span class="w-8">Tests:</span>
        <b class="text-green">{{ $totalTests }} passed</b>
    </div>

    <div>
        <span class="w-8">Time:</span>
        <span>{{ $totalTime }}</span>
    </div>
</div>
```

**What's next?** As v1.0 is ready to use on production. The future develoments we will focus on improving our documentation and provide a lot more use case examples.

**Get involved!** This is a community project and we are always looking for people to [contribute](https://github.com/nunomaduro/termwind).

* You can learn more about, on [GitHub](https://github.com/nunomaduro/termwind).
* Follow us on Twitter: [@enunomaduro](https://twitter.com/enunomaduro), [@xiCO2k](https://twitter.com/xiCO2k).

> As a joke I added to my Twitter Description "I built everything with HTML and CSS" and all of a sudden I start working on Termwind and the API is based around HTML and CSS classes. 😎
MARKDOWN,
                'keywords' => 'php, terminal, cli',
                'share_img' => 'https://franciscomadeira.com/og-termwind-released.jpg',
                'is_active' => true,
                'is_hidden' => false,
                'created_at' => '2021-12-06 10:02:42',
                'updated_at' => '2021-12-06 10:02:42',
            ],
            [
                'id' => 2,
                'slug' => 'about',
                'category' => '',
                'title' => 'Hello World! 👋',
                'description' => 'I\'m Francisco Madeira, 33 years old, I\'ve been working as a Sofware Developer since 2010',
                'text' => <<<'MARKDOWN'
I'm **Francisco Madeira**, 33 years old, I've been working as a Sofware Developer since **2010**. Everyday I get to work with **PHP, MySQL, TypeScript, JavaScript**, and I'm a HUGE fan of the **T**est-**D**riven **D**evelopment principle, and I've been using it on all my projects.

I had the chance to work with a lot of web tools in the past such as **Zend, CodeIgniter, Symfony, CakePHP, AngularJS, Ionic**, you name it...

Right now, I've been using the **⚡️ Laravel Framework** and **🐳 Docker** almost on every project. For the frontend side, I've been using **VueJS** or **React** depending on the project needs.

Also, I've been contributing to the Open-Source, on various projects, mostly, **PHP** and **JS** Packages, it's all available on my **[GitHub](https://github.com/xiCO2k)**.

There are some OSS Projects I'm working:

* **[Termwind](https://github.com/nunomaduro/termwind) 🍃**: In short, it's like Tailwind CSS, but for the **PHP command-line applications**.
* **[laravel-vue-i18n](https://github.com/xiCO2k/laravel-vue-i18n)**: Allows to connect your **Laravel Framework** translation files with **Vue3**.
* **[MultiSort](https://github.com/xiCO2k/multi-sort)**: Allows you to sort a **multidimensional** array easily.

Besides code, I'm also **Christian**, a **Guitar Player** and married to **❤️ Inês**.
MARKDOWN,
                'keywords' => 'about',
                'share_img' => 'https://franciscomadeira.com/og-about.png',
                'is_active' => true,
                'is_hidden' => true,
                'created_at' => '2021-12-08 09:31:39',
                'updated_at' => '2021-12-08 09:31:39',
            ],
            [
                'id' => 4,
                'slug' => 'make-beautiful-cli-apps-with-termwind',
                'category' => 'given-talks',
                'title' => 'Make Beautiful CLI Apps with 🍃 Termwind',
                'description' => '',
                'text' => <<<'MARKDOWN'
In this talk, I show how to make beautiful CLI Apps with 🍃 Termwind from scratch. You will learn everything there is to know about 🍃 Termwind and how easy it is to make an awesome CLI App.

### Given this talk at:
* [Laravel Worlwide Meetup](https://www.youtube.com/watch?v=7XTbHVlJdIs) (online)
* [PHP Lisbon Meetup](https://phplisbon.com/meetups/meetup-1) (in person)
* [Fullstack Europe 2022 Conference](https://fullstackeurope.com/2022/speakers/francisco-madeira) (in person)
* [Laracon EU 2023](https://laracon.eu) (in person)
* [Laracon IN 2023](https://laracon.in) (in person)

<iframe width="100%" src="https://www.youtube.com/embed/7XTbHVlJdIs" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

Also, after this talk I did release the **Football Live Scores CLI** example, you can fork it from [GitHub Repo](https://github.com/xiCO2k/football-live-scores-cli) and make it a *real* thing!

If you have any questions feel free to send me a message on [Twitter](https://twitter.com/xiCO2k).
MARKDOWN,
                'keywords' => 'termwind, talk, laravel, meetup, worldwide',
                'share_img' => 'https://franciscomadeira.com/og-about.png',
                'is_active' => true,
                'is_hidden' => false,
                'created_at' => '2021-12-08 09:31:39',
                'updated_at' => '2021-12-08 09:31:39',
            ],
            [
                'id' => 9,
                'slug' => 'how-to-use-laravel-vue-i18n',
                'category' => 'blog',
                'title' => 'How to use Laravel Vue i18n',
                'description' => 'The goal of this package is to have the closest experience that is available with the Laravel Localization but for the frontend side.',
                'text' => <<<'MARKDOWN'
The goal of this package is to have the closest experience that is available with the Laravel Localization but for the frontend side.

> If you prefer a video screencast you can check out this:

<iframe width="560" height="315" src="https://www.youtube.com/embed/ONRo8-i5Qsk" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

## Install Laravel 

Lets install a brand new **Laravel** project with [Jetstream](https://github.com/laravel/jetstream), to have some Laravel with Vue3 Inertia Scaffolding.

Go to you code directory and run:

```sh,~/code
laravel new app
cd app
composer require laravel/jetstream
php artisan jetstream:install inertia
npm install
```

With all of that installed, lets run the migrations (make sure to update the `.env` file with the correct database settings):

```sh,~/code/app
php artisan migrate
```

## Usage

With all the Laravel instalation process complete, go ahead and install the plugin: 

```sh,~/code/app
npm install laravel-vue-i18n
```

Now open the `resources/js/app.js` file and import `laravel-vue-i18n`:

```js,app.js
import { i18nVue } from 'laravel-vue-i18n'
```

Bellow, inside the `setup` method you can now apply the plugin to the Vue instance:

```js,app.js
createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(i18nVue, { 
                resolve: (lang) => import(`../../lang/${lang}.json`) 
            })
            .mixin({ methods: { route } })
            .mount(el);
    },
});
```

With all of that done, now you can use the plugin with the `$t()` mixin.

To try it out, open the `resources/js/Pages/Welcome.vue` and use the mixin:

```vue,Welcome.vue
<template>
    ...
    <div class="mt-8 text-2xl">
        {{ $t('Welcome to your Jetstream application!') }}
    </div>
    ...
</template>
```

then, you can open the `lang/en.json` file and add a new translation for that sentence:

```json,en.json
{
    "Welcome to your Jetstream application!": "Welcome to your Translated Jetstream application!"
}
```

And its **done**! If you reload the page you should see the translated sentence in there.

## How to use `.php` translation files

Now if you want to go a step further and also have the `.php` translation files available on frontend, not possible out of the box since the browser can't open the `.php` files, for that you can we can use the mix plugin provided by the plugin.

To set it up, open the `webpack.mix.js` and require the mix plugin:

```js,webpack.mix.js
const mix = require('laravel-mix');
require('laravel-vue-i18n/mix');
```

and just include the plugin, under the mix chain:

```js,webpack.config.js
mix.js('resources/js/app.js', 'public/js').vue()
   .i18n()
   ...
```

With this done, you can start using the `.php` translation files on your `.vue` files like this:

```vue,Welcome.vue
<template>
    ...
    <div>
        {{ $t('auth.failed') }}
    </div>
    ...
</template>
```

And thats all you need to have the plugin working with both `.json` and `.php` translations!

You can find more information on [GitHub](https://github.com/xiCO2k/laravel-vue-i18n), and make sure to give it a ⭐️ star!

MARKDOWN,
                'keywords' => null,
                'share_img' => 'https://franciscomadeira.com/og-laravel-vue-i18n.jpg',
                'is_active' => true,
                'is_hidden' => false,
                'created_at' => '2022-03-30 19:36:09',
                'updated_at' => '2022-03-30 19:36:09',
            ],
            [
                'id' => 10,
                'slug' => 'laravel-pint-workflow',
                'category' => 'blog',
                'title' => 'Laravel Pint GitHub Workflow',
                'description' => 'When using Laravel Pint to work as a coding standard, we should have an workflow that runs the coding styling for us.',
                'text' => <<<'MARKDOWN'
When using Laravel Pint to work as a coding standard, we should have an workflow that runs the coding styling for us.

## Workflow Yml Code

Go to your base code and add an workflow with the following code:

```yml,./github/workflows/run-style.yml
name: Run style format (PHP)

on: [push]

jobs:
    run-style:
        name: Run style format (PHP)
        runs-on: ubuntu-latest
        steps:
            -   uses: actions/checkout@v2

            -   name: Setup PHP
                uses: shivammathur/setup-php@v2
                with:
                    php-version: '8.2'
                    extensions: dom, curl, libxml, mbstring, zip, pcntl, pdo, sqlite, pdo_sqlite, bcmath, soap, intl, gd, exif, iconv, imagick
                    coverage: none

            -   name: Run composer install
                run: composer install -n --prefer-dist
                env:
                    COMPOSER_AUTH: ${{ secrets.COMPOSER_AUTH }}

            -   name: Run style format
                run: ./vendor/bin/pint --test -v --ansi
```

With that, on every commit, or PR it will give you a result that will follow the Laravel coding standard.

You can find more information on [GitHub](https://github.com/laravel/pint), and make sure to give it a ⭐️ star!
MARKDOWN,
                'keywords' => 'laravel, pint, styling',
                'share_img' => 'https://github.com/laravel/pint/raw/main/art/overview.png',
                'is_active' => true,
                'is_hidden' => false,
                'created_at' => '2023-01-05 02:38:18',
                'updated_at' => '2023-01-05 02:38:18',
            ],
        ];
    }
}
